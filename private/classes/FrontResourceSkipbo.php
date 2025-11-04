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

            $imgArr["card_skipbo_{$card}"] = [
                'type' => 'svg',
                'url' => "img/skipbo/card_skipbo_$card.svg",
            ];
        }

        return $imgArr
            + [
                'avatar_frame_you' => [
                    'type' => 'svg',
                    'url' => 'img/avatar_frame7.svg',
                    'options' => "{'width': 240, 'height': 240}"
                ],
                'card_skipbo' => [
                    'type' => 'svg',
                    'url' => 'img/skipbo/card_skipbo_v3.svg',
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
                    'url' => 'img/skipbo/back_player_blue.svg',
                ],
            ]
            + parent::getImgsPreload();
    }
}