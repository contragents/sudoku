<?php


namespace classes;


/**
 * @property GameUser[] $users
 * @property ?Desk $desk игровая доска, объект
 * @property ?int $gameNumber
 * @property int $activeUser
 * @property int $gameBeginTime
 * @property int $turnBeginTime
 * @property int $turnNumber
 * @property int $firstTurnUser номер игрока на первый ход
 * @property int $turnTime;
 * @property array $aquiringTimes массив времени последнего действия пользователя
 * @property array $results
 * @property bool $isGameEndedSaved
 * @property array $gameLog
 * @property int $gameGoal Число очков для победы
 * @property ?int $bid Ставка за партию в монетах
 * @property array $data Массив разных свойств по запросу
 * @property array $chatLog Лог чата игроков, нужен для сохранения в таблицу жалоб
 * @property array $invite_accepted_users = []; // Массив игроков принявших приглашение на реванш
 * @property string $invite Статус инвайта (игрок который пригласил или статус начала реванша)
 * @property bool $isInviteGame = null;
 * @property ?string $gameName Название игры
 */

class GameStatus
{
    public array $users;
    public ?Desk $desk = null;
    public ?int $gameNumber = null;
    public int $activeUser;
    public int $gameBeginTime;
    public int $turnBeginTime;
    public int $turnNumber;
    public int $firstTurnUser;
    public int $turnTime;
    public array $aquiringTimes;
    public array $results = [];
    public bool $isGameEndedSaved = false;
    public array $gameLog = [];
    public int $gameGoal = 0;
    public ?int $bid = null;
    public ?string $gameName = null;

    private array $data = [];
    public array $chatLog = [];
    public array $invite_accepted_users = [];
    public ?string $invite = null;
    public ?bool $isInviteGame = null;

    public function __get($attribute)
    {
        return $this->data[$attribute] ?? null;
    }

    public function __set($attribute, $value)
    {
        return $this->data[$attribute] = $value;
    }
}