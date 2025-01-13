<?php

use classes\Cache;
use classes\Config;

include __DIR__ . '/vendor/autoload.php';

define('LOG_KEY', 'log_errors'); // ключ логов в keydb
define('LOG_TTL', 15 * 60); // время хранения логов в keydb

// Парсим параметры из .env в $envConfig
Config::parseEnv();

// Создаем окружение (ДЕВ/ПРОД) в $config - основной конфиг
Config::makeEnvironment();