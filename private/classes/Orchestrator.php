<?php

namespace classes;

class Orchestrator
{
    const CYCLE_SLEEP_TIME = 5;
    const EXECUTION_ABOVE_TIME = 20; // +N сек к времени выполнения оркестратора для max_execution_time
    const TTL = 60 * 60 * 24; // Храним в кеше24 часа время старта скрипта
    const SCRIPT_START_TIME_PREFIX = 'script_started_';

    public static function cacheScriptStartTime($scriptName)
    {
        Cache::setex(self::SCRIPT_START_TIME_PREFIX . $scriptName, self::TTL, date('U'));
    }

    public static function getScriptStartTime($scriptName)
    {
        return Cache::get(self::SCRIPT_START_TIME_PREFIX . $scriptName);
    }

    public static function getParams($scriptName, $argc = 1, $argv = [])
    {
        $params = [];

        if ($argc > 1) {
            for ($i = 1; $i < $argc; $i++) {
                $param = explode('=', $argv[$i]);
                $params[$param[0]] = $param[1] ?? false;
            }
        }

        // Получаем настройки, через конфиг
        $scriptParts = explode('_', str_replace('.php', '', basename($scriptName)));
        $module = $scriptParts[0];
        $scriptType = $scriptParts[1] ?? '';
        unset($scriptParts[0]);
        unset($scriptParts[1]);
        $scriptName = implode('_', $scriptParts);

        if (isset(Config::$config[$module][$scriptType][$scriptName])) {
            foreach (Config::$config[$module][$scriptType][$scriptName] as $paramName => $value) {
                if (!isset($params[$paramName])) {
                    $params[$paramName] = $value;
                }
            }
        }

        return $params;
    }
}

