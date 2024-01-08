<?php

use classes\AbstractFinamApi;
use classes\Cache;
use classes\Candle;
use classes\Config;
use classes\TG;
use Longman\TelegramBot\Request;

class BotController extends BaseController
{
    const BOT_TOKEN_CONFIG_KEY = 'BOT_TOKEN';
    const BOT_USERNAME = 'erudit_club_bot';
    const HOOK_URL = 'https://xn--d1aiwkc2d.club/bot/hook';
    const INCOMING_UPDATES_KEY = 'erudit.club.bot.incoming';

    const ILYA_TG_ID = 294789510;

    const TG_ADMINS = [self::ILYA_TG_ID];

    const COMMANDS = ['/start' => 'start'];
    const GREETING_MSG = 'Задайте шаблон поиска слов. Принимаются только буквы (А-Я, A-Z) и символы "*" (любые буквы) и "?" (ОДНА любая буква)';
    const ERROR_MSG = 'Ошибка сервера';
    const CLUB_WORDS_COUNT = 5;

    private static $botApiKey;
    private static $telegram = null;

    public function Run()
    {
        self::$botApiKey = Config::$envConfig[self::BOT_TOKEN_CONFIG_KEY];

        // Create Telegram API object
        self::$telegram = new TG(self::$botApiKey, self::BOT_USERNAME);

        return parent::Run();
    }

    public function setHookAction()
    {
        try {
            // Set webhook
            $result = self::$telegram->setWebhook(self::HOOK_URL);
            if ($result->isOk()) {
                return $result->getDescription();
            }
        } catch (Longman\TelegramBot\Exception\TelegramException $e) {
            // log telegram errors
            return $e->getMessage();
        }
    }

    private static function start() {
        return self::GREETING_MSG;
    }

    public function wordsAction():string {
        try {
            $text = self::$Request['word'];
            $words = array_column(DictModel::findWords($text, self::CLUB_WORDS_COUNT), 'slovo');
        } catch (Throwable $e) {
            $words = [self::ERROR_MSG];
            $errors = $e->__toString();
        }

        // Дублируем запрос админу
        Request::sendMessage(
            [
                'chat_id' => self::ILYA_TG_ID,
                'text' => $text
                    . ' ' . ($errors ?? ''),
            ]
        );

        return json_encode($words, JSON_UNESCAPED_UNICODE);
    }

    public function hookAction()
    {
        try {
            // Handle telegram webhook request
            self::$telegram->handle();
        } catch (Longman\TelegramBot\Exception\TelegramException $e) {
            return;
        }

        $author = '';
        try {
            $author = self::$telegram->getMessage()->getChat()->getId();
            $text = self::$telegram->getMessage()->getText();
            if (in_array($text, array_keys(self::COMMANDS))) {
                $method = self::COMMANDS[$text];
                $words = self::$method();
            } else {
                $words = implode(
                    PHP_EOL,
                    array_column(DictModel::findWords($text), 'slovo')
                );
            }
        } catch (Throwable $e) {
            $words = self::ERROR_MSG;
            $errors = $e->__toString();
        }

        $result = Request::sendMessage(
            [
                'chat_id' => $author,//self::ILYA_TG_ID,
                'text' => $words,
            ]
        );

        // Дублируем запрос админу
        Request::sendMessage(
            [
                'chat_id' => self::ILYA_TG_ID,
                'text' => self::$telegram->getMessage()->getChat()->getFirstName()
                    . ' ' . self::$telegram->getMessage()->getChat()->getLastName() . " ($author)"
                    . PHP_EOL
                    . $text
                    . ' ' . ($errors ?? ''),
            ]
        );


    }

    public function getUpdatesAction()
    {
        while ($event = Cache::rpop(self::INCOMING_UPDATES_KEY)) {
            print_r($event);
        }
    }
}