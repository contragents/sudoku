<?php

namespace classes;

use DeviceDetector\Cache\CacheInterface;

class ApcuCache implements CacheInterface
{
    static $chunks = [];
    const STRING_CHUNK_SIZE = 1000; // Число байт для разбивки строк
    const CHUNK_KEY_PART = 'chunk';
    const DEFAULT_TTL = 2 * 60 * 60; // Ставим TTL 2 часа, чтобы фильтры следующего часа дожили до конца

    public static function clearStatic()
    {
        self::$chunks = [];
    }

    public static function isBitChecked(int $bitNum, string $keyDbKey, array &$params): bool
    {
        // Получаем номер чанка в фильтре
        $chunkNum = floor($bitNum / 8 / self::STRING_CHUNK_SIZE);
        // Определяем номер байта в чанке
        $byteChunkNum = floor($bitNum / 8) - $chunkNum * self::STRING_CHUNK_SIZE;
        // Определяем номер бита в байте
        $byteBitNum = $bitNum - ($chunkNum * self::STRING_CHUNK_SIZE + $byteChunkNum) * 8;

        $mask = 2 ** $byteBitNum;

        // Чанк уже в статическом массиве
        if (self::$chunks[$chunkNum] ?? false) {
        } elseif (self::$chunks[$chunkNum] = self::getChunk(Tracker::combineKeys($params), $chunkNum)) {
            // Чанк в apcu? - переносим в статический массив
        } else {
            // Чанк в кейдб - забираем в стат массив и копируем в apcu
            self::$chunks[$chunkNum] = Cache::getrange(
                $keyDbKey,
                $chunkNum * self::STRING_CHUNK_SIZE,
                ($chunkNum + 1) * self::STRING_CHUNK_SIZE - 1
            );

            if (self::$chunks[$chunkNum]) {
                self::saveChunk(Tracker::combineKeys($params), $chunkNum);
            }
        }

        $ord = ord(substr(self::$chunks[$chunkNum] ?: '', $byteChunkNum, 1) ?: chr(0));
        $and = $ord & $mask;

        return (bool)$and;

        return false;
    }

    public static function getChunk(string $id, int $chunkNum): string
    {
        return self::get(Tracker::combineKeys([$id, self::CHUNK_KEY_PART, $chunkNum]));
    }

    public static function saveChunk(string $id, int $chunkNum): void
    {
        self::set(Tracker::combineKeys([$id, self::CHUNK_KEY_PART, $chunkNum]), self::$chunks[$chunkNum]);
    }

    public static function gatherAsciiString(string $id, bool $delete = false)
    {
        $substr = true;
        $result = '';
        for ($chunk = 0; $substr; $chunk++) {
            $substr = self::get(Tracker::combineKeys([$id, self::CHUNK_KEY_PART, $chunk]));
            if (!$substr) {
                break;
            }

            if ($delete) {
                self::del(Tracker::combineKeys([$id, self::CHUNK_KEY_PART, $chunk]));
            }

            $result .= $substr;
        }

        return $result;
    }

    public static function saveAsciiString(string $id, string $string)
    {
        $substr = true;
        for ($chunk = 0; $substr; $chunk++) {
            $substr = substr($string, $chunk * self::STRING_CHUNK_SIZE, self::STRING_CHUNK_SIZE);
            if (!$substr) {
                break;
            }

            self::saveChunk($id, $substr, $chunk);
        }
    }

    public static function get(string $id)
    {
        return apcu_fetch($id);
    }

    public static function set(string $id, $data, int $lifeTime = self::DEFAULT_TTL)
    {
        return apcu_store($id, $data, $lifeTime);
    }

    public static function del(string $id)
    {
        return apcu_delete($id);
    }

    public function exists(string $id): bool
    {
        return apcu_exists($id);
    }

    /**
     * @param string $id
     *
     * @return mixed
     */
    public function fetch(string $id)
    {
        return apcu_fetch($id);
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    public function contains(string $id): bool
    {
        return apcu_exists($id);
    }

    /**
     * @param string $id
     * @param mixed $data
     * @param int $lifeTime
     *
     * @return bool
     */
    public function save(string $id, $data, int $lifeTime = 0): bool
    {
        return apcu_store($id, $data, $lifeTime);
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    public function delete(string $id): bool
    {
        return apcu_delete($id);
    }

    /**
     * @return bool
     */
    public function flushAll(): bool
    {
        return true;
    }

    public static function isEnabled(): bool {
        return apcu_enabled();
    }
}