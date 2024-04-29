<?php


namespace classes;


class GameUser
{
    public string $ID;
    public string $status;
    public bool $isActive = true;
    public int $score = 0;
    public string $username;
    public string $avatarUrl;
    public int $wishTurnTime = 0;
    public int $lastRequestNum = 0;
    public int $lastActiveTime = 0;
    public int $inactiveTurn = 0;
    public int $lostTurns =0;
    public int $rating = 0;
    public int $common_id;
    public array $logStack = [];

    private array $data = [];

    public function __construct(array $params) {
        foreach($params as $attribute => $value) {
            $this->$attribute = $value;
        }
    }

    public function __get($attribute)
    {
        return $this->data[$attribute] ?? null;
    }

    public function __set($attribute, $value)
    {
        return $this->data[$attribute] = $value;
    }
}