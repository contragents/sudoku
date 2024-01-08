<?php

namespace classes;

use Longman\TelegramBot\Telegram;

class TG extends Telegram
{
    public function getMessage() {
        return $this->update->getMessage();
    }
}
