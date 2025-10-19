<?php


namespace classes;


class Desk
{
    public array $desk = [];

    protected ?int $newEntity = null; // Новая цифра, присланная пользоватлем
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


    /**
     * ЗАГЛУШКА!!! Нужно переделать под каждую игру.
     * Сравнивает новую ячейку и старую ячейку с учетом формата данных конкретной игры
     * @param $cellNew
     * @param $cellOld
     * @return bool
     */
    protected function equivalentCells($cellNew, $cellOld): bool
    {
        return $cellNew == $cellOld;
    }

}