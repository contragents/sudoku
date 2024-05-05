<?php


namespace classes;


class Desk
{
    public array $desk = [];

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
}