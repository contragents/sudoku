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

    /** @var array[] $desk Кучки карт №№1..4 - карты от 1 до 12, SKIPBO (1001-1012) */
    public array $desk = [1 => [], 2 => [], 3 => [], 4 => []];
    public array $koloda = []; // Колода из 168 карт с учетом розданных карт и карт, добавляемых при сборе кучек карт №№1..4
    private array $tmpKoloda = []; // Временная колода из собранных кучек кард от 1 до 12ти с учетом SKIP-BO карт

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
     * Отдает массив $cardNum карт из колоды, уменьшая колоду
     * @param int $cardNum
     * @return array
     */
    public function getCardsFromKoloda(int $cardNum): array
    {
        if(count($this->koloda) < $cardNum) {
            shuffle($this->tmpKoloda);
            $this->koloda += array_splice($this->tmpKoloda, 0);
            // todo Добавить событие “Подмес карт из tmpKoloda в Koloda”
        }

        return array_splice($this->koloda, 0, $cardNum);
    }

    public function pushCardsToTmpKoloda(array $cardsToPush): void
    {
        $this->tmpKoloda += array_map(
            fn($cardValue) => min($cardValue, self::SKIPBO_CARD),
            $cardsToPush
        );
    }
}
