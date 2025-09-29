<?php

namespace classes;

use Throwable;

/**
 * Class QueueUser
 * @package classes
 * @property int $time Время первичного помещения в очередь
 * @property int $queue_time Время помещения игрока в текущую очередь
 * @property int $last_ping_time Время последнего пинга от игрока - обновлять при каждом обращении
 * @property string $cookie
 * @property int $common_id
 * @property int $rating
 * @property int $balance
 * @property int $from_rating Желаемый рейтинг (от)
 * @property int $bid Максимальная ставка
 * @property int $num_players  2 для Судоку, Гомоку - пока для всех
 * @property int $turn_time 120, 60
 * @property string $queue название очереди, из которой забрали игрока
 */

class QueueUser
{
    public ?int $time = null;
    public ?int $queue_time = null;
    public ?string $cookie = null;
    public ?int $common_id = null;
    public ?int $rating = null;
    public ?int $from_rating = null;
    public ?int $balance = null;
    public ?int $bid = null;
    public ?int $last_ping_time = null;
    public ?int $num_players = null;
    public ?int $turn_time = null;
    public ?string $queue = null;

    /**
     * @param array $fieldsVals
     * @return static
     */
    public static function new(array $fieldsVals = []): self
    {
        return self::arrayToObject($fieldsVals);
    }

    /**
     * @param array $row
     * @return static
     */
    protected static function arrayToObject(array $row): self
    {
        $res = new static();
        $properties = get_object_vars($res);

        foreach ($row as $field => $value) {
            $property = $field;

            if (!array_key_exists($property, $properties)) {
                continue;
            }

            try {
                $propertyType = gettype($res->$property);
                if (is_callable([$res, "to_$propertyType"])) {
                    $value = call_user_func([$res, "to_$propertyType"], $value);
                }

                $res->$property = $value;
            } catch (Throwable $e) {
                Cache::rpush('QueueUserErrors', $e->__toString()); // SUD-48
                continue;
            }
        }

        return $res;
    }
}
