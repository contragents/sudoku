<?php

namespace classes;

use BaseController;

class StateMachine
{
    public const INIT_STATES = [self::STATE_INIT_GAME, self::STATE_INIT_RATING_GAME];
    public static ?string $gamePrefix = null;

    const CACHE_TTL = 60 * 60;
    const LOCK_WAIT_TTL = 10;

    const CHECK_STATUS_RESULTS_KEY = 'game_results_';
    const CHECK_STATUS_RESULTS_KEY_TTL = 24 * 60 * 60;

    // Player states
    const STATE_WAITING = 'waiting'; // Статус ни о чем - клиент должен переотправить запрос checkStatus
    const STATE_NO_GAME = 'noGame'; // Статус, в котором ничего не происходит. Ждем пока юзер нажмет Новая игра
    const STATE_CHOOSE_GAME = 'chooseGame'; // Выбор режима игры (время на ход и т.д.)
    const STATE_INIT_GAME = 'initGame'; // Статус подбора игры, ждем соперника
    const STATE_INIT_RATING_GAME = 'initRatingGame'; // Статус подбора игры, ждем соперника с рейтингом
    const STATE_NEW_GAME = 'newGame'; // Когда с сервера прилетает этот статус, начинаем новую игру
    const STATE_PRE_MY_TURN = 'preMyTurn'; // Мой ход следующий
    const STATE_MY_TURN = 'myTurn'; // Мой ход
    const STATE_OTHER_TURN = 'otherTurn'; // Ход не мой и мой ход не следующий
    const STATE_GAME_RESULTS = 'gameResults'; // Игра закончена, смортим результаты
    const STATE_DESYNC = 'desync'; // Рассинхрон / ошибка лока
    const GAME_STATE_START_GAME = 'startGame'; // Игра началась

    const DEFAULT_STATUS = self::STATE_CHOOSE_GAME;

    const IN_GAME_STATES = [
        self::STATE_MY_TURN,
        self::STATE_OTHER_TURN,
        self::STATE_PRE_MY_TURN,
        self::STATE_GAME_RESULTS,
        self::GAME_STATE_START_GAME,
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
        self::STATE_DESYNC => 5,
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
            self::GAME_STATE_START_GAME => self::GAME_STATE_START_GAME,
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
        self::GAME_STATE_START_GAME => [
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

    const PLAYER_STATUS_PREFIX = '.player_status_';

    public function __construct(string $gamePrefix)
    {
        static::$gamePrefix = $gamePrefix;
    }

    public static function getPlayerStatus($User = null): string
    {
        $User = $User ?? BaseController::$User;

        $status = Cache::get(static::getKeyPrefix(self::PLAYER_STATUS_PREFIX) . $User) ?: self::DEFAULT_STATUS;

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
        return static::STATE_MACHINE[$newStatus] ?? '' === '*'
        || is_array(static::STATE_MACHINE[$oldStatus])
            ? in_array($newStatus, static::STATE_MACHINE[$oldStatus])
            : static::STATE_MACHINE[$oldStatus] === '*';
    }

    protected static function getGameNum($user): int
    {
        return BaseController::$instance->Game::getUserGameNumber($user) ?: 0;
    }
}