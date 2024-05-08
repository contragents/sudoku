<?php


namespace classes;


class FrontResource
{
    public static function getImgsPreload(): array
    {
        return [
            'no_network' => ['type' => 'image', 'url' => 'img/no_network_transparent.png'],
        ];
    }
}