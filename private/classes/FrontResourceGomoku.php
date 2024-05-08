<?php


namespace classes;


class FrontResourceGomoku extends FrontResource
{
    public static function getImgsPreload(): array
    {
        return [
            'ground' => ['type' => 'svg', 'url' => 'img/gomoku/field_source.svg', 'options' => "{'width': 513 * 2, 'height': 500 * 2}"],
        ]
            + parent::getImgsPreload();
    }
}