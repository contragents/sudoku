<?php

namespace classes;

use BaseController;
use Redis;

class Cache
{
    const LOCKS_KEY = '.locks_';
    const LOCK_RETRY_TIME = 10000;
    const LOCK_TRIES = 200;
    const MAX_LOCK_RECURSIONS = 10;

    public static ?Cache $_instance = null;
    private static array $locks = [];

    public $redis;

    public function __construct()
    {
        $this->redis = new Redis;
        try {
            $this->redis->pconnect(Config::$config['cache']['HOST'], Config::$config['cache']['PORT'], 10);
        } catch (\Exception $e) {
            $this->redis->connect(Config::$config['cache']['HOST'], Config::$config['cache']['PORT'], 10);
        }
    }

    public static function zrangestore($storeTo, $srcSet, $minPosition, $maxPosition)
    {
        // todo переделать на rawcommand
        return exec(
            "redis-cli -h "
            . Config::$config['cache']['HOST']
            . " zrangestore $storeTo $srcSet $minPosition $maxPosition"
        );
    }

    public static function zdiffstore($storeTo, $srcSetMain, $srcSet2, $srcSet3)
    {
        return exec(
            "redis-cli -h "
            . Config::$config['cache']['HOST']
            . " zdiffstore $storeTo 3 $srcSetMain $srcSet2 $srcSet3"
        );
    }

    public static function zmscore($set, $member)
    {
        return exec(
            "redis-cli -h "
            . Config::$config['cache']['HOST']
            . " zmscore $set $member"
        );
    }

    public static function rawcommand($command, array $params)
    {
        self::checkInstance();
        $redis = static::$_instance->redis;
        $res = call_user_func_array([$redis, 'rawcommand'], array_merge([$command], $params));

        return $res;
    }

    /** Performing scan for HSET
     * @param string $key key for hset
     * @param int $iterator passed by reference!
     * @param string $mask Tme search mask within the key
     * @param int $numValues Desired number of values per scan iteration
     */
    public static function hscan($key, &$iterator, $mask = false, $numValues = 1)
    {
        self::checkInstance();
        if (!$mask) {
            $res = self::$_instance->redis->hscan($key, $iterator);
        } else {
            $res = self::$_instance->redis->hscan($key, $iterator, $mask, $numValues);
        }

        return self::prepareRes($res);
    }

    /** Performing scan for KEYS
     * @param int $iterator passed by reference!
     * @param string $mask Tme search mask of keys
     * @param int $numValues Desired number of values per scan iteration
     * @return array|false Array with keys or false
     */
    public static function scan(&$iterator, $mask = false, $numValues = 10): array
    {
        self::checkInstance();
        if (!$mask) {
            $res = self::$_instance->redis->scan($iterator);
        } else {
            $res = self::$_instance->redis->scan($iterator, $mask, $numValues);
        }

        return self::prepareRes($res);
    }


    private static function checkInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new self;
        }
    }

    public static function __callStatic($name, $arguments)
    {
        self::checkInstance();

        if (is_array($arguments[count($arguments) - 1]) && isset($arguments[count($arguments) - 1]['lock'])) {
            $lockKey = $arguments[count($arguments) - 1]['lock'];

            if(!self::lock($lockKey)) {
                return false;
            }

            unset($arguments[count($arguments) - 1]);
        }

        //Сериализуем все массивы и объекты в параметрах, кроме z-команд для упорядоченных множеств
        //т.к. они могут принимать массивы в качестве параметров
        if (substr($name, 0, 1) != 'z') {
            foreach ($arguments as $num => $value) {
                if (is_array($value) || is_object($value)) {
                    $arguments[$num] = serialize($value);
                }
            }
        }
        $success = false;
        while (!$success) {
            try {
                $res = self::$_instance->redis->$name(...$arguments);
                $success = true;
            } catch (\Exception $e) {
                self::$_instance = new self;
            }
        }

        return self::prepareRes($res);
    }

    /** Checking if res is a serialized array than return unser. array. Else return the res
     * @param string $res Result of Redis method
     */
    public static function prepareRes($res)
    {
        if (empty($res) && $res !== 0) {
            return false;
        }

        $unserRes = is_array($res) ? false : @unserialize($res);
        if ($unserRes === false) {
            return $res;
        } else {
            return $unserRes;
        }
    }

    public static function waitLock(string $lockKey, bool $force = false, int $recursionLevel = 0): bool
    {
        $lockTries = 0;

        while($lockTries < self::LOCK_TRIES) {
            if (self::lock($lockKey)) {
                return true;
            }

            $lockTries++;
            usleep(self::LOCK_RETRY_TIME);
        }

        /** @var string $gamePrefix */

        if ($force && $recursionLevel <= self::MAX_LOCK_RECURSIONS) {
            self::$_instance->redis->del(BaseController::$SM::$gamePrefix . self::LOCKS_KEY . $lockKey);

            return self::waitLock($lockKey, true, ++$recursionLevel);
        }

        return false;
    }

    /**
     * Делаем 1 попытку получить локи и возвращаем true, false;
     * @param $lockKey
     * @return bool
     */
    public static function lock($lockKey): bool
    {
        self::checkInstance();

        if (self::$locks[$lockKey] ?? false) {
            return true;
        }

        /** @var string $gamePrefix */

        if (self::$_instance->redis->incr(BaseController::$SM::$gamePrefix . self::LOCKS_KEY . $lockKey) == 1) {
            self::$_instance->redis->setex(BaseController::$SM::$gamePrefix . self::LOCKS_KEY . $lockKey, floor(self::LOCK_RETRY_TIME / 1000000 * self::LOCK_TRIES), 1);
            self::$locks[$lockKey] = true;

            return true;
        }

        $lockTries = 0;

        while($lockTries < self::LOCK_TRIES / 5) {
            if (self::$_instance->redis->incr(BaseController::$SM::$gamePrefix . self::LOCKS_KEY . $lockKey) == 1) {
                self::$_instance->redis->setex(BaseController::$SM::$gamePrefix . self::LOCKS_KEY . $lockKey, self::LOCK_RETRY_TIME * self::LOCK_TRIES, 1);
                self::$locks[$lockKey] = true;

                return true;
            }

            $lockTries++;
            usleep(self::LOCK_RETRY_TIME);
        }

        // Снять лок, если он "завис" - много попыток incr
        if (self::$_instance->redis->incr(BaseController::$SM::$gamePrefix . self::LOCKS_KEY . $lockKey) > self::LOCK_TRIES) {
            self::unlock($lockKey);

            return self::lock($lockKey);
        }

        return false;
    }

    public static function multyLock(array $lockKeys): bool
    {
        foreach ($lockKeys as $lockKey) {
            if (!self::lock($lockKey)) {
                return false;
            }
        }

        return true;
    }

    public static function unlockAll()
    {
        self::checkInstance();
        self::$_instance->__destruct();
    }

    public function __destruct()
    {
        /** @var string $gamePrefix */

        foreach(self::$locks as $lockKey => $nothing) {
            self::$_instance->redis->del(BaseController::$SM::$gamePrefix . self::LOCKS_KEY . $lockKey);
        }
    }

    private static function unlock($lockKey)
    {
        /** @var string $gamePrefix */

        self::$_instance->redis->del(BaseController::$SM::$gamePrefix . self::LOCKS_KEY . $lockKey);
    }
}