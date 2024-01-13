<?php

namespace classes;

use BaseController;

class StateMachine
{
    public static ?string $cookieKey = null;

    const CACHE_TTL = 60 * 60;

    const STATE_NO_GAME = 'noGame'; // Статус, в котором ничего не происходит. Ждем пока юзер нажмет Новая игра
    const STATE_CHOOSE_GAME = 'chooseGame'; // Выбор режима игры (время на ход и т.д.)
    const STATE_INIT_GAME = 'initGame'; // Статус подбора игры, ждем соперника
    const STATE_NEW_GAME = 'newGame'; // Когда с сервера прилетает этот статус, начинаем новую игру
    const STATE_START_GAME = 'startGame'; // Игра началась
    const STATE_PRE_MY_TURN = 'preMyTurn'; // Мой ход следующий
    const STATE_MY_TURN = 'myTurn'; // Мой ход
    const STATE_OTHER_TURN = 'otherTurn'; // Ход не мой и мой ход не следующий
    const STATE_GAME_RESULTS = 'gameResults'; // Игра закончена, смортим результаты

    const DEFAULT_STATUS = self::STATE_NO_GAME;

    const STATE_REFRESH_DELAY = [
        self::STATE_CHOOSE_GAME => 0,
        self::STATE_INIT_GAME => 10,
        self::STATE_START_GAME => 10,
        self::STATE_MY_TURN => 10,
        self::STATE_PRE_MY_TURN => 10,
        self::STATE_OTHER_TURN => 20,
        self::STATE_GAME_RESULTS => 10,
        self::STATE_NO_GAME => 10,
        self::STATE_NEW_GAME => 10,
    ];

    const STATE_MACHINE = [
        self::STATE_CHOOSE_GAME => [
            self::STATE_INIT_GAME,
            self::STATE_NEW_GAME,
        ],
        self::STATE_INIT_GAME => [
            self::STATE_START_GAME => self::STATE_START_GAME,
            self::STATE_MY_TURN => self::STATE_MY_TURN,
            self::STATE_PRE_MY_TURN => self::STATE_PRE_MY_TURN,
            self::STATE_NEW_GAME => self::STATE_NEW_GAME,
            self::STATE_NO_GAME => self::STATE_NO_GAME,
        ],
        self::STATE_START_GAME => [
            self::STATE_MY_TURN => self::STATE_MY_TURN,
            self::STATE_PRE_MY_TURN => self::STATE_PRE_MY_TURN,
            self::STATE_OTHER_TURN => self::STATE_OTHER_TURN,
            self::STATE_NEW_GAME => self::STATE_NEW_GAME,
            self::STATE_GAME_RESULTS => self::STATE_GAME_RESULTS,
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

    private static ?string $gamePrefix = null;
    const PLAYER_STATUS_PREFIX = 'player_status_';

    public function __construct(string $cookieKey, string $gamePrefix)
    {
        static::$cookieKey = $cookieKey;
        static::$gamePrefix = $gamePrefix;
    }

    public static function getPlayerStatus()
    {
        return Cache::get(self::getPlayerStatusKeyPrefix() . BaseController::$User) ?: self::DEFAULT_STATUS;
    }

    public static function noGame()
    {
        return self::STATE_MACHINE[self::STATE_NO_GAME][self::STATE_CHOOSE_GAME];
    }

    public static function chooseGame()
    {
        return self::STATE_MACHINE[self::STATE_CHOOSE_GAME][self::STATE_INIT_GAME];
    }

    public static function initGame()
    {
        return self::STATE_MACHINE[self::STATE_INIT_GAME][self::STATE_MY_TURN];
    }

    public static function myTurn()
    {
        return self::STATE_MACHINE[self::STATE_MY_TURN][self::STATE_GAME_RESULTS];
    }

    public static function gameResults()
    {
        return self::STATE_MACHINE[self::STATE_GAME_RESULTS][self::STATE_NEW_GAME];
    }

    public static function newGame()
    {
        return self::STATE_NEW_GAME;
    }

    public static function setPlayerStatus(string $newStatus): string
    {
        $oldStatus = self::getPlayerStatus();
        if (self::canChangeStatus($oldStatus, $newStatus)) {
            Cache::setex(self::getPlayerStatusKeyPrefix() . BaseController::$User, self::CACHE_TTL, $newStatus);

            return $newStatus;
        } else {
            return $oldStatus;
        }
    }

    private static function getPlayerStatusKeyPrefix(): string
    {
        return static::$gamePrefix . self::PLAYER_STATUS_PREFIX;
    }

    private static function canChangeStatus(string $oldStatus, string $newStatus): bool
    {
        return in_array($newStatus, self::STATE_MACHINE[$oldStatus]);
    }
}