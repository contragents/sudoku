<?php

namespace classes;

class Command
{
    public static $dryRun = false; // Признак полного восстановления keydb
    public $params = [];
    public static $runTimeStatus = false; // Признак факта работы скрипта (или падения по Эксепшн)
    public static $scriptRunTimestamp = false; // Начало выполнения скрипта
    // Специфические константы для наследников BEGIN
    const LAST_UPDATE_TIMESTAMP_KEY = 'auction_last_update';
    const DEFAULT_DATE_FROM = '2022-05-01';
    // Специфические константы для наследников END

    const MAX_COMMAND_LIFETIME = 1 * 60 * 60; // Максимальное время жизни признака выполнения скрипта - далее считаем что он зомби
    const DEFAULT_EXEC_TIME = 10 * 60; // Время исполнения скрипта по умолчанию
    const DEFAULT_TIME_TO_LIVE = 60;
    const COMMAND_KEY_PREFIX = 'command_';
    const PARALLEL_EXEC = 'parallel_exec';
    const YES = 'yes';
    const PARAMS_LIST = []; // массив обязательных параметров для потомков

    protected static function hasTimeToExecute()
    {
        if (!static::$scriptRunTimestamp) {
            static::$scriptRunTimestamp = microtime(true);

            return true;
        }

        if (microtime(true) - static::$scriptRunTimestamp > static::DEFAULT_EXEC_TIME) {
            return false;
        } else {
            return true;
        }
    }

    protected function getScriptTime()
    {
        return (!static::$scriptRunTimestamp) ? 0 : microtime(true) - static::$scriptRunTimestamp;
    }

    public function checkParam(string $paramName): bool
    {
        return ($this->params[$paramName] ?? false) == 'yes';
    }

    public function __construct($scriptName)
    {
        global $argc, $argv;

        $this->params = Orchestrator::getParams($scriptName, $argc, $argv);

        foreach (static::PARAMS_LIST as $param) {
            if (empty($this->params[$param])) {
                mp($param, 'Missed param in Command ' . $scriptName, __METHOD__);

                exit();
            }
        }

        // todo static::DEFAULT_EXEC_TIME не может быть false, т.к. наследуется от класса комманд
        // каждый воркер должен настраивать константу DEFAULT_EXEC_TIME под себя или использовать комманд::
        set_time_limit(
            ($this->params['time_to_work'] ?? static::DEFAULT_EXEC_TIME) + Orchestrator::EXECUTION_ABOVE_TIME
        );

        if ($this->checkParam(self::PARALLEL_EXEC)) {
            static::$runTimeStatus = true;
            self::setCommandExecuting();

            return;
        }

        // Если параллельный запуск не разрешен, то выполняем проверку и запрещаем параллельный запуск команды
        if (self::isCommandExecuting()) {
            print "Another script is running. Try parameter parallel_exec=yes to force script executing\n";
            exit();
        } else {
            static::$runTimeStatus = true;
            self::setCommandExecuting();
        }
    }

    public static function prolongIfNessesary(string $callingClassName = '')
    {
        $timeToEndOfExecution = self::timeToEndOfExecution($callingClassName);

        if ($timeToEndOfExecution < self::DEFAULT_TIME_TO_LIVE) {
            if ($callingClassName) {
                $callingClassName::prolongExecution();
            } else {
                self::prolongExecution();
            }
        }
    }

    public function __destruct()
    {
        if (static::$runTimeStatus) {
            self::noDateExit();
        }
    }

    private static function setCommandExecuting(): void
    {
        Cache::setex(static::COMMAND_KEY_PREFIX, static::DEFAULT_EXEC_TIME * 2, date('U'));
    }

    public static function prolongExecution(int $numSeconds = 0)
    {
        if (!$numSeconds || $numSeconds < 0) {
            $numSeconds = static::DEFAULT_EXEC_TIME;
        }

        set_time_limit($numSeconds);

        self::setCommandExecuting();
    }

    public static function timeToEndOfExecution(string $callingClassName = '')
    {
        return (
            $callingClassName
                ? $callingClassName::DEFAULT_EXEC_TIME
                : static::DEFAULT_EXEC_TIME
            )
            -
            (
                date('U') -
                (
                Cache::get(
                    $callingClassName
                        ? $callingClassName::COMMAND_KEY_PREFIX
                        : static::COMMAND_KEY_PREFIX
                ) ?: 0
                )
            );
    }

    private
    function isCommandExecuting(): bool
    {
        if (Cache::exists(static::COMMAND_KEY_PREFIX)) {
            return true;
        }

        return false;
    }

    public
    function noDateExit(): void
    {
        // Удаляем признак выполнения скрипта
        Cache::del(static::COMMAND_KEY_PREFIX);

        exit();
    }
}