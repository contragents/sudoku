<?php


namespace classes;


use BaseController as BC;

class FrontResourceSkipbo extends FrontResource
{
    const NUMBER_TYPES = ['red', 'key', 'rose', 'white', 'black', 'button'];

    public static function getImgsPreload(): array
    {
        $imgArr = [];

            foreach (DeskSkipbo::CARDS as $card) {
                $imgArr["card_{$card}"] = [
                    'type' => 'svg',
                    'url' => "img/skipbo/$card.svg",
                ];
            }

        return $imgArr
            + [
                'ground' => [
                    'type' => 'svg',
                    'url' => 'img/sudoku/field_source6.svg',
                    'options' => "{'width': 513 * 2, 'height': 500 * 2}"
                ],
                'card_skipbo' => [
                    'type' => 'svg',
                    'url' => 'img/skipbo/skipbo.svg',
                ],
                'card_back' => [
                    'type' => 'svg',
                    'url' => 'img/skipbo/back.svg',
                ],
            ]
            + parent::getImgsPreload();
    }
}