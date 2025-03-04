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

    protected $User;
    protected $userTime;

    protected bool $userInInitStatus = false;
    const USER_QUEUE_STATUS_PREFIX = '.user_queue_status_';

    protected Game $caller;
    protected array $POST;

    public function __construct($User, Game $caller, array $POST, bool $initGame = false)
    {
        $this->User = $User;
        $this->caller = $caller;
        $this->POST = $POST;

        $this->userInInitStatus = $this->checkPlayerInitStatus($initGame);

        $this->saveUserPrefs();
    }

    private static function getInvitedPlayerTime($User): int
    {
        $playerInfo = Cache::hget(static::QUEUES['inviteplayers_waiters'], $User);

        return date('U') - $playerInfo['time'];
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

    public static function setPlayerInitStatus($User): void
    {
        Cache::setex(static::USER_QUEUE_STATUS_PREFIX . $User, 60, StateMachine::STATE_INIT_GAME);
    }

    public static function isUserInInviteQueue(string $user)
    {
        if (Cache::hget(static::QUEUES['inviteplayers_waiters'], $user)) {
            return true;
        }

        return false;
    }

    public static function isUserInQueue(string $user): bool
    {
        foreach (static::QUEUES as $queue) {
            if (Cache::hget($queue, $user)) {
                return true;
            }
        }

        return false;
    }

    private function saveUserPrefs()
    {
        if (isset($this->POST[self::TURN_TIME_PARAM_NAME])) {
            Cache::setex(
                static::PREFS_KEY . $this->User,
                static::PREFERENCES_TTL,
                $this->POST
            );
        }
    }

    public function getUserPrefs($User = null)
    {
        return Cache::get(static::PREFS_KEY . ($User ?? $this->User));
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
                'prefs' => $this->getUserPrefs(),
            ]
            + (!$isOuterCall
                ? ['reason' => 'Queue error']
                : []);

        return $chooseGameParams;
    }

    public function doSomethingWithThisStuff(): array
    {
        if (!$this->userInInitStatus) {
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
                    'gameSubState' => Cache::hlen(static::QUEUES["inviteplayers_waiters"]),
                    'gameWaitLimit' => $this->caller->gameWaitLimit,
                    'timeWaiting' => self::getInvitedPlayerTime($this->User),
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

        $curPlayerRating = PlayerModel::getRatingByCookie($this->User);
        if ($curPlayerRating > 1900 && ($ratingPlayer = $this->findWaitingRaitingPlayer($curPlayerRating))) {
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

        return $this->storeTo2Players($this->User);
    }

    protected function inviteQueueFull(): bool
    {
        if (Cache::hlen(static::QUEUES["inviteplayers_waiters"]) < 2) {
            return false;
        }

        // Проверяем очередь ждущих реванша на наличие просроченных заявок от игроков
        $waitingPlayers = Cache::hgetall(static::QUEUES["inviteplayers_waiters"]);
        foreach ($waitingPlayers as $player => $playerInfo) {
            if ($playerInfo && $player != $this->User) {
                $player_data = @unserialize($playerInfo);
                if (isset($player_data['time']) && (date('U') - $player_data['time']) > self::MAX_INVITE_WAIT_TIME) {
                    self::cleanUp($player);
                }
            }
        }

        // Если очередь все еще длиной не менее 2х игроков - возвращаем тру
        if (Cache::hlen(static::QUEUES["inviteplayers_waiters"]) >= 2) {
            return true;
        }

        return false;
    }

    protected function checkInviteQueue()
    {
        $playerInfo = Cache::hget(static::QUEUES["inviteplayers_waiters"], $this->User);

        if ($playerInfo) {
            if (isset($playerInfo['time']) && (date('U') - $playerInfo['time']) > static::MAX_INVITE_WAIT_TIME) {
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
        if (isset($this->POST['from_rating']) && ($this->POST['from_rating'] == 0)) {
            return null;
        }

        if (($this->POST['from_rating'] ?? 0) > 0 && Cache::lock($User)) {
            $options = $this->getUserPrefs();

            $this->userTime = date('U');

            if (self::addToQueue('rating_waiters', $User, $options, ['from_rating' => $this->POST['from_rating']])) {
                return (integer)$this->POST['from_rating'];
            }
        } elseif ($waiterData = Cache::hget(static::QUEUES["rating_waiters"], $User)) {
            $this->userTime = $waiterData['time'];

            return (integer)$waiterData['from_rating'];
        }

        return null;
    }

    protected function findRatingPlayer(int $ratingWanted)
    {
        if (($players2Waiting = Cache::hgetall(static::QUEUES["2players_waiters"]))) {
            foreach ($players2Waiting as $player => $data) {
                $playerRating = PlayerModel::getRatingByCookie($player);
                if ($playerRating >= $ratingWanted) {
                    return [
                        'cookie' => $player,
                        'options' => @unserialize($data)['options'] ?? false,
                        'queue' => 2,
                        'rating' => $playerRating
                    ];
                }
            }
        }

        if (($playersRatingWaiting = Cache::hgetall(static::QUEUES["rating_waiters"]))) {
            foreach ($playersRatingWaiting as $player => $data) {
                if ($player != $this->User) {
                    $playerInfo = unserialize($data);
                    $playerRating = PlayerModel::getRatingByCookie($player);
                    if (
                        $playerRating >= $ratingWanted
                        &&
                        (PlayerModel::getRatingByCookie($this->User)) >= $playerInfo['from_rating']
                    ) {
                        return [
                            'cookie' => $player,
                            'options' => $data['options'] ?? false,
                            'queue' => self::RATING_QUEUE,
                            'rating' => $playerRating
                        ];
                    }
                }
            }
        }

        return false;
    }

    protected function findWaitingRaitingPlayer($curPlayerRating)
    {
        if (($playersRatingWaiting = Cache::hgetall(static::QUEUES["rating_waiters"]))) {
            foreach ($playersRatingWaiting as $player => $data) {
                if ($player != $this->User) {
                    $data = unserialize($data);
                    if ($curPlayerRating >= $data['from_rating']) {
                        return [
                            'cookie' => $player,
                            'options' => $data['options'] ?? false,
                            'queue' => static::RATING_QUEUE,
                            'rating' => PlayerModel::getRatingByCookie($player),
                        ];
                    }
                }
            }
        }

        return false;
    }

    protected function gatherUserData()
    {
        if (isset($this->POST[self::TURN_TIME_PARAM_NAME])) {
            return $this->POST;
        }

        $players2Queue = Cache::hget(
            static::QUEUES["2players_waiters"],
            $this->User
        );
        if ($players2Queue && ($players2Queue['options'] ?? false)) {
            return $players2Queue['options'];
        }

        return $this->getUserPrefs() ?: ['num_players' => 2, 'turn_time' => rand(60, 120)];
    }

    protected function makeReverseRatingGame(array $ratingPlayer): array
    {
        $thisUserOptions = $this->gatherUserData();

        if (
            // Удалили ожидающего рейтинг игрока из очереди рейтинга
            self::cleanUp($ratingPlayer['cookie'])
            &&
            self::cleanUp($this->User)
            &&
            self::addToQueue("2players_waiters", $ratingPlayer['cookie'], $ratingPlayer['options'])
            //Поместили ожидающего рейтинг игрока в очередь текущего игрока
            &&
            self::addToQueue("2players_waiters", $this->User, $thisUserOptions)
        ) {
            return $this->makeGame('2', 2, $ratingPlayer['rating']);
        } else {
            return $this->chooseGame();
        }
    }

    protected function makeRatingGame(array $ratingPlayer): array
    {
        $waiterData = Cache::hget(static::QUEUES["rating_waiters"], $this->User);

        if ($ratingPlayer['queue'] == self::RATING_QUEUE) {
            $playerData = Cache::hget(static::QUEUES["rating_waiters"], $ratingPlayer['cookie']);

            if (!(
                self::cleanUp($ratingPlayer['cookie'])
                &&
                self::addToQueue("2players_waiters", $ratingPlayer['cookie'], $playerData['options'])
            )) {
                return $this->chooseGame();
            }
        }

        if (
            self::cleanUp($this->User)
            &&
            self::addToQueue(
                "2players_waiters",
                $this->User,
                $waiterData['options'],
                ['time' => $waiterData['time']]
            )
        ) {
            return $this->makeGame('2', 2, $ratingPlayer['rating']);
        } else {
            return $this->chooseGame();
        }
    }

    protected function timeToWaitRatingPlayerOver($User)
    {
        $waiterData = Cache::hget(static::QUEUES["rating_waiters"], $User);

        if ((date('U') - $waiterData['time']) > $this->caller->ratingGameWaitLimit) {
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
        $waiterData = Cache::hget(static::QUEUES["rating_waiters"], $User) ?: [];
        if (self::cleanUp($User)) {
            return $this->storeTo2Players($User, $waiterData['options'] ?? []);
        }

        return null;
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
                'timeWaiting' => date('U') - $this->userTime,
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

        $game_users = [];
        $this->caller->currentGameUsers = [];

        $waitingPlayers = Cache::hgetall(static::QUEUES["{$queue}players_waiters"]);
        $prefs = $this->getUserPrefs();

        if (!isset($waitingPlayers[$this->User])) {
            $options = $prefs;
        } else {
            $waitingPlayers[$this->User] = unserialize($waitingPlayers[$this->User]);

            $options = $waitingPlayers[$this->User]['options'] ?? $prefs;

            unset($waitingPlayers[$this->User]);
            reset($waitingPlayers);
        }

        // Прописываем текущему юзеру - добавление в игру,  номер игры, удаляем из очереди ждунов
        $game_users[] = ['userCookie' => $this->User, 'options' => $options];

        self::cleanUp($this->User);
        $this->caller->setUserGameNumber($this->User, $this->caller->currentGame);

        $this->caller->currentGameUsers[] = $this->User;

        foreach ($waitingPlayers as $player => $data) {
            if ($wishRating && PlayerModel::getRatingByCookie($player) != $wishRating) {
                continue;
            }

            if (!Cache::lock($player)) {
                continue;
            }

            $prefs = $this->getUserPrefs($player);
            $data = unserialize($data);

            //Прописываем юзерам - удаление из очереди и номер игры
            if (!self::cleanUp($player)) {
                continue;
            }

            $this->caller->setUserGameNumber($player, $this->caller->currentGame);

            $options = $data['options'] ?? $prefs;
            $game_users[] = ['userCookie' => $player, 'options' => $options];

            //Заполняем массив игроков
            $this->caller->currentGameUsers[] = $player;

            if (count($game_users) >= $maxNumUsers) {
                break;
            }
        }

        if (count($game_users) < 2) {
            // игра не собралась - отменяем, помещаем игрока обратно в очередь 2
            return $this->storeTo2Players($this->User, $game_users[0]['options'] ?? []);
        }

        // Определяем ставку в монетах как минимальную из ставок игроков
        $bid = 0;
        $noCoinGame = false;
        foreach ($game_users as $num => $user) {
            $userBalance = BalanceModel::getBalance(PlayerModel::getPlayerCommonId($user['userCookie'], true));

            // todo иногда ставка делает баланс игрока отрицательным. Нужно не давать балансу уходить в минус

            if (!isset($user['options']['bid'])) {
                if ($userBalance > 0) {
                    $user['options']['bid'] = self::getBid($userBalance);
                }
            } elseif ($user['options']['bid'] > $userBalance) {
                unset($user['options']['bid']);
            }

            if (!isset($user['options']['bid'])) {
                $noCoinGame = true;
            } elseif ($bid == 0 || $bid > $user['options']['bid'] || $bid > $userBalance) {
                $bid = $user['options']['bid'];
            }
        }

        if ($noCoinGame) {
            $bid = 0;
        }

        if ($bid) {
            DB::transactionStart(); // транзакция поверх транзакций баланса
        }

        foreach ($game_users as $num => $user) {
            $playerCommonId = PlayerModel::getPlayerCommonId($user['userCookie'], true);
            $this->caller->gameStatus->users[$num] = new GameUser(
                [
                    'ID' => $user['userCookie'],
                    'common_id' => $playerCommonId,
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
                    'wishTurnTime' => $user['options'] !== false ? $user['options'][self::TURN_TIME_PARAM_NAME] : 0,
                    'rating' => CommonIdRatingModel::getRating($playerCommonId, $this->caller::GAME_NAME),
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

            $this->caller->gameStatus->{$user['userCookie']} = $num;
            // Заполнили массив нормеров игроков

            $this->caller->updateUserStatus($this->caller->SM::GAME_STATE_START_GAME, $user['userCookie']);
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
        if (!Cache::hget(static::QUEUES["inviteplayers_waiters"], $User)) {

            $options = $this->getUserPrefs($User);

            self::addToQueue("inviteplayers_waiters", $User, $options);
        }

        $newStatus = $this->caller->updateUserStatus($this->caller->SM::STATE_INIT_GAME, $User, true);

        return Response::state($newStatus)
            + [
                'gameSubState' => Cache::hlen(static::QUEUES['inviteplayers_waiters']),
                'gameWaitLimit' => $this->caller->gameWaitLimit,
                'timeWaiting' => 0,
                'comments' => VH::h6(T::S('Awaiting invited players'))
            ];
    }

    protected function players2Waiting($User): bool
    {
        if ($cnt = Cache::hlen(static::QUEUES["2players_waiters"])) {
            if (!Cache::hget(static::QUEUES["2players_waiters"], $User)) {
                return true;
            } elseif ($cnt > 1) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $User
     * @param array $options
     * @return string[]
     */
    protected function storeTo2Players($User, $options = []): array
    {
        if (empty($options)) {
            $options = $this->getUserPrefs($User);
        }

        if (!Cache::hget(static::QUEUES["2players_waiters"], $User)) {
            if (!self::addToQueue("2players_waiters", $User, $options)) {
                return $this->chooseGame();
            }
        }

        $newStatus = $this->caller->updateUserStatus($this->caller->SM::STATE_INIT_GAME, $User, true);

        return Response::state($newStatus)
            + [
                'gameSubState' => Cache::hlen(static::QUEUES["2players_waiters"]),
                'gameWaitLimit' => $this->caller->gameWaitLimit,
                'comments' => VH::h6(T::S('Searching for players'))
            ];
    }

    protected function addToQueue(string $queue, string $user, $options, array $params = []): bool
    {
        if (Cache::lock($user)) {
            return (bool)Cache::hset(
                static::QUEUES[$queue],
                $user,
                array_merge(['time' => date('U'), 'options' => $options], $params)
            );
        }

        return false;
    }

    private function playerWaitTooLong(): bool
    {
        $userInQueueRecord = Cache::hget(static::QUEUES['2players_waiters'], $this->User);

        if (!$userInQueueRecord) {
            return false;
        }

        return (date('U') - $userInQueueRecord['time'] > 60);
    }

    private function getBotPlayer(): string
    {
        $config = include(__DIR__ . '/../../configs/conf.php');

        return 'botV3#' . array_rand($config['botNames']);
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
}
