<?php


namespace classes;

use GameDataModel;

/** @property GameStatus $gameStatus */

class Game
{
    const CACHE_TIMEOUT = 30000;
    const RATINGS_CACHE_TIMEOUT = 200;
    const TURN_DELTA_TIME = 10; // Разрешенное превышение длительности хода
    const ACTIVITY_TIMEOUT = 30;

    public const GAME_NAME = 'sudoku';
    public const GAME_ID_KEY = '.num_games';
    public const GAME_DATA_KEY = '.current_game_';
    public const GET_GAME_KEY = '.get_game_';
    public const GAME_USERS_KEY = '.game_users_';
    const GAMES_ENDED_KEY = '.games_ended';
    const RATING_INIT_TIMEOUT = 360;

    protected ?string $User;
    protected int $numUser;
    protected Queue $Queue;

    public GameStatus $gameStatus;
    public StateMachine $SM;

    public array $currentGameUsers = [];
    public int $currentGame;
    public int $gameWaitLimit = 60;
    public int $ratingGameWaitLimit = 360;

    public static function getCacheKey(string $lastKeyPart): string {
        return static::GAME_NAME . $lastKeyPart;
    }

    public function __construct()
    {
    }

    public static function getNewGameId(): int
    {
        $gameId = Cache::incr(self::getCacheKey(self::GAME_ID_KEY));
        if ($gameId == 1) {
            $gameId = GameDataModel::getLastGameId(static::GAME_NAME) + 1;
        }

        return $gameId;
    }

    public function makeGame(string $User, string $numPlayers, array $Request = [])
    {
    }

    public function newDesk()
    {
        return new Desk;
    }

    public function onlinePlayers()
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

    protected function getGameStatus(): ?GameStatus
    {
        return Cache::get(self::getCacheKey(self::GAME_DATA_KEY . $this->currentGame)) ?: new GameStatus();
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
        if ($this->currentGame) {
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

    protected function getCurrentGameNumber()
    {
        return Cache::get(self::getCacheKey(self::GET_GAME_KEY . $this->User));
    }

    public static function getUserGameNumber(string $user): ?int
    {
        return Cache::get(self::getCacheKey(self::GET_GAME_KEY . $user));
    }

    public function setUserGameNumber(string $User, int $gameNumber)
    {
        Cache::setex(self::getCacheKey(self::GET_GAME_KEY . $User), self::CACHE_TIMEOUT, $gameNumber);
    }

    public function clearUserGameNumber(string $User)
    {
        Cache::del(self::getCacheKey(self::GET_GAME_KEY . $User));
    }

    public function newGame(): array
    {
        return [];
    }

    public function checkGameStatus(): array
    {
        return [];
    }

    public function updateUserStatus($newStatus, $user = false, bool $force = false): bool
    {
        $user = $user ?: $this->User;
        $validStatus = $this->SM::setPlayerStatus($newStatus, $user, $force);

        if ($validStatus == $this->SM::STATE_MY_TURN) {
            $this->gameStatus->activeUser = (int)$this->gameStatus->$user;
        }

        return $validStatus === $newStatus;
    }
}