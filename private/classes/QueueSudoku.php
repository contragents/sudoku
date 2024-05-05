<?php

namespace classes;

class QueueSudoku extends Queue
{
    const QUEUES = [
        'rating_waiters' => SudokuGame::GAME_NAME . parent::QUEUES['rating_waiters'],
        '2players_waiters' => SudokuGame::GAME_NAME . parent::QUEUES['2players_waiters'],
        'inviteplayers_waiters' => SudokuGame::GAME_NAME . parent::QUEUES['inviteplayers_waiters'],
    ];

    const SEMAPHORE_KEY = SudokuGame::GAME_NAME . parent::SEMAPHORE_KEY;

    const PREFS_KEY = SudokuGame::GAME_NAME . parent::PREFS_KEY;

    const USER_QUEUE_STATUS_PREFIX = SudokuGame::GAME_NAME . parent::USER_QUEUE_STATUS_PREFIX;
}

