<?php

use classes\Cache;
use classes\Config;

include __DIR__ . '/vendor/autoload.php';

define('LOG_KEY', 'log_errors'); // ключ логов в keydb
define('LOG_TTL', 15 * 60); // время хранения логов в keydb

Config::$config = [];

// Парсим параметры из .env
Config::parseEnv();

// Создаем окружение (ДЕВ/ПРОД)
Config::makeEnvironment();

/**
 * Глобальная функция вывода отладочной инфо, либо логирования (пока в keydb)
 * @param $data
 * @param string $comment
 * @param string $class
 * @param bool $ignoreCli
 */
function mp($data, string $comment = '', string $class = '', $ignoreCli = false): void
{
    /** todo restore on prod when time come
     * if (Config::$config['env'] !== Config::DEV) {
     * return;
     * }
     */

    $repeatChar = array_rand(['!' => '!', '#' => '#', '+' => '+']);
    print PHP_EOL . $comment . str_repeat($repeatChar, 10) . PHP_EOL;

    if (is_array($data)) {
        print_r($data);
    } else {
        print $data;
    }

    print PHP_EOL . str_repeat($repeatChar, 10) . PHP_EOL;
}