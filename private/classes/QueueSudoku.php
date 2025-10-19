<?php

namespace classes;

class QueueSudoku extends Queue
{
    const QUEUES = [
        'rating_waiters' => GameSudoku::GAME_NAME . parent::QUEUES['rating_waiters'],
        '2players_waiters' => GameSudoku::GAME_NAME . parent::QUEUES['2players_waiters'],
        'inviteplayers_waiters' => GameSudoku::GAME_NAME . parent::QUEUES['inviteplayers_waiters'],
    ];

    const PREFS_KEY = GameSudoku::GAME_NAME . parent::PREFS_KEY;

    const USER_QUEUE_STATUS_PREFIX = GameSudoku::GAME_NAME . parent::USER_QUEUE_STATUS_PREFIX;
}

