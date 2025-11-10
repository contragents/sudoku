<?php

namespace classes;

class DeskSkipbo extends Desk
{
    public const CARDS = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

    public const SKIPBO_CARD = 1000;

    /** @var int NUM_SKIPBO Количество карт SKIPBO в игре */
    public const NUM_SKIPBO = 18;

    /** @var int NUM_KOLODA Количество колод карт 1-12 в игре */
    public const NUM_KOLODA = 12;

    public array $desk = [0 => [], 1 => [], 2 => [], 3 => []]; // Кучки карт №№1..4 (карты от 1 до 12)
    public array $koloda = []; // Колода из 168 карт с учетом розданных карт и карт, добавляемых при сборе кучек карт №№1..4

    public function checkNewDesc(array $newDesk): bool
    {
        // todo SB-8 make check
        return true;
    }

    public function __construct()
    {
        // Создаем массив из NUM_KOLODA CARDS массивов
        $arrayOfArrays = array_fill(0, self::NUM_KOLODA, self::CARDS);

        // Объединяем все массивы в один
        $this->koloda = array_merge(
            array_fill(0, self::NUM_SKIPBO, self::SKIPBO_CARD), // SKIP-BO карты
            ...$arrayOfArrays // Карты 1..12
        );

        shuffle($this->koloda);
    }

    /**
     * Получает $cardNum крт из колоды, уменьшая колоду
     * @param int $cardNum
     * @return array
     */
    public function getCardsFromKoloda(int $cardNum, ?array $indices = null): array
    {
        $cardSet = array_splice($this->koloda, 0, $cardNum);

        if(!isset($indices)) {
            return $cardSet;
        }
        $res = [];
        foreach($indices as $key => $nothing) {
            $res[$key] = array_pop($cardSet);
        }

        return $res;
    }
}
