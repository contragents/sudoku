<?php

namespace classes;

class SudokuGame extends Game
{
    public const GAME_NAME = 'sudoku';

    public function __construct()
    {
        parent::__construct(QueueSudoku::class);
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
        return new DeskSudoku;
    }
}

