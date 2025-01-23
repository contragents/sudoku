<?php

namespace classes;

class GomokuGame extends Game
{
    public const GAME_NAME = 'gomoku';
    const NUM_RATING_PLAYERS_KEY = self::GAME_NAME . parent::NUM_RATING_PLAYERS_KEY;
    const NUM_COINS_PLAYERS_KEY = self::GAME_NAME . '.num_coins_players';

    public function __construct()
    {
        parent::__construct(QueueGomoku::class);
    }

    public function gameStarted($statusUpdateNeeded = false): array
    {
        $res = parent::gameStarted($statusUpdateNeeded);

        // Особенности создания конкретной игры | начало

        // Особенности создания конкретной игры | конец

        return $res;
    }

    public function newDesk(): Desk
    {
        return new DeskGomoku;
    }
}

