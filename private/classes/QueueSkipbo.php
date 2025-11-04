<?php

namespace classes;

class QueueSkipbo extends Queue
{
    protected static $GAME_STATUS_CLASS = GameStatusSkipbo::class;
    const QUEUES = [
        'rating_waiters' => GameSkipbo::GAME_NAME . parent::QUEUES['rating_waiters'],
        '2players_waiters' => GameSkipbo::GAME_NAME . parent::QUEUES['2players_waiters'],
        'inviteplayers_waiters' => GameSkipbo::GAME_NAME . parent::QUEUES['inviteplayers_waiters'],
    ];

    const PREFS_KEY = GameSkipbo::GAME_NAME . parent::PREFS_KEY;

    const USER_QUEUE_STATUS_PREFIX = GameSkipbo::GAME_NAME . parent::USER_QUEUE_STATUS_PREFIX;
}
