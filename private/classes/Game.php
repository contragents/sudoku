<?php


namespace classes;


use AchievesModel;
use BalanceHistoryModel;
use BalanceModel;
use BanModel;
use BaseController as BC;
use CommonIdRatingModel;
use ComplainModel;
use GamesModel;
use PayController;
use PlayerModel;
use RatingHistoryModel;
use UserModel;
use classes\ViewHelper as VH;

class Game
{
    const CACHE_TIMEOUT = StateMachine::CACHE_TTL;
    const TURN_DELTA_TIME = 10; // Разрешенное превышение длительности хода

    public const GAME_NAME = 'sudoku';
    public const GAME_DATA_KEY = '.current_game_'; // Получает состояние игры по номеру
    public const GET_GAME_KEY = '.get_game_'; // Получает игру пользователя
    public const GAME_USERS_KEY = '.game_users_'; // Список игроков в игре
    const STATS_FAILED = 'games_statistics_failed';

    const GAMES_COUNTER = 'erudit.num_games'; // общий счетчик на все игры

    const GAMES_ENDED_KEY = '.games_ended';
    const RATING_INIT_TIMEOUT = 360;

    const RESPONSE_PARAMS = [
        'debug' => 'debug',
        'desk' => ['gameStatus' => ['desk' => 'desk']],
        'gameNumber' => ['gameStatus' => 'gameNumber'],
        'isInviteGame' => ['gameStatus' => 'isInviteGame'],
        'common_id' => 'getCurrentPlayerCommonId',
        'common_id_hash' => 'getCommonIdHash',
        'timeLeft' => 'getTimeLeft',
        'secondsLeft' => 'getTurnSecondsLeft',
        'minutesLeft' => 'getTurnMinutesLeft',
        'yourUserNum' => 'numUser',
        'comments' => 'getLastUserComment',
        'activeUser' => ['gameStatus' => 'activeUser'],
        'score_arr' => 'getPlayerScores',
        'log' => 'getLog',
        BC::GAME_STATE_PARAM => 'getPlayerStatus',
        'winScore' => ['gameStatus' => 'gameGoal'],
        'bid' => ['gameStatus' => 'bid'],
        'bank' => 'getBank',
        'bank_string' => 'getBankString',
        'is_opponent_active' => 'isOpponentActive',
        'chat' => 'getNewChatMessages',
        self::SPECIAL_PARAMS => [
            StateMachine::STATE_GAME_RESULTS => [
                'active_users' => 'getActiveUsersCount',
            ],
        ],
    ];

    // Параметры, которые не отдаем при определенных статусах
    const EXCLUDED_PARAMS = [
        StateMachine::STATE_CHOOSE_GAME => [
            'desk',
            'mistakes',
            'gameNumber',
            'timeLeft',
            'secondsLeft',
            'minutesLeft',
            'yourUserNum',
            'comments',
            'activeUser',
            'score_arr',
            'log',
            'winScore',
            'bid',
            'bank',
            'bank_string',
            'is_opponent_active',
            'chat',
        ],
        StateMachine::STATE_INIT_GAME => [
            'is_opponent_active',
            'chat',
        ],
        StateMachine::STATE_INIT_RATING_GAME => [
            'is_opponent_active',
            'chat',
        ],
    ];

    const SPECIAL_PARAMS = 'special';
    const BOT_TPL = 'botV3#';
    const NUM_RATING_PLAYERS_KEY = '.num_rating_players';
    const RATINGS_CACHE_TIMEOUT = 200;
    const NUM_COINS_PLAYERS_KEY = '.num_coins_players';
    const TIME_VARIANTS = [60 => 0, 90 => 0, 120 => 0];
    const DEFAUTL_TURN_TIME = 120;
    public static array $players = []; // онлайн игроки

    public ?string $User;
    public ?int $numUser = null;
    public Queue $Queue;

    public ?GameStatus $gameStatus = null;
    public StateMachine $SM;

    public ?array $Response = null;

    public array $currentGameUsers = [];
    public ?int $currentGame = null;
    const GAME_DEFAULT_WAIT_LIMIT = 30;
    public int $gameWaitLimit = self::GAME_DEFAULT_WAIT_LIMIT; // SUD-42 чтобы первые игроки не ждали долго // todo гдето сделать вычисление как в эрудите
    public int $ratingGameWaitLimit = 360;

    protected bool $doSaveGameState = false;

    public function __get($attribute)
    {
        if (is_callable([$this, $attribute])) {
            return $this->$attribute();
        } else {
            return null;
        }
    }

    public function debug(): ?array
    {
        return json_decode(json_encode($this->gameStatus ?? []), true);
    }

    public function getCommonIdHash(): ?string
    {
        return PayController::getCommonIdHash(BC::$commonId);
    }

    public static function getCacheKey(string $lastKeyPart): string
    {
        return static::GAME_NAME . $lastKeyPart;
    }

    public function __construct(string $queueClass)
    {
        $this->SM = BC::$SM;

        $this->User = BC::$User;

        $this->Queue = new $queueClass($this->User, $this, BC::$Request);

        // Если не удалось дождаться лока по текущему игроку, то посылаем desync и выходим
        if (!Cache::lock($this->User)) {
            $this->Response = $this->desync() + ['reason' => 'User lock failed'];

            return $this;
        }

        $this->currentGame = $this->getCurrentGameNumber();

        if (!$this->currentGame) {
            return $this;
        } else {
            $this->currentGameUsers = $this->getGameUsers();

            if (!Cache::lock($this->currentGame)) {
                //Вышли с Десинком, если не смогли получить Лок игры
                $this->Response = $this->desync() + ['reason' => 'Game lock failed'];

                return $this;
            }

            $this->doSaveGameState = true;

            //Забрали статус игры из кэша
            $this->gameStatus = $this->getGameStatus();


            // Проверим, правильно ли загрузилась игра
            if ($this->gameStatus->gameNumber !== $this->currentGame) {
                $this->clearUserGameNumber($this->User);
                $this->currentGameUsers = $this->clearGameUsers();
                $this->currentGame = false;

                return $this;
            }

            try {
                if ($this->gameStatus->{$this->User} === null) {
                    $this->Response = $this->newGame();

                    return $this;
                }

                //Номер пользователя по порядку
                $this->numUser = (int)$this->gameStatus->{$this->User};


                if (isset($_GET['page_hidden']) && $_GET['page_hidden'] == 'true') {
                    if (isset($_GET['queryNumber']) && $_GET['queryNumber'] < ($this->gameStatus->users[$this->numUser]->lastRequestNum ?? 0)) {
                        throw new BadRequest('Num packet error when returned from page_hidden state');
                    }
                }
            } catch (BadRequest $e) {
                $this->Response = BadRequest::sendBadRequest(
                    [
                        'err_msg' => $e->getMessage(),
                        // 'err_file' => $e->getFile(),
                        // 'err_line' => $e->getLine(),
                        // 'err_context' => $e->getTrace(),
                    ]
                );

                return $this;
            }

            $this->gameStatus->users[$this->numUser]->lastRequestNum
                =
                $_GET['queryNumber'] ?? $this->gameStatus->users[$this->numUser]->lastRequestNum;

            if (!(isset($_GET['page_hidden']) && $_GET['page_hidden'] == 'true')) {
                //Обновили время активности, если это не закрытие вкладки
                $this->gameStatus->users[$this->numUser]->lastActiveTime = date('U');
                $this->gameStatus->users[$this->numUser]->inactiveTurn = 1000;
            }
        }
    }

    public function gameStarted($statusUpdateNeeded = false): array
    {
        if ($statusUpdateNeeded) {
            $firstTurnUser = rand(0, count($this->currentGameUsers) - 1);
            $this->gameStatus->gameNumber = $this->currentGame;
            $this->gameStatus->activeUser = $firstTurnUser;
            $this->gameStatus->gameBeginTime = date('U');
            $this->gameStatus->turnBeginTime = $this->gameStatus->gameBeginTime;
            $this->gameStatus->turnNumber = 1;
            $this->gameStatus->firstTurnUser = $firstTurnUser;
            $this->gameStatus->turnTime = $this->makeWishTime();
            $this->gameStatus->aquiringTimes[$this->gameStatus->turnNumber] = false;
            $this->updateUserStatus($this->SM::STATE_MY_TURN, $this->currentGameUsers[$firstTurnUser]);
            //Назначили ход случайному юзеру

            $ost = ($firstTurnUser - 1) % count($this->gameStatus->users);
            if ($ost >= 0) {
                $preMyTurnUser = $ost;
            } else {
                $preMyTurnUser = count($this->gameStatus->users) + $ost;
            }

            $this->updateUserStatus($this->SM::STATE_PRE_MY_TURN, $this->currentGameUsers[$preMyTurnUser]);
            //Вычислили игрока, идущего за первым и дали ему статус преМайТерн

            // Создали состояние доски
            $this->gameStatus->desk = $this->newDesk();

            //Номер пользователя по порядку
            $this->numUser = (int)$this->gameStatus->{$this->User};
        }

        $this->doSaveGameState = true;

        return Response::state($this->SM::getPlayerStatus($this->User));
    }

    public static function isBot(string $User): bool
    {
        return !(strstr($User, self::BOT_TPL) === false);
    }

    public static function getNewGameId(): int
    {
        $gameId = Cache::incr(self::GAMES_COUNTER);

        if ($gameId == 1) {
            $gameId = GamesModel::getLastId() + 1;
            Cache::set(self::GAMES_COUNTER, $gameId);
        }

        return $gameId;
    }

    /**
     * Возвращает новую игровую доску
     * См. метод наследника под конкретную игру
     * @return Desk
     */
    public function newDesk(): Desk
    {
        return new Desk;
    }

    public function exitGame(?int $numuser = null)
    {
        if (!$numuser) {
            $numuser = $this->numUser;
        }

        $this->clearUserGameNumber($this->gameStatus->users[$numuser]->ID);
        //Удалили указатель на текущую игру для пользователя

        $this->gameStatus->users[$numuser]->isActive = false;
        //Игрок стал неактивен

        foreach (T::SUPPORTED_LANGS as $lang) {
            $this->addToLog(T::S('left game', null, $lang), $lang, $numuser);
        }
    }

    public function processInvites(): array
    {
        $inviteState = [];
        $gameSubState = $this->gameStatus->invite;

        if ($this->gameStatus->invite === $this->SM::NEW_INVITE_GAME_STARTED_STATE) {
            $gameSubState .= rand(1, 100);
            $inviteState['gameSubState'] = $gameSubState;
            $inviteState['inviteStatus'] = $this->SM::NEW_INVITE_GAME_STARTED_STATE;

            $this->exitGame($this->numUser);

            $this->Queue->storePlayerToInviteQueue($this->User);

            return $inviteState;
        }

        $numActiveUsers = $this->getActiveUsersCount();
        $gameSubState .= $numActiveUsers;
        $inviteState['comments'] = '';

        if ($this->gameStatus->invite === $this->User) {
            $inviteState['comments'] .= "<br />"
                . T::S("Asking for adversaries' approval.")
                . "<br />"
                . T::S('Remaining in the game:')
                . " $numActiveUsers";
            $inviteState['inviteStatus'] = $this->SM::WAITING_INVITE_ANSWER_STATE;
        } else {
            if ($numActiveUsers) {
                $inviteState['comments'] .= '<br />' . T::S('You got invited for a rematch! - Accept?');
            } else {
                $inviteState['comments'] .= '<br />' . T::S('All players have left the game');
            }
            $inviteState['inviteStatus'] = $this->SM::DECIDING_INVITE_ANSWER_STATE;
        }

        $inviteState['active_users'] = $numActiveUsers;
        $inviteState['gameSubState'] = $gameSubState . $inviteState['inviteStatus'] . $inviteState['active_users'];

        return $inviteState;
    }

    protected function getPlayers()
    {
        $lastGame = Cache::get(self::GAMES_COUNTER);
        // todo Добавить анализ названия игры, а не все игры подряд
        for ($i = $lastGame; $i > ($lastGame - 50); $i--) {
            $game = $this->getGameStatus($i);
            if ($game && $game instanceof GameStatus && $game->gameName === static::GAME_NAME && !empty($game->users)) {
                if (!empty($game->results)) {
                    foreach ($game->users as $num => $user) {
                        if (!isset($user->ID)) {
                            continue;
                        }

                        if (!self::isBot($user->ID)) {
                            self::$players[$user->ID] = [
                                'cookie' => $user->ID,
                                'common_id' => $user->common_id,
                            ];
                        }
                    }
                }
            }
        }
    }

    public function onlinePlayers(): array
    {
        if (!($rangedOnlinePlayers = Cache::get(static::NUM_RATING_PLAYERS_KEY))) {
            if (empty(self::$players)) {
                $this->getPlayers();
            }

            $rangedOnlinePlayers = [
                0 => date('H') < 6 ? rand(1, 10) : rand(15, 50),
                1900 => 0,
                2000 => 0,
                2100 => 0,
                2200 => 0,
                2300 => 0,
                2400 => 0,
                2500 => 0,
                2600 => 0,
                2700 => 0
            ];

            $coinPlayers = array_combine(MonetizationService::BIDS, array_fill(0, count(MonetizationService::BIDS), 0));
            $thisPlayerBalance = BalanceModel::getBalance(BC::$commonId);

            foreach (self::$players as $num => $player) {
                $rangedOnlinePlayers[0]++;

                $currentPlayerBalance = BalanceModel::getBalance($player['common_id']);

                // Отмечаем в массиве игроков на монеты число игроков с таким количеством монет
                foreach ($coinPlayers as $bid => $num) {
                    if ($thisPlayerBalance < $bid) {
                        unset($coinPlayers[$bid]);

                        continue;
                    }

                    if ($currentPlayerBalance >= $bid) {
                        $coinPlayers[$bid]++;
                    }
                }

                if (($rating = CommonIdRatingModel::getRating(
                    $player['common_id'],
                    static::GAME_NAME
                ))) {
                    if ($rating > 1900) {
                        $rangedOnlinePlayers[1900]++;
                    }
                    if ($rating > 2000) {
                        $rangedOnlinePlayers[2000]++;
                    }
                    if ($rating > 2100) {
                        $rangedOnlinePlayers[2100]++;
                    }
                    if ($rating > 2200) {
                        $rangedOnlinePlayers[2200]++;
                    }
                    if ($rating > 2300) {
                        $rangedOnlinePlayers[2300]++;
                    }
                    if ($rating > 2400) {
                        $rangedOnlinePlayers[2400]++;
                    }
                    if ($rating > 2500) {
                        $rangedOnlinePlayers[2500]++;
                    }
                    if ($rating > 2600) {
                        $rangedOnlinePlayers[2600]++;
                    }
                    if ($rating > 2700) {
                        $rangedOnlinePlayers[2700]++;
                    }
                }
            }


            Cache::setex(
                static::NUM_RATING_PLAYERS_KEY,
                self::RATINGS_CACHE_TIMEOUT,
                $rangedOnlinePlayers
            );
        }

        if ($rangedOnlinePlayers[1900]) {
            $cnt = Cache::hlen($this->Queue::QUEUES['rating_waiters']);
            if ($cnt < ($rangedOnlinePlayers[1900] / 2)) {
                $thisUserRating = CommonIdRatingModel::getRating(
                    BC::$commonId,
                    static::GAME_NAME
                );

                $rangedOnlinePlayers['thisUserRating'] = $thisUserRating;

                return $rangedOnlinePlayers;
            }
        }

        return $rangedOnlinePlayers;
    }

    public function onlineCoinPlayers(): array
    {
        if (empty(self::$players)) {
            $this->getPlayers();
        }

        $coinPlayers = array_combine(MonetizationService::BIDS, array_fill(0, count(MonetizationService::BIDS), 0));
        $thisPlayerBalance = BalanceModel::getBalance(BC::$commonId);

        // Чистим массив ставок от ставок больше баланса игрока
        foreach ($coinPlayers as $bid => $num) {
            if ($thisPlayerBalance < $bid) {
                unset($coinPlayers[$bid]);
            }

            // ...а также от мелких ставок
            if ($bid < ($thisPlayerBalance / 20)) {
                unset($coinPlayers[$bid]);
            }
        }

        foreach (self::$players as $num => $player) {
            $currentPlayerBalance = BalanceModel::getBalance($player['common_id']);

            // Отмечаем в массиве игроков на монеты число игроков с таким количеством монет
            foreach ($coinPlayers as $bid => $num) {
                if ($currentPlayerBalance >= $bid) {
                    $coinPlayers[$bid]++;
                }
            }
        }

        $coinPlayers['thisUserBalance'] = $thisPlayerBalance;

        Cache::setex(
            static::NUM_COINS_PLAYERS_KEY,
            self::RATINGS_CACHE_TIMEOUT,
            $coinPlayers
        );

        return $coinPlayers;
    }

    public function saveGameUsers(int $currentGame, array $currentGameUsers)
    {
        // Сохраняем список игроков в игре
        Cache::setex(
            self::getCacheKey(self::GAME_USERS_KEY . $currentGame),
            self::CACHE_TIMEOUT,
            $currentGameUsers
        );
    }

    public function saveUserLastActivity(string $User)
    {
        // todo нигде не используется
        Cache::setex(
            self::getCacheKey(self::GAME_USERS_KEY . $User . '_last_activity'),
            self::CACHE_TIMEOUT,
            date('U')
        );
    }

    protected function getGameUsers(): array
    {
        return Cache::get(self::getCacheKey(self::GAME_USERS_KEY . $this->currentGame)) ?: [];
    }

    protected function clearGameUsers(): array
    {
        Cache::del(self::getCacheKey(self::GAME_USERS_KEY . $this->currentGame));

        return [];
    }

    public function getGameStatus(int $gameNumber = null): GameStatus
    {
        $gameStatus = Cache::get(
            self::getCacheKey(self::GAME_DATA_KEY . ($gameNumber ?: $this->currentGame))
        );

        if (!($gameStatus instanceof GameStatus)) {
            $gameStatus = new GameStatus();
        }

        return $gameStatus;
    }

    public function storeGameStatus(bool $updating = true)
    {
        Cache::setex(
            self::getCacheKey(self::GAME_DATA_KEY . $this->currentGame),
            self::CACHE_TIMEOUT,
            $updating ? $this->gameStatus : false
        );
    }

    public function __destruct()
    {
        if ($this->currentGame && $this->doSaveGameState) {
            if (isset($this->gameStatus->results['winner']) && !$this->gameStatus->isGameEndedSaved) {
                Cache::rpush(static::GAMES_ENDED_KEY, $this->gameStatus);
                //Сохраняем результаты игры в список завершенных
                $this->gameStatus->isGameEndedSaved = true;
            }

            $this->gameStatus->users[$this->numUser]->lastRequestNum = $_GET['queryNumber'] ?? 1000;

            $this->storeGameStatus();
        }

        $this->saveUserLastActivity($this->User);
    }

    protected function getCurrentGameNumber(): ?int
    {
        return Cache::get(self::getCacheKey(self::GET_GAME_KEY . $this->User)) ?: null;
    }

    public static function getUserGameNumber(string $user): ?int
    {
        return Cache::get(self::getCacheKey(self::GET_GAME_KEY . $user)) ?: null;
    }

    /**
     * @param QueueUser[] $users
     */
    public function unsetUsersGameNumber(array $users)
    {
        foreach($users as $user) {
            Cache::del(self::getCacheKey(self::GET_GAME_KEY . $user->cookie));
        }
    }

    public function setUserGameNumber(string $User, int $gameNumber)
    {
        Cache::setex(self::getCacheKey(self::GET_GAME_KEY . $User), self::CACHE_TIMEOUT, $gameNumber);
    }

    public function clearUserGameNumber(?string $User = null)
    {
        $User = $User ?? $this->User;

        Cache::del(self::getCacheKey(self::GET_GAME_KEY . $User));
    }

    public function newGame(): array // todo проверить, кто вызывает этот метод
    {
        $this->Queue::cleanUp($this->User);

        if ($this->currentGame && (in_array(BC::$Request[BC::GAME_STATE_PARAM] ?? '', StateMachine::INIT_STATES))) {
            return $this->checkGameStatus();
            //Пользователь думает, что находится в подборе игры, но игра уже началась
        }

        // Удалили указатель на текущую игру для пользователя
        $this->clearUserGameNumber($this->User);

        if ($this->currentGame && ($this->numUser ?? false) !== false) {
            $this->gameStatus->users[$this->numUser]->isActive = false;
            //Игрок стал неактивен
            foreach (T::SUPPORTED_LANGS as $lang) {
                $this->addToLog(T::S('has left the game', null, $lang), $lang, $this->numUser);
            }

            if (count($this->gameStatus->users) == 2 && empty($this->gameStatus->results)) {
                $this->storeGameResults($this->gameStatus->users[($this->numUser + 1) % 2]->ID);

                foreach (T::SUPPORTED_LANGS as $lang) {
                    $this->addToLog(T::S('is the only one left in the game - Victory!', null, $lang), $lang, ($this->numUser + 1) % 2);
                }
            }

            $left = true;
        }

        $this->SM::setPlayerStatus($this->SM::STATE_NEW_GAME);
        $this->SM::setPlayerStatus($this->SM::STATE_NO_GAME);

        return $this->Queue->chooseGame(true)
            + ['left' => $left ?? false];
    }

    public function updateUserStatus($newStatus, $user = false, bool $force = false): string
    {
        $user = $user ?: $this->User;
        $validStatus = $this->SM::setPlayerStatus($newStatus, $user, $force);

        if ($validStatus == $this->SM::STATE_MY_TURN) {
            $this->gameStatus->activeUser = (int)$this->gameStatus->$user;
        }

        return $validStatus;
    }

    public function desync($queryNumber = false): array
    {
        $arr = Response::state($this->SM::STATE_DESYNC);
        $arr['noDialog'] = true;

        if ($queryNumber) {
            $arr['queryNumber'] = $queryNumber;
        }

        return $arr;
    }

    public function getLog(): ?array
    {
        if (!$this->gameStatus) {
            return null;
        }

        $log = [];

        if (!isset($this->gameStatus->users[$this->numUser]->logStack[T::$lang])) {
            $this->gameStatus->users[$this->numUser]->logStack[T::$lang] = [];
        }

        while ($logRecord = array_shift($this->gameStatus->users[$this->numUser]->logStack[T::$lang])) {
            $log[] = trim(
                (
                $logRecord[0] !== false
                    ? $this->gameStatus->users[$logRecord[0]]->usernameLangArray[T::$lang]
                    : ''
                )
                . ' ' . $logRecord[1]
            );
        }

        return $log ?: null;
    }

    public function addToLog($message, string $lang, ?int $numUser = null)
    {
        if(!isset($this->gameStatus->gameLog[$lang])) {
            $this->gameStatus->gameLog[$lang] = [];
        }
        $this->gameStatus->gameLog[$lang][] = [$numUser ?? false, $message];

        foreach ($this->gameStatus->users as $num => $User) {
            if(!isset($this->gameStatus->users[$num]->logStack[$lang])) {
                $this->gameStatus->users[$num]->logStack[$lang] = [];
            }

            $this->gameStatus->users[$num]->logStack[$lang][] = [$numUser ?? false, $message];
        }
    }

    protected function numActiveGameUsers(): int
    {
        $numActive = 0;
        foreach ($this->gameStatus->users as $user) {
            if ($user->isActive) {
                $numActive++;
            }
        }

        return $numActive;
    }

    public function initGame()
    {
        return $this->Queue->doSomethingWithThisStuff();
    }

    /*
    protected function resultsResponse(): array
    {
        $desk = $this->gameStatus->desk;
        return [
            BC::GAME_STATE_PARAM => $this->SM::STATE_GAME_RESULTS,
            'comments' => $this->gameStatus->results['winner'] == $this->User
                ? "<strong style=\"color:green;\">Вы выиграли!</strong><br/>Начните новую игру"
                : "<strong style=\"color:red;\">Вы проиграли!</strong><br/>Начните новую игру",
            ($desk ? 'desk' : 'nothing') => $desk
        ];
    }
    */

    public function lost3TurnsWinner($numLostUser, bool $pass = false): string
    {
        $maxres = 0;
        $userWinner = 0;
        if ($this->gameStatus->users[$numLostUser]->score === 0) {
            $this->gameStatus->users[$numLostUser]->isActive = false;
        }

        foreach ($this->gameStatus->users as $num => $user) {
            if (($maxres <= $user->score) && $user->isActive && !($pass && $num == $numLostUser)) {
                $maxres = $user->score;
                $userWinner = $num;
            }
        }

        foreach (T::SUPPORTED_LANGS as $lang) {
            $this->addToLog(
                ($pass
                    ? T::S('gave up! Winner - ', null, $lang)
                    : T::S('skipped 3 turns! Winner - ', null, $lang)
                )
                . $this->gameStatus->users[$userWinner]->usernameLangArray[$lang]
                . T::S(' with score ', null, $lang)
                . $this->gameStatus->users[$userWinner]->score,
                $lang,
                $numLostUser
            );
        }

        return $this->gameStatus->users[$userWinner]->ID;
    }

    protected function nextTurn()
    {
        // Костыль проверка, что игра уже завершена - ничего не делать
        if (!empty($this->gameStatus->results)) {
            return;
        }

        foreach ($this->gameStatus->users as $numUser => $user) {
            // Дали всем игрокам статус - другойХодит
            $this->updateUserStatus($this->SM::STATE_OTHER_TURN, $user->ID);
        }

        $isActiveUserFound = false;

        $i = 0;

        while (!$isActiveUserFound && is_array($this->gameStatus->users) && count($this->gameStatus->users) > $i) {
            $nextActiveUser = ($this->gameStatus->activeUser + 1) % count($this->gameStatus->users);
            $this->gameStatus->activeUser = $nextActiveUser;
            if ($this->gameStatus->users[$nextActiveUser]->isActive) {
                $isActiveUserFound = true;
            }

            $i++;
        }

        if (!$isActiveUserFound) {
            if (count($this->gameStatus->users ?? [])) {
                $nextActiveUser = $this->numUser;
                $this->gameStatus->activeUser = $nextActiveUser;
            } else {
                $this->storeGameResults($this->User);
                foreach (T::SUPPORTED_LANGS as $lang) {
                    $this->addToLog(T::S('is the only one left in the game - Victory!', null, $lang), $lang, $this->numUser);
                }

                return; // todo что делать если нет ни одного юзера - заканчиваем игру
            }
        }

        $this->updateUserStatus($this->SM::STATE_MY_TURN, $this->gameStatus->users[$nextActiveUser]->ID);
        //Прописали статус новому активному пользователю

        $nextPreMyTurnUser = ($nextActiveUser + 1) % count($this->gameStatus->users);

        $this->updateUserStatus($this->SM::STATE_PRE_MY_TURN, $this->gameStatus->users[$nextPreMyTurnUser]->ID);
        //Прописали статус следующему преМайТерн-юзеру

        $this->gameStatus->turnNumber++;

        $this->gameStatus->turnBeginTime = date('U');
        $this->gameStatus->aquiringTimes[$this->gameStatus->turnNumber] = false;
    }

    /**
     * @param string $winnerUser user->ID
     */
    public function storeGameResults(string $winnerUser)
    {
        // results можно заполнять только один раз
        if (!empty($this->gameStatus->results)) {
            return;
        }

        $results = [];

        foreach ($this->gameStatus->users as $numUser => $user) {
            if ($user->ID == $winnerUser) {
                $results['winner'] = $winnerUser;

                foreach (T::SUPPORTED_LANGS as $lang) {
                    $this->addToLog(t::S('[[Player]] won!', [$numUser + 1], $lang), $lang);
                }

                // Начисляем победителю монеты
                if ($this->gameStatus->bid) {
                    $sudokuCount = $this->gameStatus->bid * count($this->gameStatus->users);

                    DB::transactionStart();

                    if (
                        !BalanceModel::changeBalance(
                            BalanceModel::SYSTEM_ID,
                            -1 * $sudokuCount,
                            $user->common_id . ' got winner reward',
                            BalanceHistoryModel::TYPE_IDS[BalanceHistoryModel::GAME_TYPE],
                            $this->currentGame
                        )
                        ||
                        !BalanceModel::changeBalance(
                            $user->common_id,
                            $sudokuCount,
                            'Winner reward',
                            BalanceHistoryModel::TYPE_IDS[BalanceHistoryModel::GAME_TYPE],
                            $this->currentGame
                        )) {
                        DB::transactionRollback();
                    } else {
                        DB::transactionCommit();

                        foreach (T::SUPPORTED_LANGS as $lang) {
                            $this->addToLog(T::S('gets a win', null, $lang) . ': ' . T::S('{{sudoku_icon_15}}') . $sudokuCount, $lang);
                        }
                    }
                }

            } else {
                $results['lostUsers'][] = $user->ID;
            }
        }

        $this->gameStatus->results = $results;

        foreach ($this->gameStatus->users as $num => $user) {
            $this->updateUserStatus($this->SM::STATE_GAME_RESULTS, $user->ID);

            if (
                !empty($user->ID)
                && !empty($this->gameStatus->users[$num]->last_request_num)
                && $this->gameStatus->users[$num]->last_request_num > 10
            ) {
                Cache::setex(
                    $this->SM::CHECK_STATUS_RESULTS_KEY . $user->ID,
                    $this->SM::CHECK_STATUS_RESULTS_KEY_TTL,
                    $this->gameStatus->users[$num]->last_request_num
                );
            }
        }

        $resultRatings = RatingService::processGameResult($this->gameStatus);
        foreach ($this->gameStatus->users as $numUser => $user) {
            $user->result_ratings = $resultRatings[$user->common_id];

            foreach (T::SUPPORTED_LANGS as $lang) {
                $user->addComment(
                    self::playerGameResultsRendered(
                        $results['winner'] == $user->ID,
                        $user->result_ratings,
                        $lang
                    ),
                    $lang
                );
            }

            if (RatingHistoryModel::getNumGamesPlayed($user->common_id, $this::GAME_NAME) % 100 == 0) {
                // Начисляем бонус за каждые 100 игр
                BalanceModel::changeBalance(
                    $user->common_id,
                    MonetizationService::REWARD[AchievesModel::DAY_PERIOD],
                    '100-game bonus' . ' ' . $this::GAME_NAME,
                    BalanceHistoryModel::TYPE_IDS[BalanceHistoryModel::MOTIVATION_TYPE]
                );
            }
        }
    }

    public function checkGameStatus(): array
    {
        if (!$this->currentGame) {
            if ($this->Queue::isUserInQueue($this->User)) {
                return $this->Queue->doSomethingWithThisStuff();
            }

            $this->updateUserStatus($this->SM::STATE_NEW_GAME);
            $this->updateUserStatus($this->SM::STATE_NO_GAME);
            $this->updateUserStatus($this->SM::STATE_CHOOSE_GAME);

            $chooseGameParams = $this->Queue->chooseGame(true)
                + ['reason' => 'No currentGame'];

            return $chooseGameParams;
        }

        if ($this->numActiveGameUsers() < 2) {
            if (empty($this->gameStatus->results)) {
                //Пользователь остался в игре один и выиграл
                $this->storeGameResults($this->User);
                foreach (T::SUPPORTED_LANGS as $lang) {
                    $this->addToLog(
                        t::S('is the only one left in the game - Victory!', null, $lang),
                        $lang,
                        $this->numUser
                    );
                }
            }
        }

        if ($this->SM::getPlayerStatus($this->User) == $this->SM::STATE_GAME_RESULTS) {
            if (isset($this->gameStatus->results['winner'])) {
                return [];
            }
        }

        //Поставим коррекцию времени начала хода для учета периодичности запросов пользователей
        if (
            $this->SM::getPlayerStatus($this->User) == $this->SM::STATE_MY_TURN
            &&
            !$this->gameStatus->aquiringTimes[$this->gameStatus->turnNumber]
        ) {
            if ((date('U') - $this->gameStatus->turnBeginTime) < static::TURN_DELTA_TIME) {
                $this->gameStatus->aquiringTimes[$this->gameStatus->turnNumber] = date('U');
            } else {
                $this->gameStatus->aquiringTimes[$this->gameStatus->turnNumber] = $this->gameStatus->turnBeginTime;
            }
        }

        if ($this->isActivePlayerBot() && date('U') - $this->gameStatus->turnBeginTime > 20) {
            $this->makeBotTurn($this->gameStatus->activeUser);
        } elseif (
            (date('U') - $this->gameStatus->turnBeginTime) > ($this->gameStatus->turnTime + static::TURN_DELTA_TIME)
        ) {
            foreach (T::SUPPORTED_LANGS as $lang) {
                $this->addToLog(
                    t::S('Time for the turn ran out', null, $lang),
                    $lang,
                    $this->gameStatus->activeUser
                );
            }

            foreach (T::SUPPORTED_LANGS as $lang) {
                $this->gameStatus->users[$this->gameStatus->activeUser]->addComment(T::S('Time for the turn ran out', null, $lang), $lang);
            }

            // Добавили коммент о пропуске хода всем игрокам
            foreach ($this->gameStatus->users as $numUser => $user) {
                if ($numUser !== $this->gameStatus->activeUser) {
                    foreach (T::SUPPORTED_LANGS as $lang) {
                        $user->addComment(
                            $this->gameStatus->users[$this->gameStatus->activeUser]->usernameLangArray[$lang]
                            . ' - ' . T::S('Time for the turn ran out', null, $lang),
                            $lang
                        );
                    }
                }
            }

            $this->gameStatus->users[$this->gameStatus->activeUser]->lostTurns++;
            $this->gameStatus->users[$this->gameStatus->activeUser]->inactiveTurn = $this->gameStatus->turnNumber;
            unset($this->gameStatus->users[$this->gameStatus->activeUser]->lastActiveTime);
            //Помечаем игрока неактивным

            if ($this->gameStatus->users[$this->gameStatus->activeUser]->lostTurns >= 3) {
                $this->storeGameResults($this->lost3TurnsWinner($this->gameStatus->activeUser));

                if (isset($this->gameStatus->results['winner'])) {
                    return [];
                }
            } else {
                $this->nextTurn();
            }
        }

        $userStatus = $this->SM::getPlayerStatus($this->User);

        return Response::state($userStatus);
    }

    public function submitTurn(): array
    {
        return Response::state($this->SM::getPlayerStatus($this->User));
    }

    public function addToChat(string $message, ?int $toNumUser = null, bool $needConfirm = true): array
    {
        try {
            $commonIdFrom = BC::$commonId;

            $bannedTill = BanModel::isBannedTotal($commonIdFrom ?: 0);
            if ($bannedTill) {
                if ($needConfirm) {
                    return [
                        'message' => T::S('Message NOT sent - BAN until ') . date('d.m.Y', $bannedTill)
                    ];
                } else {
                    return []; // Игрок забанен, подтверждение не нужно - пустой ответ
                }
            }

            $bannedBy = BanModel::bannedBy($commonIdFrom ?: 0);

            $this->gameStatus->chatLog[] = [$this->numUser, $toNumUser, $message];

            if ($toNumUser === null) {
                foreach ($this->gameStatus->users as $num => $User) {
                    if ($num == $this->numUser) {
                        $this->gameStatus->users[$num]->chatStack[] = [T::S('You'), T::S('to all: ') . $message];
                    } elseif (!isset($bannedBy[$User->common_id])) {
                        $this->gameStatus->users[$num]->chatStack[] = [
                            T::S('From player') . ($this->numUser + 1) . T::S(' (to all):'),
                            $message
                        ];
                    }
                }
            } elseif (!isset($bannedBy[$this->gameStatus->users[$toNumUser]->common_id])) {
                $this->gameStatus->users[$toNumUser]->chatStack[] = [
                    T::S('From player') . ($this->numUser + 1) . ":",
                    $message
                ];
                $this->gameStatus->users[$this->numUser]->chatStack[] = [
                    T::S('You'),
                    T::S('To Player') . ((int)$toNumUser + 1) . ': ' . $message
                ];
            } elseif ($needConfirm) {
                return [
                    'message' => VH::strong(T::S('Message NOT sent - BAN from Player') . ((int)$toNumUser + 1)),
                ];
            }

            if ($needConfirm) {
                return ['message' => T::S('Message sent')];
            } else {
                return [];
            }
        } catch (\Throwable $e) {
            return ['message' => T::S('Error sending message')];
        }
    }


    public static function hash_str_2_int($str, $len = 16)
    {
        $hash_int = base_convert("0x" . substr(md5($str), 0, $len), 16, 10);
        return $hash_int;
    }

    private function isActivePlayerBot(): bool
    {
        return stripos($this->gameStatus->users[$this->gameStatus->activeUser]->ID, 'botV3') !== false;
    }

    protected function makeBotTurn(int $botUserNum)
    {
    }

    public function getPlayerStatus(): string
    {
        return $this->SM::getPlayerStatus($this->User);
    }

    public function checkCommonIdUnsafe(?int $commonId = null): bool
    {
        if (!$commonId) {
            return false;
        }

        return $commonId === PlayerModel::getPlayerCommonId($this->User);
    }

    protected function playerGameResultsRendered(bool $isWinner, array $ratingsChanged, ?string $lang = null): string
    {
        return
            VH::strong(
                $isWinner ? T::S('you_won', null, $lang) : T::S('you_lost', null, $lang),
                ['style' => 'color:' . ($isWinner ? '#00ff00' : 'red') . ';']
            )
            . VH::br()
            . T::S('rating_changed', null, $lang)
            . "{$ratingsChanged['prev_rating']} -> "
            . VH::strong(
                "{$ratingsChanged['new_rating']} (" . ($isWinner ? '+' : '') . "{$ratingsChanged['delta_rating']})",
                ['style' => 'color:' . ($isWinner ? '#00ff00' : 'red') . ';']
            )
            . ($this->gameStatus->bid
                ? (
                    VH::br()
                    . T::S('The bank of', null, $lang) . ' '
                    . VH::strong(
                        number_format($this->gameStatus->bid * count($this->gameStatus->users), 0, '.', ',')
                    )
                    . T::S('{{sudoku_icon_15}}') . ' '
                    . ($isWinner ? T::S('goes to you', null, $lang) : T::S('is taken by the opponent', null, $lang))
                )
                : ''
            )
            . VH::br()
            . T::S('start_new_game', null, $lang);
    }

    public function addComplain(int $toNumUser): array
    {
        $message = T::S('Report sent');

        $isSendSuccess = false;
        if (ComplainModel::add(
            BC::$commonId,
            $this->gameStatus->users[$toNumUser]->common_id,
            $this->gameStatus->chatLog
        )) {
            $respMessage = '<span style="align-content: center;"><strong>'
                . T::S('Your report accepted and will be processed by moderator')
                . '<br /><br /> '
                . T::S('If confirmed, the player will be banned')
                . '</strong></span>';
            $isSendSuccess = true;
        } else {
            $respMessage = '<span style="align-content: center;"><strong><span style="color:red;">'
                . T::S('Report declined!')
                . '</span><br /><br /> '
                . T::S('Only one complaint per each player per day can be sent. Total 24 hours complaints limit is')
                . ' ' . ComplainModel::COMPLAINS_PER_DAY . '</strong></span>';
        }

        if ($isSendSuccess) {
            $this->addToChat($message, $toNumUser);
        }

        return ['message' => $respMessage];
    }

    protected function coinsPrompt(?string $lang = null): string
    {
        return ($this->gameStatus->bid ?? false
                ? (
                    VH::br()
                    . T::S('The bank of', null, $lang) . ' '
                    . VH::strong(
                        number_format($this->gameStatus->bid * count($this->gameStatus->users), 0, '.', ',')
                    )
                    . T::S('{{sudoku_icon_15}}') . ' '
                    . T::S('will go to the winner', null, $lang)
                )
                : ''
        );
    }

    protected function getStartComment(?int $numUser = null, ?string $lang = null): string
    {
        $res = '';

        return $res . T::S('New game has started!', null, $lang) . ' <br />'
            . T::S('Get', null, $lang) . ' '
            . VH::strong(T::S('[[number]] [[point]]', [$this->gameStatus->gameGoal, $this->gameStatus->gameGoal], $lang))
            . VH::br()
            . $this->gameStatus->users[$this->gameStatus->activeUser]->usernameLangArray[$lang]
            . T::S(' is making a turn.', null, $lang)
            . VH::br()
            . (
            isset($numUser)
                ? (T::S('Your current rank', null, $lang)
                . ' - ' . VH::strong($this->gameStatus->users[$numUser]->rating))
                : ''
            )
            . $this->coinsPrompt();
    }

    public function getBank(): ?int
    {
        return $this->gameStatus
            ? $this->gameStatus->bid * count($this->gameStatus->users)
            : null;
    }

    public function getBankString(): ?string
    {
        $bank = $this->getBank();
        if (!isset($bank)) {
            return null;
        }

        return $bank < 1000
            ? $bank
            : ($bank < 1000000
                ? ((string)(round($bank / 1000)) . 'K')
                : ((string)(round($bank / 1000000)) . 'M'));
    }

    public function getLastUserComment(): ?string
    {
        if ($this->gameStatus->users ?? null) {
            return $this->gameStatus->users[$this->numUser]->getLastComment();
        } else {
            return null;
        }
    }

    public function genKeyForCommonID($id)
    {
        $messageToEncrypt = $id;
        $secretKey = Config::$config['SALT'];
        $method = 'AES-128-CBC';
        $iv = base64_decode(Config::$config['IV'] . '==');
        $encrypted_message = openssl_encrypt($messageToEncrypt, $method, $secretKey, 0, $iv);

        return $encrypted_message;
    }

    public function mergeTheIDs($encryptedMessage, $commonID, $secretKey = '')
    {
        $secretKey = $secretKey ?: Config::$config['SALT'];
        $method = 'AES-128-CBC';
        $iv = base64_decode(Config::$config['IV'] . '==');
        $decrypted_message = openssl_decrypt($encryptedMessage, $method, $secretKey, 0, $iv);

        if (!is_numeric($decrypted_message)) {
            return json_encode(
                [
                    'result' => 'error_decryption' . ' ' . $decrypted_message,
                    'message' => T::S('Key transcription error')
                ],
                JSON_UNESCAPED_UNICODE
            );
        }

        $oldCommonID = UserModel::getCustom(
                'id',
                '=',
                $decrypted_message,
                false,
                false,
                ['id']
            )[0]['id'] ?? false;

        if ($oldCommonID === false) {
            return json_encode(
                [
                    'result' => 'error_query_oldID',
                    'message' => T::S("Player's ID NOT found by key")
                ],
                JSON_UNESCAPED_UNICODE
            );
        }

        if (PlayerModel::setParamMass(
            'common_id',
            $oldCommonID,
            [
                'field_name' => 'common_id',
                'condition' => '=',
                'value' => $commonID,
                'raw' => true
            ]
        )
        ) {
            return json_encode(
                [
                    'result' => 'save',
                    'message' => T::S('Accounts linked')
                ],
                JSON_UNESCAPED_UNICODE
            );
        } else {
            return json_encode(
                [
                    'result' => 'error_update ' . $oldCommonID . '->' . $commonID,
                    'message' => T::S('Accounts are already linked')
                ],
                JSON_UNESCAPED_UNICODE
            );
        }
    }

    public function getPlayerScores(): ?array
    {
        $score_arr = [];
        $countUsers = count($this->gameStatus->users ?? []);

        if (!$countUsers) {
            return null;
        }

        $score_arr[$this->numUser] = $this->gameStatus->users[$this->numUser]->score;
        for ($i = 1; $i < $countUsers; $i++) {
            $nextUserNum = ($this->numUser + $i) % $countUsers;
            $score_arr[$nextUserNum] = $this->gameStatus->users[$nextUserNum]->score;
        }

        return $score_arr ?: null;
    }

    public function getTurnSecondsLeft(): int
    {
        return $this->getTimeLeft() % 60;
    }

    public function getTurnMinutesLeft(): int
    {
        return floor($this->getTimeLeft() / 60);
    }

    public function getTimeLeft(): int
    {
        if (@($this->gameStatus->aquiringTimes[$this->gameStatus->turnNumber] > 0)) {
            @($turnTimeLeft = ($this->gameStatus->aquiringTimes[$this->gameStatus->turnNumber] + $this->gameStatus->turnTime) - date(
                    'U'
                ));
        } else {
            @$turnTimeLeft = $this->gameStatus->turnBeginTime + $this->gameStatus->turnTime - date('U');
        }

        $res = $turnTimeLeft ?? 0;
        return $res >= 0 ? $res : 0;
    }

    public function getCurrentPlayerCommonId(): ?int
    {
        return BC::$commonId;
    }

    public function getNewChatMessages(): ?array
    {
        if (count($this->gameStatus->users[$this->numUser]->chatStack)) {
            $log = [];
            while ($logRecord = array_shift($this->gameStatus->users[$this->numUser]->chatStack)) {
                $log[] = trim(
                    ($logRecord[0] !== false
                        ? (isset($this->gameStatus->users[$logRecord[0]])
                            ? $this->gameStatus->users[$logRecord[0]]->usernameLangArray[T::$lang]
                            : $logRecord[0])
                        : '')
                    . ' '
                    . $logRecord[1]
                );
            }

            return $log;
        }

        return null;
    }

    public function isOpponentActive(): ?bool
    {
        // Отдаем параметр только для двух игроков в игре
        if (isset($this->gameStatus->users) && count($this->gameStatus->users) === 2) {
            $numOpponent = $this->numUser === 1 ? 0 : 1;
            return
                isset($this->gameStatus->users[$numOpponent]->lastActiveTime)
                &&
                $this->gameStatus->users[$numOpponent]->isActive;
        } else {
            return null;
        }
    }

    public function getActiveUsersCount(): ?int
    {
        if (!($this->gameStatus ?? null) || !count($this->gameStatus->users)) {
            return null;
        }

        $numActiveUsers = 0;
        foreach ($this->gameStatus->users as $num => $user) {
            if ($num === $this->numUser) {
                continue;
            }

            if ($user->isActive && isset($user->lastActiveTime)) {
                $numActiveUsers++;
            } elseif (isset($this->gameStatus->invite_accepted_users[$user->ID])) { // todo настроить инвайты
                $numActiveUsers++;
            }
        }

        return $numActiveUsers;
    }

    protected function makeWishTime(): int
    {
        $korzinaGolosov = [];
        foreach ($this->gameStatus->users as $user) {
            if (isset($user->wishTurnTime)) {
                $korzinaGolosov[] = $user->wishTurnTime;
            }
        }

        if (!count($korzinaGolosov)) {
            return static::DEFAUTL_TURN_TIME;
        }

        $srednee = array_sum($korzinaGolosov) / count($korzinaGolosov);

        $variants = [];

        foreach (static::TIME_VARIANTS as $vremya => $delta) {
            $variants[$vremya] = abs($srednee - $vremya);
        }

        asort($variants);

        foreach ($variants as $vremya => $delta) {
            return $vremya;
        }
        //Голосование проведено

        return static::DEFAUTL_TURN_TIME;
    }
}