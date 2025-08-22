<?php

namespace classes;


class ApcuCache implements CacheInterface
{
    const DEFAULT_TTL = 1 * 60 * 60; // Ставим TTL 1 час

    public static function get($id, $default = null)
    {
        return apcu_fetch($id);
    }

    public static function set($id, $data, $lifeTime = self::DEFAULT_TTL)
    {
        return apcu_store($id, $data, $lifeTime);
    }

    public static function del(string $id)
    {
        return apcu_delete($id);
    }

    public static function exists(string $id): bool
    {
        return apcu_exists($id);
    }

    /**
     * @param string $id
     *
     * @return mixed
     */
    public static function fetch(string $id)
    {
        return apcu_fetch($id);
    }

    /**
     * @param string $id
     * @param mixed $data
     * @param int $lifeTime 0 - forever until gc
     *
     * @return bool
     */
    public function save(string $id, $data, int $lifeTime = 0): bool
    {
        return apcu_store($id, $data, $lifeTime);
    }

    public static function delete($id): bool
    {
        return apcu_delete($id);
    }

    /**
     * @return bool
     */
    public static function flushAll(): bool
    {
        return apcu_clear_cache();
    }

    public static function isEnabled(): bool {
        return apcu_enabled();
    }

    static public function clear()
    {
     return self::flushAll();
    }

    static public function getMultiple($keys, $default = null)
    {
        // TODO: Implement getMultiple() method.
    }

    static public function setMultiple($values, $ttl = null)
    {
        // TODO: Implement setMultiple() method.
    }

    static public function deleteMultiple($keys)
    {
        // TODO: Implement deleteMultiple() method.
    }

    static public function has($key)
    {
        return self::exists($key);
    }
}