<?php

namespace classes;

class QueueGomoku extends Queue
{
    const QUEUES = [
        'rating_waiters' => GomokuGame::GAME_NAME . parent::QUEUES['rating_waiters'],
        '2players_waiters' => GomokuGame::GAME_NAME . parent::QUEUES['2players_waiters'],
        'inviteplayers_waiters' => GomokuGame::GAME_NAME . parent::QUEUES['inviteplayers_waiters'],
    ];

    const SEMAPHORE_KEY = GomokuGame::GAME_NAME . parent::SEMAPHORE_KEY;

    const PREFS_KEY = GomokuGame::GAME_NAME . parent::PREFS_KEY;

    const USER_QUEUE_STATUS_PREFIX = GomokuGame::GAME_NAME . parent::USER_QUEUE_STATUS_PREFIX;
}
