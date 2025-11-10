<?php


namespace classes;


use BaseController as BC;

/**
 * @property PlayerCards[] $playersCards массив карт игроков (карты на руках, стек, банк 4 кучки)
 */

class GameStatusSkipbo extends GameStatus
{
    /** @var PlayerCards[] $playersCards массив карт игроков (карты на руках, стек, банк 4 кучки) */
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

        // Add cards on hand for current player
        $res['you_hand_cards'] = $this->playersCards[BC::$instance->Game->numUser]->hand;

        return $res;
    }
}