<?php

use classes\AbstractFinamApi;
use classes\Candle;
use classes\Command;
use classes\Config;
use classes\TG;
use classes\Trader;
use Longman\TelegramBot\Request;

include_once __DIR__ . '/../../autoload.php';

class TraderWorker extends Command
{
    const DEFAULT_EXEC_TIME = 2 * 60;                                // Время исполнения скрипта по умолчанию
    const COMMAND_KEY_PREFIX = parent::COMMAND_KEY_PREFIX . __CLASS__; // Ключ для отслеживания запущенного скрипта

    public function run()
    {
        exit;
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        $_REQUEST['cli_mode'] = true;
        $baseDate = $this->params['date'] ?? date('Y-m-d');
        mp($baseDate, 'Parsing date', __METHOD__);

        $emitents = Trader::getTikersGrowing($baseDate);

        mp($emitents, 'Emitents found', __METHOD__);

        if (count($emitents)) {
            $telegram = new TG(Config::$envConfig[BotController::BOT_TOKEN_CONFIG_KEY], BotController::BOT_USERNAME);
            foreach ($emitents as $emitent) {
                //foreach(BotController::TG_ADMINS as $admin) {
                $admin = BotController::ILYA_TG_ID;
                Request::sendMessage(
                    [
                        'chat_id' => $admin,
                        'text' => var_export($emitent, true),
                    ]
                );
                //}
            }
        }
    }
}

(new TraderWorker(__FILE__))->run();