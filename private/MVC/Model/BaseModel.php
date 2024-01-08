<?php

use classes\DB;
use classes\ORM;

class BaseModel
{
    const CONDITIONS = ['=' => '=', '!=' => '!=', 'in' => 'in', '<' => '<', '>' => '>', '<=' => '<=', '>=' => '>=',];
    const TABLE_NAME = 'lots';

    const ID_FIELD = 'id';
    const IS_DELETED_FIELD = 'deleted';
    const CREATED_FIELD = 'created_at';
    const RECORDS_IN_CHUNK = 1000;

    public static function getFields(array $values, array $fields): array
    {
        $res = [];
        foreach ($fields as $field => $defaultValue) {
            $res[$field] = $values[$field] ?? $defaultValue;
        }

        return $res;
    }


public
static function add(array $fields)
{
    $query = ORM::insert(static::TABLE_NAME)
        . ORM::insertFields(array_keys($fields))
        . ORM::rawValues(array_map(fn($value) => DB::escapeString($value), $fields));

    if (DB::queryInsert($query)) {
        return DB::insertID();
    } else {
        return false;
    }
}

/**
 * Sets 1 param of model
 * @param $id
 * @param $field
 * @param $value
 * @return bool
 */
public
static function setParam($id, $field, $value)
{
    $updateQuery = ORM::update(static::TABLE_NAME)
        . ORM::set(['field' => $field, 'value' => DB::escapeString($value)])
        . ORM::where('id', '=', $id);

    if (DB::queryInsert($updateQuery)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Sets field value for all table
 * @param $field
 * @param $value
 * @param array $where = ['field_name'=>'', 'condition'=>'', 'value'=>'', 'raw'=>true/false]
 * @return false|int
 */
public
static function setParamMass($field, $value, array $where = [])
{
    if (is_array($field) && is_array($value)) {
        $setValues = array_map(
            fn($fld, $val) => [
                'field' => $fld,
                'value' => $val instanceof ORM ? $val : DB::escapeString($val),
                'raw' => true
            ],
            $field,
            $value
        );
    } else {
        $setValues = [
            'field' => $field,
            'value' => $value instanceof ORM ? $value : DB::escapeString($value),
            'raw' => true
        ];
    }

    return DB::queryInsert(
        ORM::update(static::TABLE_NAME)
        . ORM::set($setValues)
        . (
        empty($where)
            ? ''
            : ORM::where($where['field_name'], $where['condition'], $where['value'], $where['raw'])
        )
    );
}

/**
 * @param $id
 * @param array $fieldsvals [$field1=>$val1, $field2=>$val2 ...]
 * @return bool
 */
public
static function update($id, array $fieldsvals): bool
{
    $updateQuery = ORM::update(static::TABLE_NAME)
        . ORM::set($fieldsvals)
        . ORM::where('id', '=', $id);

    if (DB::queryInsert($updateQuery)) {
        return true;
    } else {
        return false;
    }
}

public
static function getLastID()
{
    return DB::queryValue("SELECT max(id) as mx FROM " . static::TABLE_NAME) ?: 0;
}

public
static function findAll(array $fieldList = [])
{
    //$query = "SELECT * FROM " . static::TABLE_NAME;
    $query = "SELECT " . (empty($fieldList) ? '*' : implode(',', $fieldList)) . " FROM " . static::TABLE_NAME;

    return DB::queryArray($query) ?: [];
}

/**
 * Simple custom selector wich makes when with field=value [AND field2=value2...] clause
 * @param mixed $field - field name or array with field names
 * @param mixed $value - field desired value or array with corresponding values
 * @param false $isRaw
 * @param array $fieldList = []
 * @return array
 */
public
static function findAllCustom($field, $value, $isRaw = false, array $fieldList = []): array
{
    // todo переделать на ORM
    $query = "SELECT " . (empty($fieldList) ? '*' : implode(',', $fieldList)) . " FROM " . static::TABLE_NAME;

    if (!is_array($field)) {
        $query .= " WHERE $field = " . ($isRaw ? $value : "'$value'");
    } else {
        if (!is_array($value)) {
            return [];
        }
        $conditions = [];
        foreach ($field as $num => $fld) {
            $conditions[] = $fld
                . " = "
                . ($isRaw ? $value[$num] : "'{$value[$num]}'");
        }
        $query .= " WHERE " . implode(' AND ', $conditions);
    }

    return DB::queryArray($query) ?: [];
}

/**
 * Получаем все записи ИЗ БД по условию и обновляем КЭШ
 * @param $field
 * @param $condition
 * @param $value
 * @param bool $isRaw
 * @param bool $noResult Признак ненужности результата - только обновить кэш моделей
 * @param array $fields
 * @return array
 */
public
static function getCustom(
    $field,
    $condition,
    $value,
    bool $isRaw = false,
    bool $noResult = false,
    array $fields = []
): array {
    $query = ORM::select($fields ?: ['*'], static::TABLE_NAME);

    // todo сделать 'IN' по чанкам
    // Обрабатываем массивы полей-условий-значений
    if (is_array($field) || is_array($condition) || is_array($value)) {
        if (!is_array($field) || !is_array($condition) || !is_array($value)) {
            mp(
                ['field' => $field, 'condition' => $condition, 'value' => $value],
                'Error in types of field-condition-value',
                __METHOD__
            );

            return [];
        }

        if (count($field) != count($condition) || count($field) != count($value) || count($field) == 0) {
            mp(
                ['field' => $field, 'condition' => $condition, 'value' => $value],
                'Error in count of field-condition-value',
                __METHOD__
            );

            return [];
        }

        $iteration = false;
        foreach ($field as $num => $fld) {
            if ($condition[$num] == self::CONDITIONS['in']) {
                if (
                    !is_array($value[$num])
                    ||
                    (count($value[$num]) > static::RECORDS_IN_CHUNK) // todo разбить по чанкам
                    ||
                    empty($value[$num])
                ) {
                    mp([$num => $value[$num]], "VALUE $num for IN is WRONG!!!", __METHOD__);

                    return [];
                }

                $query .= $iteration
                    ? ORM::andWhereIn($fld, $value[$num])
                    : ORM::whereIn($fld, $value[$num]);
            } else {
                if (!in_array($condition[$num], self::CONDITIONS)) {
                    mp($condition[$num], "CONDITION $num is WRONG!!!", __METHOD__);

                    return [];
                }

                $query .= $iteration
                    ? ORM::andWhere($fld, $condition[$num], $value[$num], $isRaw)
                    : ORM::where($fld, $condition[$num], $value[$num], $isRaw);
            }

            $iteration = true;
        }
    } else {
        if ($condition == self::CONDITIONS['in']) {
            if (
                !is_array($value)
                ||
                (count($value) > static::RECORDS_IN_CHUNK)
                ||
                empty($value)
            ) {
                mp($value, 'VALUE is WRONG!!!', __METHOD__);

                return [];
            }

            $query .= ORM::whereIn($field, $value);
        } else {
            if (!in_array($condition, self::CONDITIONS)) {
                mp($condition, 'CONDITION is WRONG!!!', __METHOD__);

                return [];
            }
            $query .= ORM::where($field, $condition, $value, $isRaw);
        }
    }

    //mp($query, 'QUERY', __METHOD__);
    //print $query;
    return DB::queryArray($query) ?: [];
}

/**
 * Returns one record or []
 * @param $field
 * @param $value
 * @param false $isRaw
 * @return array
 */
public
static function getOneCustom($field, $value, $isRaw = false): array
{
    // todo отрефакторить под ORM
    if (!is_array($field)) {
        $query = "SELECT * FROM "
            . static::TABLE_NAME
            . " WHERE $field = "
            . ($isRaw ? $value : "'$value'")
            . " LIMIT 1";
    } else {
        if (!is_array($value)) {
            return [];
        }
        $conditions = [];
        foreach ($field as $num => $fld) {
            $conditions[] = $fld
                . " = "
                . ($isRaw ? $value[$num] : "'{$value[$num]}'");
        }
        $query = "SELECT * FROM "
            . static::TABLE_NAME
            . " WHERE "
            . implode(' AND ', $conditions)
            . " LIMIT 1";
    }

    //print($query);

    return DB::queryArray($query)[0] ?? [];
}

/**
 * Returns model from DB
 * @param int $id
 * @return array
 */
public
static function getOne(int $id): array
{
    $query = "SELECT * FROM " . static::TABLE_NAME . " WHERE id = $id LIMIT 1";

    return DB::queryArray($query)[0] ?? [];
}

public
static function getOneNext($id, $isDelited = '', $isActive = ''): array
{
    $query = ORM::select(['*'], static::TABLE_NAME)
        . ORM::where('id', '>', $id, true)
        . $isDelited
        . $isActive
        . ORM::orderBy('id')
        . ORM::limit(1);

    //"SELECT * FROM " . static::TABLE_NAME . " WHERE id > $id $isDelited ORDER BY id ASC LIMIT 1";

    return DB::queryArray($query)[0] ?? [];
}

public
static function getRand($isDeleted = '')
{
    $maxID = DB::queryValue(
        ORM::select(['max(id)'], static::TABLE_NAME)
    );

    $query = ORM::select(['*'], static::TABLE_NAME)
        . ORM::where('id', '>', mt_rand(1, $maxID), true)
        . $isDeleted
        . ORM::orderBy('id')
        . ORM::limit(1);

    return DB::queryArray($query)[0] ?? false;
}

public
static function exists(int $id)
{
    return !empty(static::getOne($id)) ? true : false;
}

public
function __construct()
{
    return true;
}
}