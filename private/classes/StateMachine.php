<?php

namespace classes;

use BaseController;

class StateMachine
{
    private static ?string $gamePrefix = null;
    public static ?string $cookieKey = null;

    const CACHE_TTL = 60 * 60;
    const LOCK_WAIT_TTL = 10;

    const CHECK_STATUS_RESULTS_KEY = 'game_results_';
    const CHECK_STATUS_RESULTS_KEY_TTL = 24 * 60 * 60;

    // Game states
    const GAME_STATE_START_GAME = 'startGame'; // Игра началась

    // Player states
    const STATE_WAITING = 'waiting'; // Статус ни о чем - клиент должен переотправить запрос checkStatus
    const STATE_NO_GAME = 'noGame'; // Статус, в котором ничего не происходит. Ждем пока юзер нажмет Новая игра
    const STATE_CHOOSE_GAME = 'chooseGame'; // Выбор режима игры (время на ход и т.д.)
    const STATE_INIT_GAME = 'initGame'; // Статус подбора игры, ждем соперника
    const STATE_NEW_GAME = 'newGame'; // Когда с сервера прилетает этот статус, начинаем новую игру
    const STATE_PRE_MY_TURN = 'preMyTurn'; // Мой ход следующий
    const STATE_MY_TURN = 'myTurn'; // Мой ход
    const STATE_OTHER_TURN = 'otherTurn'; // Ход не мой и мой ход не следующий
    const STATE_GAME_RESULTS = 'gameResults'; // Игра закончена, смортим результаты

    const DEFAULT_STATUS = self::STATE_CHOOSE_GAME;

    const IN_GAME_STATES = [
        self::STATE_MY_TURN,
        self::STATE_OTHER_TURN,
        self::STATE_PRE_MY_TURN,
        self::STATE_GAME_RESULTS,
    ];

    const STATE_REFRESH_DELAY = [
        self::STATE_CHOOSE_GAME => 0,
        self::STATE_INIT_GAME => 10,
        self::STATE_MY_TURN => 10,
        self::STATE_PRE_MY_TURN => 10,
        self::STATE_OTHER_TURN => 20,
        self::STATE_GAME_RESULTS => 10,
        self::STATE_NO_GAME => 10,
        self::STATE_NEW_GAME => 10,
    ];

    const STATE_MACHINE = [
        self::STATE_WAITING => '*',
        self::STATE_CHOOSE_GAME => [
            self::STATE_INIT_GAME => self::STATE_INIT_GAME,
            self::STATE_NEW_GAME => self::STATE_NEW_GAME,
        ],
        self::STATE_INIT_GAME => [
            self::STATE_MY_TURN => self::STATE_MY_TURN,
            self::STATE_PRE_MY_TURN => self::STATE_PRE_MY_TURN,
            self::STATE_OTHER_TURN => self::STATE_OTHER_TURN,
            self::STATE_NEW_GAME => self::STATE_NEW_GAME,
            self::STATE_NO_GAME => self::STATE_NO_GAME,
        ],
        self::STATE_MY_TURN => [
            self::STATE_PRE_MY_TURN => self::STATE_PRE_MY_TURN,
            self::STATE_OTHER_TURN => self::STATE_OTHER_TURN,
            self::STATE_NEW_GAME => self::STATE_NEW_GAME,
            self::STATE_GAME_RESULTS => self::STATE_GAME_RESULTS,
        ],
        self::STATE_PRE_MY_TURN => [
            self::STATE_MY_TURN => self::STATE_MY_TURN,
            self::STATE_OTHER_TURN => self::STATE_OTHER_TURN,
            self::STATE_NEW_GAME => self::STATE_NEW_GAME,
            self::STATE_GAME_RESULTS => self::STATE_GAME_RESULTS,
        ],
        self::STATE_OTHER_TURN => [
            self::STATE_MY_TURN => self::STATE_MY_TURN,
            self::STATE_PRE_MY_TURN => self::STATE_PRE_MY_TURN,
            self::STATE_NEW_GAME => self::STATE_NEW_GAME,
            self::STATE_GAME_RESULTS => self::STATE_GAME_RESULTS,
        ],
        self::STATE_GAME_RESULTS => [
            self::STATE_NEW_GAME => self::STATE_NEW_GAME,
        ],
        self::STATE_NO_GAME => [
            self::STATE_CHOOSE_GAME => self::STATE_CHOOSE_GAME,
        ],
        self::STATE_NEW_GAME => [
            self::STATE_NO_GAME => self::STATE_NO_GAME,
        ], // Пока просто перезагружаем игру, если прилетел статус NEW_GAME
    ];

    const PLAYER_STATUS_PREFIX = 'player_status_';

    public function __construct(string $cookieKey, string $gamePrefix)
    {
        static::$cookieKey = $cookieKey;
        static::$gamePrefix = $gamePrefix;
    }

    public static function getPlayerStatus($User = null)
    {
        $User = $User ?? BaseController::$User;
        self::lockTry($User);

        $status = Cache::get(static::getKeyPrefix(self::PLAYER_STATUS_PREFIX) . $User) ?: self::DEFAULT_STATUS;

        if (in_array($status, static::IN_GAME_STATES)) {
            self::lockTry(static::getGameNum($User));

            // Получаем статус еще раз
            $status = Cache::get(static::getKeyPrefix(self::PLAYER_STATUS_PREFIX) . $User) ?: self::DEFAULT_STATUS;
        }

        return $status;
    }

    public static function setPlayerStatus(string $newStatus, string $User = null, bool $force = false): string
    {
        $User = $User ?? BaseController::$User;

        $oldStatus = self::getPlayerStatus($User);
        if ($force || self::canChangeStatus($oldStatus, $newStatus)) {
            Cache::setex(self::getKeyPrefix(self::PLAYER_STATUS_PREFIX) . $User, self::CACHE_TTL, $newStatus);

            return $newStatus;
        } else {
            return $oldStatus;
        }
    }

    private static function getKeyPrefix(string $key): string
    {
        return static::$gamePrefix . $key;
    }

    private static function canChangeStatus(string $oldStatus, string $newStatus): bool
    {
        return is_array(static::STATE_MACHINE[$oldStatus])
            ? in_array($newStatus, static::STATE_MACHINE[$oldStatus])
            : static::STATE_MACHINE[$oldStatus] === '*';
    }

    private static function lockTry(string $name): bool
    {
        return Cache::waitLock($name);
    }

    protected static function getGameNum($user): int
    {
        return SudokuGame::getUserGameNumber($user) ?: 0;
    }
}