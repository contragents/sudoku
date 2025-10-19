<?php

namespace classes;

class DeskSkipbo extends Desk
{
    private const CARDS = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
    private const NUM_KOLODA = 14;

    public array $desk = [1 => [], 2 => [], 3 => [], 4 => []]; // Кучки карт №№1..4 (карты от 1 до 12)
    public array $koloda = []; // Колода из 168 карт с учетом розданных карт и карт, добавляемых при сборе кучек карт №№1..4

    public function __construct()
    {
        // Создаем массив из NUM_KOLODA CARDS массивов
        $arrayOfArrays = array_fill(0,self::NUM_KOLODA, self::CARDS);

        // Объединяем все массивы в один
        $this->koloda = array_merge(...$arrayOfArrays);
        shuffle($this->koloda);
    }

    /**
     * Получает $cardNum крт из колоды, уменьшая колоду
     * @param int $cardNum
     * @return array
     */
    public function getCardsFromKoloda(int $cardNum): array
    {
        return array_splice($this->koloda, 0, $cardNum);
    }
}
