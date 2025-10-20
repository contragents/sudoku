<?php


namespace classes;


/**
 * @property int $stackLen Сколько карт в стеке (карт, которые нужно пристроить на столе - 30)
 * @property PlayerCards[] $playersCards массив карт игроков (карты на руках, стек, банк 4 кучки)
 */
class GameStatusSkipbo extends GameStatus
{
    public ?int $stackLen = null;

    public array $playersCards = [];
}