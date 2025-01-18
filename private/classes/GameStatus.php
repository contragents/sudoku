<?php


namespace classes;


/** @property GameUser[] $users */

class GameStatus
{
    public array $users; // GameUser[]
    public ?Desk $desk = null; // игровая доска, объект
    public ?int $gameNumber = null;
    public int $activeUser;
    public int $gameBeginTime;
    public int $turnBeginTime;
    public int $turnNumber;
    public int $firstTurnUser; // номер игрока на первый ход
    public int $turnTime;
    public array $aquiringTimes; // массив времени последнего действия пользователя
    public array $results = [];
    public bool $isGameEndedSaved = false;
    public array $gameLog = [];
    public int $gameGoal = 0; // Число очков для победы
    public int $bid = 0; // Ставка за партию в монетах

    private array $data = []; // Массив разных свойств по запросу

    public function __get($attribute)
    {
        return $this->data[$attribute] ?? null;
    }

    public function __set($attribute, $value)
    {
        return $this->data[$attribute] = $value;
    }
}