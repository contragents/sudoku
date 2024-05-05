<?php

namespace classes;

use BaseController;

class GomokuGame extends Game
{
    public const GAME_NAME = 'gomoku';

    public function __construct()
    {
        $this->SM = BaseController::$SM;

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

