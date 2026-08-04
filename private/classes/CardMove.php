<?php

namespace classes;

class CardMove
{
    public function __construct(
    /**  Игрок (0 - общая карта) */
    public int $numUser,

    /** карта-тип начало */
    public string $cardTypeFrom,

    /**  позиция карты начало */
    public int $positionFrom,

    /**  карта-тип назначения */
    public string $cardTypeTo,

    /** позиция назначения */
    public int $positionTo,

    /** достоинство карты */
    public int $cardValue,
){}
}