<?php

namespace classes;

class Config
{
    const ERUDIT_DOMAIN = 'xn--d1aiwkc2d.club';
    const DOMAIN_5_5_SU = '5-5.su';
    const DOMAIN_SUDOKU_BOX = 'sudoku.box';

    public static array $config = []; // основной конфиг
    private static array $envConfig = []; // временный конфиг

    // Соответствие $config-параметров и .env-параметров для замены
    const REPLACE_PARAMS = [
        'cache' => [
            'HOST' => ['key' => 'KEYDB_HOST'],
            'PORT' => ['key' => 'KEYDB_PORT']
        ],
        'db' => [
            'SQL_HOST' => ['key' => 'MYSQL_HOST'],
            'SQL_USER' => ['key' => 'MYSQL_USER'],
            'SQL_PASSWORD' => ['key' => 'MYSQL_PASSWORD'],
            'SQL_DB_NAME' => ['key' => 'MYSQL_DATABASE'],
        ],
    ];

    public static function BASE_URL(): string
    {
        return 'https://' . self::DOMAIN() . '/'; // Место, где задается домен проекта
    }

    public static function DOMAIN(): string
    {
        return self::$config['DOMAIN'] ?? '';
    }

    public static function parseEnv()
    {
        $envArr = file(__DIR__ . '/../../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($envArr as $string) {
            $string = trim($string);

            if (substr($string, 0, 1) != '#') {
                $paramValue = explode('=', $string);

                if (is_array($paramValue) && count($paramValue) == 2) {
                    self::$envConfig[$paramValue[0]] = $paramValue[1];
                } elseif (is_array($paramValue) && count($paramValue) > 2) {
                    // Найдена строка с несколькими знаками '='
                    $keyValue = $paramValue[0];
                    unset($paramValue[0]);
                    self::$envConfig[$keyValue] = implode('=', $paramValue);
                }
            }
        }
    }

    public static function makeEnvironment()
    {
        foreach (self::REPLACE_PARAMS as $param => $envParamData) {
            if (!empty(self::$envConfig[$envParamData['key'] ?? 'NON EXISTING KEY'] ?? false)) {
                self::$config[$param] = self::$envConfig[$envParamData['key']];
                unset(self::$envConfig[$envParamData['key']]);
            } elseif (is_array($envParamData)) {
                // Параметры 2го уровня вложенности
                foreach ($envParamData as $subParam => $subEnvParamData) {
                    if (!empty(self::$envConfig[$subEnvParamData['key']])) {
                        self::$config[$param][$subParam] = self::$envConfig[$subEnvParamData['key']];
                        unset(self::$envConfig[$subEnvParamData['key']]);
                    }
                }
            }
        }

        // Оставшиеся ключи переносим в конфиг как есть
        foreach(self::$envConfig as $key => $value) {
            if(!isset(self::$config[$key])) {
                self::$config[$key] = $value;
            }
        }
    }

    public static function isDev(): bool
    {
        return (self::$config['ENV'] ?? 'TEST') === 'TEST';
    }
}