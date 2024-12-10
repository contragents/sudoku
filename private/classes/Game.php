<?php


namespace classes;

use BaseController;
use CommonIdRatingModel;
use GamesModel;
use PlayerModel;
use UserModel;

class Game
{
    const CACHE_TIMEOUT = StateMachine::CACHE_TTL;
    const TURN_DELTA_TIME = 10; // Разрешенное превышение длительности хода

    public const GAME_NAME = 'sudoku';
    public const GAME_ID_KEY = '.num_games';
    public const GAME_DATA_KEY = '.current_game_';
    public const GET_GAME_KEY = '.get_game_';
    public const GAME_USERS_KEY = '.game_users_';

    const GAMES_COUNTER = 'erudit.num_games';

    const GAMES_ENDED_KEY = '.games_ended';
    const RATING_INIT_TIMEOUT = 360;

    const RESPONSE_PARAMS = [
        'desk' => ['gameStatus' => ['desk' => 'desk']],
        'mistakes' => ['gameStatus' => ['desk' => 'mistakes']],
        'game_number' => ['gameStatus' => 'gameNumber'], // todo зачем 2 одинаковых параметра в ответе?
        'current_game' => 'currentGame', // current_game = game_number
        'common_id' => 'getCurrentPlayerCommonId',
        'timeLeft' => 'getTimeLeft',
        'secondsLeft' => 'getTurnSecondsLeft',
        'minutesLeft' => 'getTurnMinutesLeft',
        'yourUserNum' => 'numUser',
        'comments' => 'getLastUserComment',
        'activeUser' => ['gameStatus' => 'activeUser'],
        self::SPECIAL_PARAMS => [
            StateMachine::STATE_CHOOSE_GAME => [
                'players_test' => 'onlinePlayers',
                'coin_players_test' => 'onlineCoinPlayers',
            ],
        ],
        'score_arr' => 'getPlayerScores',
        'log' => 'getLog',
    ];
    const SPECIAL_PARAMS = 'special';

    public ?string $User;
    public ?int $numUser = null;
    public int $commonId;
    public Queue $Queue;

    public ?GameStatus $gameStatus = null;
    public StateMachine $SM;

    public ?array $Response = null;

    public array $currentGameUsers = [];
    public ?int $currentGame = null;
    public int $gameWaitLimit = 60;
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
        $secretKey = Config::$envConfig['SALT'];
        $method = 'AES-128-CBC';
        $iv = base64_decode(Config::$envConfig['IV'] . '==');
        $encrypted_message = openssl_encrypt($messageToEncrypt, $method, $secretKey, 0, $iv);

        return $encrypted_message;
    }

    public function mergeTheIDs($encryptedMessage, $commonID, $secretKey = '')
    {
        $secretKey = $secretKey ?: Config::$envConfig['SALT'];
        $method = 'AES-128-CBC';
        $iv = base64_decode(Config::$envConfig['IV'] . '==');
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
        return $this->gameStatus !== null && $this->numUser !== null
            ? ($this->gameStatus->users[$this->numUser]->common_id ?? null)
            : null;
    }

    public static function getCacheKey(string $lastKeyPart): string
    {
        return static::GAME_NAME . $lastKeyPart;
    }

    public function __construct(string $queueClass)
    {
        $this->SM = BaseController::$SM;

        $this->User = BaseController::$User;

        $this->Queue = new $queueClass($this->User, $this, BaseController::$Request);

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
                $this->numUser = $this->gameStatus->{$this->User};


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
            $this->gameStatus->turnTime = 120;
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

            foreach ($this->gameStatus->users as $num => $user) {
                // Заполнили массив нормеров игроков
                $this->gameStatus->{$user->ID} = $num;

                $this->gameStatus->users[$num]->common_id = (int)PlayerModel::getPlayerCommonId($user->ID, true);
                $userRating = CommonIdRatingModel::getRating(
                    $this->gameStatus->users[$num]->common_id,
                    static::GAME_NAME
                );
                $this->gameStatus->users[$num]->rating = $userRating ?: 0;
            }

            // Создали состояние доски
            $this->gameStatus->desk = $this->newDesk();

            //Номер пользователя по порядку
            $this->numUser = $this->gameStatus->{$this->User};
        }

        $this->doSaveGameState = true;

        return Response::state($this->SM::getPlayerStatus($this->User));
    }

    protected function isBot(): bool
    {
        return false;
    }

    public static function getNewGameId(): int
    {
        $gameId = Cache::incr(self::getCacheKey(self::GAMES_COUNTER));

        if ($gameId == 1) {
            $gameId = GamesModel::getLastId() + 1;
            Cache::set(static::GAMES_COUNTER, $gameId);
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

    public function onlinePlayers()
    {
        return []; // todo добавить реальное колво игроков онлайн
    }

    public function onlineCoinPlayers()
    {
        return []; // todo добавить реальное колво игроков онлайн
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
        return Cache::get(
            self::getCacheKey(self::GAME_DATA_KEY . ($gameNumber ?: $this->currentGame))
        ) ?: new GameStatus();
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

    public function setUserGameNumber(string $User, int $gameNumber)
    {
        Cache::setex(self::getCacheKey(self::GET_GAME_KEY . $User), self::CACHE_TIMEOUT, $gameNumber);
    }

    public function clearUserGameNumber(string $User = null)
    {
        $User = $User ?? $this->User;

        Cache::del(self::getCacheKey(self::GET_GAME_KEY . $User));
    }

    public function newGame(): array // todo проверить, кто вызывает этот метод
    {
        $this->Queue::cleanUp($this->User);

        if ($this->currentGame && ($_REQUEST['gameState'] ?? '') == $this->SM::STATE_INIT_GAME) {
            return $this->checkGameStatus();
            //Пользователь думает, что находится в подборе игры, но игра уже началась
        }

        // Удалили указатель на текущую игру для пользователя
        $this->clearUserGameNumber($this->User);

        if ($this->currentGame && ($this->numUser ?? false) !== false) {
            $this->gameStatus->users[$this->numUser]->isActive = false;
            //Игрок стал неактивен
            $this->addToLog("has left the game", $this->numUser);
            $left = true;
        }

        $this->SM::setPlayerStatus($this->SM::STATE_NEW_GAME);
        $this->SM::setPlayerStatus($this->SM::STATE_NO_GAME);

        return Response::state($this->SM::setPlayerStatus($this->SM::STATE_CHOOSE_GAME))
            + ['gameSubState' => 'choosing']
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
        if(!$this->gameStatus) {
            return null;
        }

        $log = [];

        while ($logRecord = array_shift($this->gameStatus->users[$this->numUser]->logStack)) {
            $log[] = trim(
                (
                $logRecord[0] !== false
                    ? $this->gameStatus['users'][$logRecord[0]]['username']
                    : ''
                )
                . ' ' . $logRecord[1]
            );
        }

        return $log ?: null;
    }

    protected function addToLog($message, $numUser = false)
    {
        $this->gameStatus->gameLog[] = [$numUser, $message];
        foreach ($this->gameStatus->users as $num => $User) {
            $this->gameStatus->users[$num]->logStack[] = [$numUser, $message];
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

    protected function resultsResponse(): array
    {
        $desk = $this->gameStatus->desk;
        return [
            'gameState' => $this->SM::STATE_GAME_RESULTS,
            'comments' => $this->gameStatus->results['winner'] == $this->User
                ? "<strong style=\"color:green;\">Вы выиграли!</strong><br/>Начните новую игру"
                : "<strong style=\"color:red;\">Вы проиграли!</strong><br/>Начните новую игру",
            ($desk ? 'desk' : 'nothing') => $desk
        ];
    }

    protected function lost3TurnsWinner($numLostUser, bool $pass = false): string
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

        $this->addToLog(
            $pass
                ? 'сдался'
                : 'пропустил 3 хода! Победитель - ' . $this->gameStatus->users[$userWinner]->username . ' со счетом ' . $this->gameStatus->users[$userWinner]->score,
            $numLostUser
        );

        return $this->gameStatus->users[$userWinner]->ID;
    }

    protected function nextTurn()
    {
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
                $this->addToLog('остался в игре один - Победа!', $this->numUser);

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
    protected function storeGameResults(string $winnerUser)
    {
        $results = [];

        foreach ($this->gameStatus->users as $numUser => $user) {
            if ($user->ID == $winnerUser) {
                $results['winner'] = $winnerUser;
                $user->addComment('Вы выиграли!');

                $this->addToLog('Игрок' . ($numUser + 1) . ' выиграл!');
            } else {
                $results['lostUsers'][] = $user->ID;
                $user->addComment('Вы проиграли!');
            }
        }

        $this->gameStatus->results = $results;
        // Новая версия

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
    }

    public function checkGameStatus(): array
    {
        if (!$this->currentGame) {
            if ($this->Queue::isUserInQueue($this->User)) {
                return $this->startGame();
            }

            $this->updateUserStatus($this->SM::STATE_NEW_GAME);
            $this->updateUserStatus($this->SM::STATE_NO_GAME);
            $this->updateUserStatus($this->SM::STATE_CHOOSE_GAME);

            $chooseGameParams = Response::state($this->SM::getPlayerStatus($this->User))
                + [
                    'gameSubState' => 'choosing',
                    'players' => $this->onlinePlayers(),
                    'coin_players' => $this->onlineCoinPlayers(),
                    'prefs' => $this->Queue->getUserPrefs($this->User),
                    'reason' => 'No currentGame'
                ];

            return $chooseGameParams;
        }

        if ($this->numActiveGameUsers() < 2) {
            if (!count($this->gameStatus->results)) {
                $this->storeGameResults($this->User);
                $this->addToLog('остался в игре один - Победа!', $this->numUser);
                //Пользователь остался в игре один и выиграл
            } else {
                $this->addToLog('остался в игре один! Начните новую игру', $this->numUser);
            }
        }

        if ($this->SM::getPlayerStatus($this->User) == $this->SM::STATE_GAME_RESULTS) {
            if (isset($this->gameStatus->results['winner'])) {
                return $this->resultsResponse();
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

        if ((date('U') - $this->gameStatus->turnBeginTime) > ($this->gameStatus->turnTime + static::TURN_DELTA_TIME)) {
            $this->addToLog('Время хода истекло', $this->gameStatus->activeUser);

            $this->gameStatus->users[$this->gameStatus->activeUser]->lostTurns++;
            $this->gameStatus->users[$this->gameStatus->activeUser]->inactiveTurn = $this->gameStatus->turnNumber;
            unset($this->gameStatus->users[$this->gameStatus->activeUser]->lastActiveTime);
            //Помечаем игрока неактивным

            if ($this->gameStatus->users[$this->gameStatus->activeUser]->lostTurns >= 3) {
                $this->storeGameResults($this->lost3TurnsWinner($this->gameStatus->activeUser));

                if (isset($this->gameStatus->results['winner'])) {
                    return $this->resultsResponse();
                }
            } else {
                $this->nextTurn();
            }
        }

        $userStatus = $this->SM::getPlayerStatus($this->User);

        return Response::state($userStatus);
    }

    public function startGame()
    {
        if ($this->currentGame && is_array($this->currentGameUsers)) {
            return $this->gameStarted(false);
            //Вернули статус начатой игры без обновления статусов в кеше
        }

        return $this->Queue->doSomethingWithThisStuff();
    }

    public function submitTurn(): array
    {
        return Response::state($this->SM::getPlayerStatus($this->User));
    }

    public static function hash_str_2_int($str, $len = 16)
    {
        $hash_int = base_convert("0x" . substr(md5($str), 0, $len), 16, 10);
        return $hash_int;
    }
}