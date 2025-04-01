<?php

namespace classes;

use BalanceHistoryModel;
use BalanceModel;
use CommonIdRatingModel;
use PlayerModel;
use classes\ViewHelper as VH;


class Queue
{
    const QUEUES = [
        'rating_waiters' => '.rating_waiters',
        '2players_waiters' => '.2players_waiters',
        'inviteplayers_waiters' => '.inviteplayers_waiters',
    ];

    const QUEUE_NUMS = [
        'invite' => 'invite',
    ];

    const SEMAPHORE_KEY = 'semaphore_waiting';

    const MAX_INVITE_WAIT_TIME = 60;
    const PREFERENCES_TTL = 30 * 24 * 60 * 60;
    const PREFS_KEY = '.user_preference_';
    const RATING_QUEUE = 'ratingQueue';
    const TURN_TIME_PARAM_NAME = 'turn_time';

    const PREFS_ATTRS = ['time', 'from_rating', 'bid', 'num_players', self::TURN_TIME_PARAM_NAME]; // Атрибуты QueuePlayer, ннужные для его префсов
    const LAST_PING_TIMEOUT = 20; // SUD-46 Если игрок не подавал запросы за последние 20 сек, не собирать  с ним игру.
    const LAST_PING_TOO_OLD = 60; // SUD-46 Если игрок не подавал запросы более минуты - выкинуть его из очереди

    protected string $User;

    protected QueueUser $queueUser;

    protected bool $userInInitStatus = false;
    const USER_QUEUE_STATUS_PREFIX = '.user_queue_status_';

    protected Game $caller;
    protected array $POST;

    protected bool $kick_this_user = false;

    public function __construct($User, Game $caller, array $POST, bool $initGame = false)
    {
        $this->User = $User;
        $this->caller = $caller;
        $this->POST = $POST;

        try {
            $this->queueUser = QueueUser::new(
                [
                    'time' => date('U'),
                    'cookie' => $this->User,
                    'last_ping_time' => date('U'),
                    'rating' => PlayerModel::getRatingByCookie($this->User, $this->caller::GAME_NAME),
                    'common_id' => PlayerModel::getPlayerCommonId($this->User, true)
                ]
                + $POST
            );

            Cache::rpush('QueueUserCreation', $this->queueUser); // SUD-48
        } catch (\Throwable $exception) {
            Cache::rpush('QueueUserErrors', $exception->__toString()); // SUD-48
        }

        $this->userInInitStatus = $this->checkPlayerInitStatus($initGame);

        $this->saveUserPrefs();

        if (!$this->refreshLastPingTime()) {
            self::cleanUp($this->User);

            // SUD-46 Если игрок не подавал запросы более минуты - выкинуть его из очереди
            $this->kick_this_user = true;
            self::clearPlayerInitStatus($this->User);
        }
    }

    /**
     * @param string $queue
     * @return QueueUser[]
     */
    protected static function getQueuePlayers(string $queue): array
    {
        $queuePlayers = Cache::hgetall($queue) ?: [];

        foreach($queuePlayers as $num => &$player) {
            /** @var ?QueueUser $player */
            $player = @unserialize($player) ?: null;

            if (!($player instanceof QueueUser)) {
                unset($queuePlayers[$num]);
            }
        }

        return $queuePlayers;
    }

    protected function getInvitedPlayerTime($User): int
    {
        $playerInfo = self::getUserFromQueue(static::QUEUES['inviteplayers_waiters'], $User);

        return date('U') - ($playerInfo->time ?? date('U'));
    }

    public function init()
    {
        $this->userInInitStatus = $this->checkPlayerInitStatus(true);
    }

    protected function checkPlayerInitStatus(bool $initGame): bool
    {
        $initGame = $initGame || self::isUserInQueue($this->User);

        if ($initGame) {
            self::setPlayerInitStatus($this->User); // todo возможно не надо помещать в кеш

            return true;
        }

        if (Cache::get(static::USER_QUEUE_STATUS_PREFIX . $this->User)) {
            return true;
        }

        return false;
    }

    public static function clearPlayerInitStatus($User): void
    {
        Cache::del(static::USER_QUEUE_STATUS_PREFIX . $User);
    }

    public static function setPlayerInitStatus($User): void
    {
        Cache::setex(static::USER_QUEUE_STATUS_PREFIX . $User, 60, StateMachine::STATE_INIT_GAME);
    }

    public static function isUserInQueue(string $user): bool
    {
        foreach (static::QUEUES as $queue) {
            if (self::getUserFromQueue($queue, $user)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Saves Prefs to cache and adds Prefs to current queueUser if empty
     */
    private function saveUserPrefs()
    {
        if (isset($this->queueUser->turn_time)) {
            Cache::setex(
                static::PREFS_KEY . $this->User,
                static::PREFERENCES_TTL,
                $this->queueUser
            );
        } else {
            $prefsArray = $this->getUserPrefsArray($this->getUserPrefs());
            foreach($prefsArray as $prefAttr => $prefValue) {
                @($this->queueUser->$prefAttr = $prefValue);
            }
        }

        return;

        // SUD-418
        if (isset($this->POST[self::TURN_TIME_PARAM_NAME])) {
            Cache::setex(
                static::PREFS_KEY . $this->User,
                static::PREFERENCES_TTL,
                $this->POST
            );
        }
    }

    public function getUserPrefs(?string $User = null): ?QueueUser
    {
        $prefs = Cache::get(static::PREFS_KEY . ($User ?? $this->User));
        if ($prefs instanceof QueueUser) {
            return $prefs;
        } else {
            return null;
        }
    }

    protected function getUserPrefsArray(?QueueUser $queueUser = null): array
    {
        $res = [];

        if (!($queueUser instanceof QueueUser)) {
            $queueUser = $this->queueUser;
        }

        foreach (static::PREFS_ATTRS as $attr) {
            if (isset($queueUser->$attr)) {
                $res[$attr] = $queueUser->$attr;
            }
        }

        return $res;
    }

    /**
     * @param bool $isOuterCall Ставим True, если вызываем метод извне класса
     * @return array
     */
    public function chooseGame(bool $isOuterCall = false): array
    {
        $newStatus = $this->caller->updateUserStatus($this->caller->SM::STATE_CHOOSE_GAME, $this->User, true);

        $chooseGameParams = Response::state($newStatus)
            + [
                'gameSubState' => $this->caller->SM::SUBSTATE_CHOOSING,
                'players' => $this->caller->onlinePlayers(),
                'coin_players' => $this->caller->onlineCoinPlayers(),
                'prefs' => $this->getUserPrefsArray(),
            ]
            + (!$isOuterCall
                ? ['reason' => 'Queue error']
                : []);

        try {
            throw new \Exception('QueueUserError');
        } catch(\Throwable $e) {
            Cache::rpush('QueueUserErrors', $e->__toString()); // SUD-46
            $chooseGameParams['error'] = $e->__toString();
            $chooseGameParams['debug'] = $this->queueUser;
        }

        return $chooseGameParams;
    }

    public function doSomethingWithThisStuff(): array
    {
        if (!$this->userInInitStatus || $this->kick_this_user) {
            return $this->chooseGame();
        }

        if ($this->checkInviteQueue()) {
            if ($this->inviteQueueFull()) {
                if (Cache::lock(self::SEMAPHORE_KEY)) {
                    return $this->makeGame(static::QUEUE_NUMS['invite'], 2); // todo использовать константу макс. колва игроков для каждой игры
                }
            }

            $newStatus = $this->caller->updateUserStatus($this->caller->SM::STATE_INIT_GAME, $this->User, true);

            return Response::state($newStatus)
                + [
                    'gameSubState' => self::getQueueLen(static::QUEUES["inviteplayers_waiters"]),
                    'gameWaitLimit' => $this->caller->gameWaitLimit,
                    'timeWaiting' => $this->getInvitedPlayerTime($this->User),
                    'comments' => VH::h6(T::S('Awaiting invited players'))
                ];
        }

        if ($ratingWanted = $this->waitRatingPlayer($this->User))
        {
            if ($ratingPlayer = $this->findRatingPlayer($ratingWanted)) {
                if (Cache::lock(self::SEMAPHORE_KEY)) {
                    return $this->makeRatingGame($ratingPlayer);
                }
            }

            if ($this->timeToWaitRatingPlayerOver($this->User)) {
                return $this->storeToCommonQueue($this->User) ?? $this->stillWaitRatingPlayer();
            }

            return $this->stillWaitRatingPlayer();
        }

        if ($this->queueUser->rating > 1900 && ($ratingPlayer = $this->findWaitingRaitingPlayer($this->queueUser->rating))) {
            if (Cache::lock(self::SEMAPHORE_KEY)) {
                return $this->makeReverseRatingGame($ratingPlayer);
            }
        }

        if ($this->players2Waiting($this->User)) {
            if (Cache::lock(self::SEMAPHORE_KEY)) {
                return $this->makeGame('2');
            } else {
                return $this->caller->desync() + ['reason' => 'Semaphore lock failed'];
            }
        }

        if ($this->playerWaitTooLong()) {
            $bot = $this->getBotPlayer();
            $this->storeTo2Players($bot);

            return $this->makeGame('2');
        }

        return $this->storeTo2Players($this->queueUser);
    }

    protected function getQueueLen(string $queue): int
    {
        return Cache::hlen($queue) ?: 0;
    }

    protected function inviteQueueFull(): bool
    {
        if (self::getQueueLen(static::QUEUES["inviteplayers_waiters"]) < 2) {
            return false;
        }

        // Проверяем очередь ждущих реванша на наличие просроченных заявок от игроков
        $waitingPlayers = self::getQueuePlayers(static::QUEUES["inviteplayers_waiters"]);
        foreach ($waitingPlayers as $player => $playerInfo) {
            if ($player != $this->User) {
                if (isset($playerInfo->time) && (date('U') - $playerInfo->time) > self::MAX_INVITE_WAIT_TIME) {
                    self::cleanUp($player);
                }
            }
        }

        // Если очередь все еще длиной не менее 2х игроков - возвращаем тру
        if (self::getQueueLen(static::QUEUES["inviteplayers_waiters"]) >= 2) {
            return true;
        }

        return false;
    }

    protected static function getUserFromQueue(string $queue, string $user): ?QueueUser
    {
        $res = Cache::hget($queue, $user);

        if (!($res instanceof QueueUser)) {
            $res = null;
        }

        return $res;
    }

    protected function checkInviteQueue()
    {
        $playerInfo = self::getUserFromQueue(static::QUEUES["inviteplayers_waiters"], $this->User);

        if ($playerInfo) {
            if (isset($playerInfo->time) && (date('U') - $playerInfo->time) > static::MAX_INVITE_WAIT_TIME) {
                self::cleanUp($this->User);

                return false;
            } else {
                return true;
            }
        }

        return false;
    }

    /**
     * Возвращает рейтинг, от которого игрок ищет соперника.
     * Если рейтинг определен, помещает игрока в очередь подбора на рейтинг
     * @param string $User
     * @return int|null
     */
    protected function waitRatingPlayer(string $User): ?int
    {
        if (isset($this->queueUser->from_rating) && ($this->queueUser->from_rating == 0)) {
            return null;
        }

        if (($this->queueUser->from_rating ?? 0) > 0 && Cache::lock($User)) {
            if (self::addUserToQueue(static::QUEUES['rating_waiters'], $this->queueUser)) {
                return $this->queueUser->from_rating;
            }
        } elseif ($waiterData = self::getUserFromQueue(static::QUEUES["rating_waiters"], $User)) {
            $this->queueUser->time = $waiterData->time ?? date('U');

            return (integer)$waiterData->from_rating;
        }

        return null;
    }

    protected function findRatingPlayer(int $ratingWanted): ?QueueUser
    {
        $players2Waiting = self::getQueuePlayers(static::QUEUES["2players_waiters"]);
        if ($players2Waiting) {
            foreach ($players2Waiting as $player => $playerInfo) {

                if(!isset($playerInfo->rating)) {
                    $playerInfo->rating = PlayerModel::getRatingByCookie($player);
                }
                if ($playerInfo->rating >= $ratingWanted) {
                    $playerInfo->queue = '2';

                    return $playerInfo;
                }
            }
        }

        if (($playersRatingWaiting = self::getQueuePlayers(static::QUEUES["rating_waiters"]))) {
            foreach ($playersRatingWaiting as $player => $playerInfo) {
                if ($player != $this->User) {
                    if(!isset($playerInfo->rating)) {
                        $playerInfo->rating = PlayerModel::getRatingByCookie($player);
                    }
                    if (
                        $playerInfo->rating >= $ratingWanted
                        &&
                        $this->queueUser->rating >= $playerInfo->from_rating
                    ) {
                        $playerInfo->queue = self::RATING_QUEUE;

                        return $playerInfo;
                    }
                }
            }
        }

        return null;
    }

    /**
     * @param $curPlayerRating
     * @return QueueUser|null
     */
    protected function findWaitingRaitingPlayer(int $curPlayerRating): ?QueueUser
    {
        if (($playersRatingWaiting = self::getQueuePlayers(static::QUEUES["rating_waiters"]))) {
            foreach ($playersRatingWaiting as $player => $playerInfo) {
                if ($player != $this->User && self::checkLastPingTime($playerInfo)) {
                    if ($curPlayerRating >= $playerInfo->from_rating) {
                        $playerInfo->queue = self::RATING_QUEUE;
                        $playerInfo->rating = PlayerModel::getRatingByCookie($playerInfo->cookie);

                        return $playerInfo;
                    }
                }
            }
        }

        return null;
    }

    protected static function checkLastPingTime(QueueUser $user): bool
    {
        return (date('U') - ($user->last_ping_time ?? date('U'))) <= self::LAST_PING_TIMEOUT;
    }

    protected function gatherUserData(): array
    {
        if (isset($this->POST[self::TURN_TIME_PARAM_NAME])) {
            return $this->POST;
        }

        $players2Queue = self::getUserFromQueue(
            static::QUEUES["2players_waiters"],
            $this->User
        );

        if ($players2Queue) {
            return self::getUserPrefsArray($players2Queue);
        }

        return $this->getUserPrefsArray() ?: ['num_players' => 2, 'turn_time' => array_rand([60 => 60, 120 => 120])];
    }

    protected function makeReverseRatingGame(QueueUser $ratingPlayer): array
    {
        if (
            // Удалили ожидающего рейтинг игрока из очереди рейтинга
            self::cleanUp($ratingPlayer->cookie)
            &&
            self::cleanUp($this->User)
            &&
            self::addUserToQueue(static::QUEUES['2players_waiters'], $ratingPlayer)
            //Поместили ожидающего рейтинг игрока в очередь текущего игрока
            &&
            self::addUserToQueue(static::QUEUES['2players_waiters'], $this->queueUser)
        ) {
            return $this->makeGame('2', 2, $ratingPlayer->rating);
        } else {
            return $this->chooseGame();
        }
    }

    protected function makeRatingGame(QueueUser $ratingPlayer): array
    {
        $waiterData = self::getUserFromQueue(static::QUEUES["rating_waiters"], $this->User);

        if ($ratingPlayer->queue == self::RATING_QUEUE) {
            if (!(
                self::cleanUp($ratingPlayer->cookie)
                &&
                self::addUserToQueue(static::QUEUES['2players_waiters'], $ratingPlayer)
            )) {
                return $this->chooseGame();
            }
        }

        if (
            self::cleanUp($this->User)
            &&
            self::addUserToQueue(
                static::QUEUES['2players_waiters'],
                $waiterData
            )
        ) {
            return $this->makeGame('2', 2, $ratingPlayer->rating);
        } else {
            return $this->chooseGame();
        }
    }

    protected function timeToWaitRatingPlayerOver($User)
    {
        $waiterData = self::getUserFromQueue(static::QUEUES["rating_waiters"], $User);

        if ((date('U') - $waiterData->time) > $this->caller->ratingGameWaitLimit) {
            return true;
        }

        return false;
    }

    /**
     * @param $User
     * @return string[]|null
     */
    protected function storeToCommonQueue($User): ?array
    {
        $waiterData = self::getUserFromQueue(static::QUEUES["rating_waiters"], $User);

        if (self::cleanUp($User) && $waiterData) {
            return $this->storeTo2Players($waiterData);
        } else {
            return null;
        }
    }

    /**
     * @return string[]
     */
    protected function stillWaitRatingPlayer(): array
    {
        $newStatus = $this->caller->updateUserStatus($this->caller->SM::STATE_INIT_GAME, $this->User, true);

        return Response::state($newStatus)
            + [
                'gameSubState' => 0,
                'timeWaiting' => date('U') - $this->queueUser->time,
                'ratingGameWaitLimit' => $this->caller::RATING_INIT_TIMEOUT,
                'comments' => VH::h6(T::S('Searching for players with selected rank'))
            ];
    }

    /**
     * Removes User from all queues
     * @param $User
     * @return bool
     */
    public static function cleanUp($User): bool
    {
        if (!Cache::lock($User)) {
            return false;
        }

        foreach (static::QUEUES as $eachQueue) {
            if (Cache::hdel($eachQueue, $User, ['lock' => $User]) === false) {
                return false;
            }
        }

        return true;
    }

    protected function makeGame($queue, $maxNumUsers = 2, $wishRating = null): array
    {
        $this->caller->currentGame = $this->caller->getNewGameId();
        $this->caller->storeGameStatus(false);

        $this->caller->gameStatus = new GameStatus();
        $this->caller->gameStatus->gameName = $this->caller::GAME_NAME;

        $game_users = [];
        $this->caller->currentGameUsers = [];

        $waitingPlayers = self::getQueuePlayers(static::QUEUES["{$queue}players_waiters"]);

        if (!isset($waitingPlayers[$this->User])) {
            $options = $this->queueUser;
        } else {
            $options = $waitingPlayers[$this->User];

            unset($waitingPlayers[$this->User]);
            reset($waitingPlayers);
        }

        // Прописываем текущему юзеру - добавление в игру,  номер игры, удаляем из очереди ждунов
        $game_users[] = $options;

        self::cleanUp($this->User);
        $this->caller->setUserGameNumber($this->User, $this->caller->currentGame);

        $this->caller->currentGameUsers[] = $this->User;

        foreach ($waitingPlayers as $player => $playerInfo) {
            if ($wishRating && PlayerModel::getRatingByCookie($player) != $wishRating) {
                continue;
            }

            if (!Cache::lock($player)) {
                continue;
            }

            //Прописываем юзерам - удаление из очереди и номер игры
            if (!self::cleanUp($player)) {
                continue;
            }

            $this->caller->setUserGameNumber($player, $this->caller->currentGame);

            $game_users[] = $playerInfo;

            //Заполняем массив игроков
            $this->caller->currentGameUsers[] = $player;

            if (count($game_users) >= $maxNumUsers) {
                break;
            }
        }

        if (count($game_users) < 2) {
            // игра не собралась - отменяем, помещаем игрока обратно в очередь 2
            $this->caller->unsetUsersGameNumber($game_users);

            return $this->storeTo2Players($game_users[0]);
        }

        // Определяем ставку в монетах как минимальную из ставок игроков
        $bid = 0;
        $noCoinGame = false;
        foreach ($game_users as $num => $user) {
            $user->balance = BalanceModel::getBalance(PlayerModel::getPlayerCommonId($user->cookie, true));

            // todo иногда ставка делает баланс игрока отрицательным. Нужно не давать балансу уходить в минус

            if (!isset($user->bid)) {
                if ($user->balance > 0) {
                    $user->bid = self::getBid($user->balance);
                }
            } elseif ($user->bid > $user->balance) {
                unset($user->bid);
            }

            if (!isset($user->bid)) {
                $noCoinGame = true;
            } elseif ($bid == 0 || $bid > $user->bid || $bid > $user->balance) {
                $bid = $user->bid;
            }
        }

        if ($noCoinGame) {
            $bid = 0;
        }

        if ($bid) {
            DB::transactionStart(); // транзакция поверх транзакций баланса
        }

        foreach ($game_users as $num => $user) {
            if(!isset($user->common_id)) {
                $user->common_id = PlayerModel::getPlayerCommonId($user->cookie, true);
            }
            if (!isset($user->rating)) {
                $user->rating = CommonIdRatingModel::getRating($user->common_id, $this->caller::GAME_NAME);
            }

            $this->caller->gameStatus->users[$num] = new GameUser(
                [
                    'ID' => $user->cookie,
                    'common_id' => $user->common_id,
                    'status' => $this->caller->SM::GAME_STATE_START_GAME,
                    'isActive' => true,
                    'score' => 0,
                    'usernameLangArray' => array_combine(
                        T::SUPPORTED_LANGS,
                        array_map(
                            fn($lang) => T::S('Player', null, $lang) . ($num + 1),
                            T::SUPPORTED_LANGS
                        )
                    ),
                    'avatarUrl' => false,
                    'wishTurnTime' => $user->turn_time ?: array_sum(array_map(fn(QueueUser $user) => $user->turn_time ?? 0, $game_users)),
                    'rating' => $user->rating,
                ]
            );
            //Прописали игроков в состояние игры

            if ($bid) {
                if (
                    !BalanceModel::changeBalance(
                        BalanceModel::SYSTEM_ID,
                        $bid,
                        $this->caller->gameStatus->users[$num]->common_id . ' started game',
                        BalanceHistoryModel::TYPE_IDS[BalanceHistoryModel::GAME_TYPE],
                        $this->caller->currentGame
                    )
                    ||
                    !BalanceModel::changeBalance(
                        $this->caller->gameStatus->users[$num]->common_id,
                        -1 * $bid,
                        'Start game',
                        BalanceHistoryModel::TYPE_IDS[BalanceHistoryModel::GAME_TYPE],
                        $this->caller->currentGame
                    )) {
                    DB::transactionRollback();
                    $bid = false;
                }
            }

            $this->caller->gameStatus->{$user->cookie} = $num;
            // Заполнили массив нормеров игроков

            $this->caller->updateUserStatus($this->caller->SM::GAME_STATE_START_GAME, $user->cookie);
            // Назначили статусы всем игрокам
        }

        if($queue === self::QUEUE_NUMS['invite']) {
            $this->caller->gameStatus->isInviteGame = true;
        }

        $this->caller->gameStatus->bid = $bid;

        if ($bid) {
            DB::transactionCommit();

            foreach (T::SUPPORTED_LANGS as $lang) {
                $this->caller->addToLog(
                    t::S('Coins written off the balance sheet', null, $lang) . ": $bid",
                    $lang
                );
            }
        }

        $this->caller->saveGameUsers($this->caller->currentGame, $this->caller->currentGameUsers);

        return $this->caller->gameStarted(true);
    }

    public function storePlayerToInviteQueue($User)
    {
        $queueUser = self::getUserFromQueue(static::QUEUES["inviteplayers_waiters"], $User);
        if (!$queueUser) {

            $queueUser = $this->getUserPrefs($User);

            self::addUserToQueue(static::QUEUES['inviteplayers_waiters'], $queueUser);
        }

        $newStatus = $this->caller->updateUserStatus($this->caller->SM::STATE_INIT_GAME, $User, true);

        return Response::state($newStatus)
            + [
                'gameSubState' => self::getQueueLen(static::QUEUES['inviteplayers_waiters']),
                'gameWaitLimit' => $this->caller->gameWaitLimit,
                'timeWaiting' => date('U') - ($queueUser->queue_time ?? date('U')),
                'comments' => VH::h6(T::S('Awaiting invited players'))
            ];
    }

    protected function players2Waiting($User): bool
    {
        if ($cnt = self::getQueueLen(static::QUEUES["2players_waiters"])) {
            if (!self::getUserFromQueue(static::QUEUES["2players_waiters"], $User)) {
                return true;
            } elseif ($cnt > 1) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param QueueUser $queueUser
     * @return string[]
     */
    protected function storeTo2Players(QueueUser $queueUser): array
    {
        if (!self::addUserToQueue(static::QUEUES['2players_waiters'], $queueUser)) {
            return $this->chooseGame();
        }


        $newStatus = $this->caller->updateUserStatus($this->caller->SM::STATE_INIT_GAME, $queueUser->cookie, true);

        return Response::state($newStatus)
            + [
                'gameSubState' => self::getQueueLen(static::QUEUES["2players_waiters"]),
                'gameWaitLimit' => $this->caller->gameWaitLimit,
                'comments' => VH::h6(T::S('Searching for players'))
            ];
    }

    protected static function addUserToQueue(string $queue, QueueUser $queueUser, $lockNeeded = true): bool
    {
        if(!Game::isBot($queueUser->cookie)) {
            if (!self::checkLastPingTime($queueUser)) {
                return false;
            }
        }

        if (!$lockNeeded || Cache::lock($queueUser->cookie)) {
            $queueUser->queue_time = date('U');

            Cache::hset(
                $queue,
                $queueUser->cookie,
                $queueUser
            );

            return (bool)Cache::hget($queue, $queueUser->cookie);
        }

        return false;
    }

    private function playerWaitTooLong(): bool
    {
        $userInQueueRecord = self::getUserFromQueue(static::QUEUES['2players_waiters'], $this->User);

        if (!$userInQueueRecord || !($userInQueueRecord instanceof QueueUser)) {
            return false;
        }

        return (date('U') - $userInQueueRecord->time > $this->caller->gameWaitLimit);
    }

    private function getBotPlayer(): QueueUser
    {
        $config = include(__DIR__ . '/../../configs/conf.php');

        $botCookie = 'botV3#' . array_rand($config['botNames']);

        $botQueueUser = QueueUser::new(
            [
                'time' => date('U'),
                'cookie' => $botCookie,
                'last_ping_time' => date('U'),
                'rating' => PlayerModel::getRatingByCookie($this->User, $this->caller::GAME_NAME),
                'common_id' => PlayerModel::getPlayerCommonId($botCookie, true)
            ]
        );

        return $botQueueUser;
    }

    protected static function getBid(int $maxBid): ?int
    {
        $bidsArr = MonetizationService::BIDS;
        arsort($bidsArr);

        foreach ($bidsArr as $bid) {
            if ($bid <= floor($maxBid / 20)) {
                return $bid;
            }
        }

        foreach ($bidsArr as $bid) {
            if ($bid <= $maxBid) {
                return $bid;
            }
        }

        return null;
    }

    protected function refreshLastPingTime(): bool
    {
        foreach (static::QUEUES as $queue) {
            if($queueUser = self::getUserFromQueue($queue, $this->User)) {
                if ((date('U') - ($queueUser->last_ping_time ?? date('U'))) > self::LAST_PING_TOO_OLD) {
                    return false;
                }

                $queueUser->last_ping_time = $this->queueUser->last_ping_time;
                self::addUserToQueue($queue, $queueUser, false);
            }
        }

        return true;
    }
}
