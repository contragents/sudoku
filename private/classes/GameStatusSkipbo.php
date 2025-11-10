<?php


namespace classes;


/**
 * @inheritDoc
 * @property int $stackLen Сколько карт в стеке (карт, которые нужно пристроить на столе - 30)
 * @property PlayerCards[] $playersCards массив карт игроков (карты на руках, стек, банк 4 кучки)
 */
class GameStatusSkipbo extends GameStatus
{
    public ?int $stackLen = null;

    public array $playersCards = [];

    public function openDesk(): array
    {
        // Adding players' open stack cards & bank cards
        $res = array_map(
            fn($playerCards) => [
                'stack' => end($playerCards->stack),
                'bank' => $playerCards->bank,
            ],
            $this->playersCards
        );

        // Add common cards
        $res['common_cards'] = $this->desk->desk;

        return $res;
    }
}