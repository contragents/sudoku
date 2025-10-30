<?php


namespace classes;


use BaseController as BC;

class FrontResourceSkipbo extends FrontResource
{
    public static function getImgsPreload(): array
    {
        $imgArr = [];

        foreach (DeskSkipbo::CARDS as $card) {
            $imgArr["card_{$card}"] = [
                'type' => 'svg',
                'url' => "img/skipbo/card_$card.svg",
            ];
        }

        return $imgArr
            + [
                'card_skipbo' => [
                    'type' => 'svg',
                    'url' => 'img/skipbo/skipbo.svg',
                ],
                'card_back' => [
                    'type' => 'svg',
                    'url' => 'img/skipbo/back_card_v5.svg',
                ],
                'card_area' => [
                    'type' => 'svg',
                    'url' => 'img/skipbo/card_area_v1.svg',
                ],
                'frame_card' => [
                    'type' => 'svg',
                    'url' => 'img/skipbo/frame_card.svg',
                ],
                'back_player' => [
                    'type' => 'svg',
                    'url' => 'img/skipbo/back_player_v3.svg',
                ],
            ]
            + parent::getImgsPreload();
    }
}