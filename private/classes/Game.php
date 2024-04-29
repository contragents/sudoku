<?php


namespace classes;


use GameDataModel;

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

    public ?GameStatus $gameStatus = null;

    public array $currentGameUsers;
    public int $currentGame;
    public int $gameWaitLimit;

    public static function getCacheKey(string $lastKeyPart): string {
        return static::GAME_NAME . $lastKeyPart;
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
        return 10; // todo добавить реальное колво игроков онлайн
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

    protected function getGameStatus(): ?object
    {
        return Cache::get(self::getCacheKey(self::GAME_DATA_KEY . $this->currentGame)) ?: null;
    }

    public function storeGameStatus(bool $updating = true)
    {
        Cache::setex(
            self::getCacheKey(self::GAME_DATA_KEY . $this->currentGame),
            self::CACHE_TIMEOUT,
            $updating ? $this->gameStatus : false
        );
    }

    protected function destruct()
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

    protected function getCurrentGame()
    {
        return Cache::get(self::getCacheKey(self::GET_GAME_KEY . $this->User));
    }

    public function setUserGame(string $User, int $gameNumber)
    {
        Cache::setex(self::getCacheKey(self::GET_GAME_KEY . $User), self::CACHE_TIMEOUT, $gameNumber);
    }
}