<?php


namespace classes;


/** @property GameUser[] $users */

class GameStatus
{
    public array $users; // GameUser[]
    public ?object $desk = null; // игровая доска, объект
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

    private array $data = [];

    public function __get($attribute)
    {
        return $this->data[$attribute] ?? null;
    }

    public function __set($attribute, $value)
    {
        return $this->data[$attribute] = $value;
    }
}