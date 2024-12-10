<?php


namespace classes;


class Desk
{
    public array $desk = [];

    protected ?int $newEntity = null;
    protected ?int $newEntityI = null;
    protected ?int $newEntityJ = null;

    const NUM_COLS = 9;
    const NUM_ROWS = 9;

    public function __construct()
    {
        for ($i = 0; $i < static::NUM_COLS; $i++) {
            for ($j = 0; $j < static::NUM_ROWS; $j++) {
                $this->desk[$i][$j] = false;
            }
        }
    }

    // нужно переделать под каждую игру
    protected function equivalentCells($cellNew, $cellOld)
    {
        return $cellNew[1] == $cellOld;
    }

}