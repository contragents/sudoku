<?php

namespace classes;


/**
 * @property array $stack Стек карт (30 шт)
 * @property array $hand Карты на руках 5 шт
 * @property array $bank Банк (1-4 кучки)
 */
class PlayerCards
{
    public array $stack = [];
    public array $hand = [];
    public array $bank = [0 => [], 1 => [], 2 => [], 3 => []];
}