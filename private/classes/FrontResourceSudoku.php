<?php


namespace classes;


class FrontResourceSudoku extends FrontResource
{
    const NUMBER_TYPES = ['red', 'key', 'rose', 'white', 'black', 'button'];

    public static function getImgsPreload(): array
    {
        $imgArr = [];
        for ($i=1; $i<=9; $i++) {
            foreach(self::NUMBER_TYPES as $type) {
                $imgArr["{$type}_{$i}"] = [
                    'type' => 'image',
                    'url' => "img/sudoku/number_icons/{$i}_$type.png",
                    //'options' => "{'width': 64, 'height': 64}"
                ];
            }
        }

        return $imgArr
            + [
                'ground' => [
                    'type' => 'svg',
                    'url' => 'img/sudoku/field_source.svg',
                    'options' => "{'width': 513 * 2, 'height': 500 * 2}"
                ],
            ]
            + parent::getImgsPreload();
    }
}