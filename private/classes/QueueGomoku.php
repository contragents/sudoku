<?php

namespace classes;

class QueueGomoku extends Queue
{
    const QUEUES = [
        'rating_waiters' => GameGomoku::GAME_NAME . parent::QUEUES['rating_waiters'],
        '2players_waiters' => GameGomoku::GAME_NAME . parent::QUEUES['2players_waiters'],
        'inviteplayers_waiters' => GameGomoku::GAME_NAME . parent::QUEUES['inviteplayers_waiters'],
    ];

    const PREFS_KEY = GameGomoku::GAME_NAME . parent::PREFS_KEY;

    const USER_QUEUE_STATUS_PREFIX = GameGomoku::GAME_NAME . parent::USER_QUEUE_STATUS_PREFIX;
}
