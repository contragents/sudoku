<?php

namespace classes;


/**
 * @property array $goalStack Стек карт (30 шт)
 * @property array $hand Карты на руках 5 шт
 * @property array $bank Банк (1-4 кучки) последний элемент - верхний, использовать end(), pop, push
 */
class PlayerCards
{
    /** @var array $goalStack Стек карт (30 шт) */
    public array $goalStack = [];
    /** @var array $hand Карты на руках 5 шт */
    public array $hand = [1 => false, 2 => false, 3 => false, 4 => false, 5 => false];
    /** @var array $bank Банк (1-4 кучки) последний элемент - верхний, использовать end(), pop, push */
    public array $bank = [1 => [], 2 => [], 3 => [], 4 => []];
}