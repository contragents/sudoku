<?php

use classes\Cache;
use classes\DB;
use classes\GomokuGame;
use classes\ORM;
use classes\SudokuGame;


/**
 * @property int $_id
 **/

class BaseModel
{
    const CONDITIONS = ['=' => '=', '!=' => '!=', 'in' => 'in', '<' => '<', '>' => '>', '<=' => '<=', '>=' => '>=',];
    const TABLE_NAME = 'players';
    const AND_NOT_DELETED = ' AND is_deleted = 0 ';

    const ID_FIELD = 'id';
    const CREATED_AT_FIELD = 'created_at';
    const UPDATED_AT_FIELD = 'updated_at';
    const IS_DELETED_FIELD = 'is_deleted';
    const COMMON_ID_FIELD = 'common_id';

    const SKIP_ATTR_TYPES = ["object", "resource", "resource (closed)", "NULL", "unknown type"];

    const CURRENT_TIMESTAMP = 'CURRENT_TIMESTAMP';

    const FIELDS = [self::ID_FIELD => self::TYPE_INT];

    const TYPE_INT = 'int';
    const TYPE_STRING = 'string';
    const TYPE_DATE = 'timestamp';
    const TEASERS_IN_CHUNK = 1000;
    const ERUDIT = 'erudit';
    const SCRABBLE = 'scrabble';

    const GAME_IDS = [
        self::ERUDIT => 1,
        self::SCRABBLE => 2,
        SudokuGame::GAME_NAME => 3,
        GomokuGame::GAME_NAME => 4,
    ];

    public ?int $_id = null;

    /**
     * Обновляет модель из БД. Если $_id не установлен или не найден, то ничего не делает и возвращает false
     * @return bool
     */
    public function refresh(): bool
    {
        if(!$this->_id) {
            return false;
        }

        if($freshModel = static::getOneO($this->_id)) {
            foreach(get_object_vars($freshModel) as $property => $value) {
                $this->$property = $value;
            }

            // Делаем еще один прогон присвоения - чтобы исключить поля, записанные как null в БД
            foreach(get_object_vars($this) as $property => $nothing) {
                $this->$property = $freshModel->$property;
            }

            return true;
        } else {
            return false;
        }
    }

    private static function fieldName(string $property): string
    {
        return ltrim($property, '_');
    }

    private static function isFieldName(string $property): bool
    {
        return substr($property, 0, 1) === '_';
    }

    private function from_boolean(bool $value): int
    {
        return (int)$value;
    }

    private function from_array(bool $value): string
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function to_boolean(int $value): bool
    {
        return (bool)$value;
    }

    public function to_array(string $value): array
    {
        return json_decode($value, true);
    }

    public function save(): bool
    {
        $properties = get_object_vars($this);
        $fieldsVals = [];

        foreach($properties as $property => $value) {
            $valueType = gettype($value);
            if(self::isFieldName($property) && !in_array($valueType, self::SKIP_ATTR_TYPES)) {
                if (is_callable([$this, "from_$valueType"])) {
                    try {
                        $value = call_user_func([$this, "from_$valueType"], $value);
                    } catch(Throwable $e) {
                        continue;
                    }
                }

                $fieldsVals[self::fieldName($property)] = $value;
            }
        }

        if(($this->_id ?? false) && self::exists($this->_id)) {
            unset($fieldsVals['id']);
            return self::update($this->_id, $fieldsVals);
        } else {
            $id = self::add($fieldsVals);
            if (is_int($id)) {
                $this->_id = $id;
            }

            return (bool)$id;
        }
    }

    /**
     * @param array $fieldsVals
     * @return static|null
     */
    public static function new(array $fieldsVals = []): ?object
    {
        return self::arrayToObject($fieldsVals);
    }

    /**
     * @param array $row
     * @return static
     */
    protected static function arrayToObject(array $row): object
    {
        $res = new static();
        $properties = get_object_vars($res);

        foreach ($row as $field => $value) {
            $property = '_' . $field;

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
                continue;
            }
        }

        return $res;
    }

    /**
     * @param array $fields
     * @param string $where
     * @param string $other
     * @return static[]
     */
    public static function selectO(array $fields = [], string $where = '', string $other = ''): array
    {
        $query = ORM::select($fields, static::TABLE_NAME)
            . ' ' . $where
            . ' ' . $other;

        $rows = DB::queryArray($query) ?: [];

        $res = [];

        foreach($rows as $row) {
            $res[] = self::arrayToObject($row);
        }

        return $res;
    }

    /**
     * @param $field
     * @param $value
     * @param bool $isRaw
     * @return static
     */
    public static function getOneCustomO($field, $value, bool $isRaw = false): ?self
    {
        $row = self::getOneCustom($field, $value, $isRaw);

        return empty($row) ? null : self::arrayToObject($row);
    }

    /**
     * @param string $field
     * @param string $condition
     * @param $value
     * @param bool $isRaw
     * @return static[]
     */
    public static function getCustomO(string $field, string $condition, $value, bool $isRaw = false): array
    {
        $rows = self::getCustom($field, $condition, $value, $isRaw);
        $res = [];

        foreach($rows as $row) {
            $res[] = self::arrayToObject($row);
        }

        return $res;
    }

    /**
     * @param int $id
     * @param bool $createIfNotExists
     * @return static|null
     */
    public static function getOneO(int $id, bool $createIfNotExists = false): ?object {
        $row = self::getOne($id);

        if (!empty($row)) {
            $res = self::arrayToObject($row);
        } elseif($createIfNotExists) {
            $res = new static();
            $res->_id = $id;
        }

        return $res ?? null;
    }

    public static function select(array $fields = [], bool $skobki = false, string $where = '', string $as = ''): string
    {
        return ($skobki ? ' ( ' : '')
            . ORM::select($fields, static::TABLE_NAME)
                . $where
            . ($skobki ? ' ) ' : '')
            . ($as ? " as $as" : '');
    }

    public static function getFieldWithTable(string $field): string
    {
        return ' ' . static::TABLE_NAME . '.' . $field . ' ';
    }

    public static function add(array $fieldsVals)
    {
        $query = ORM::insert(static::TABLE_NAME, 'IGNORE')
            . ORM::insertFields(array_keys($fieldsVals))
            . ORM::rawValues(
                array_map(
                    fn($value) => $value instanceof ORM
                        ? $value->rawExpression
                        : ("'" . DB::escapeString($value) . "'"),
                    $fieldsVals
                )
            );

        if (DB::queryInsert($query)) {
            return DB::insertID() ?: true;
        } else {
            return false;
        }
    }

    /**
     * Sets 1 param of model
     * @param $id
     * @param $field
     * @param $value
     * @param bool $raw
     * @return bool
     */
    public static function setParam($id, $field, $value, bool $raw = false): bool
    {
        $updateQuery = ORM::update(static::TABLE_NAME)
            . ORM::set(
                [
                    'field' => $field,
                    'value' => ($raw || ($value instanceof ORM)) ? $value : DB::escapeString($value),
                    'raw' => $raw
                ]
            )
            . ORM::where('id', '=', $id, true);

        if (DB::queryInsert($updateQuery)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets field value for all table
     * @param string $field
     * @param mixed $value raw value or ORM Expression
     * @param array $where = []
     * @return false|int
     */
    public static function setParamMass(string $field, $value, array $where = [])
    {
        if (is_array($field) && is_array($value)) {
            $setValues = array_map(
                fn($fld, $val) => [
                    'field' => $fld,
                    'value' => $val instanceof ORM ? $val : DB::escapeString($val)
                ],
                $field,
                $value
            );
        } else {
            $setValues = [
                'field' => $field,
                'value' => $value instanceof ORM ? $value : DB::escapeString($value)
            ];
        }

        $ormWhere = '';

        if (isset($where['field_name'])) {
            $ormWhere = ORM::where($where['field_name'], $where['condition'], $where['value'], $where['raw'] ?? false);
        } elseif(isset($where[0]['field_name'])) {
            $ormWhere = ORM::where('1', '=', 1, true)
                . implode(
                    ' ',
                    array_map(
                        fn($andWhere) => ORM::andWhere(
                            $andWhere['field_name'],
                            $andWhere['condition'],
                            $andWhere['value'],
                            $andWhere['raw'] ?? false
                        ),
                        $where
                    )
                );
        }

        $query = ORM::update(static::TABLE_NAME)
            . ORM::set($setValues)
            . $ormWhere;

        Cache::hset('parammass_query', $query, $query);

        return DB::queryInsert($query);
    }

    /**
     * @param $id
     * @param array $fieldsvals [$field1=>$val1, $field2=>$val2 ...]
     * @return bool
     */
    public static function update($id, array $fieldsvals): bool
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

    public static function getLastID(): int
    {
        return (int)(DB::queryValue("SELECT max(id) as mx FROM " . static::TABLE_NAME) ?: 0);
    }

    public static function getFirstID(): ?int
    {
        return (int)(DB::queryValue("SELECT min(id) as mn FROM " . static::TABLE_NAME) ?: 0) ?: null;
    }

    public static function findAll(array $fieldList = [])
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
    public static function findAllCustom($field, $value, $isRaw = false, array $fieldList = []): array
    {
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
     * @param string|array $field
     * @param string|array $condition
     * @param $value
     * @param bool $isRaw
     * @param bool $noResult Признак ненужности результата - только обновить кэш моделей
     * @param array $fields
     * @return array
     */
    public static function getCustomComplex(
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
                return [];
            }

            if (count($field) != count($condition) || count($field) != count($value) || count($field) == 0) {
                return [];
            }

            $iteration = false;
            foreach ($field as $num => $fld) {
                if ($condition[$num] == self::CONDITIONS['in']) {
                    if (
                        !is_array($value[$num])
                        ||
                        (count($value[$num]) > 1000) // todo разбить по чанкам
                        ||
                        empty($value[$num])
                    ) {
                        return [];
                    }

                    $query .= $iteration
                        ? ORM::andWhereIn($fld, $value[$num])
                        : ORM::whereIn($fld, $value[$num]);
                } else {
                    if (!in_array($condition[$num], self::CONDITIONS)) {
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
                    (count($value) > 1000)
                    ||
                    empty($value)
                ) {
                    return [];
                }

                $query .= ORM::whereIn($field, $value);
            } else {
                if (!in_array($condition, self::CONDITIONS)) {
                    return [];
                }
                $query .= ORM::where($field, $condition, $value, $isRaw);
            }
        }

        return DB::queryArray($query) ?: [];
    }


    /**
     * Получаем все записи ИЗ БД по условию и обновляем КЭШ
     * @param string $field
     * @param string $condition
     * @param $value
     * @param bool $isRaw
     * @param bool $noResult Признак ненужности результата - только обновить кэш моделей
     * @param array $fields
     * @return array
     */
    public static function getCustom(
        string $field,
        string $condition,
        $value,
        bool $isRaw = false,
        bool $noResult = false,
        array $fields = []
    ): array {
        // todo сделать 'IN' по чанкам
        $query = ORM::select($fields ?: ['*'], static::TABLE_NAME);
        if ($condition == self::CONDITIONS['in']) {
            if (
                !is_array($value)
                ||
                (count($value) > self::TEASERS_IN_CHUNK)
                ||
                empty($value)
            ) {
                return [];
            }

            $query .= ORM::whereIn($field, $value);
        } else {
            if (!in_array($condition, self::CONDITIONS)) {
                return [];
            }
            $query .= ORM::where($field, $condition, $value, $isRaw);
        }

        return DB::queryArray($query) ?: [];
    }

    /**
     * Returns one record or []
     * @param $field
     * @param $value
     * @param false $isRaw
     * @return array
     */
    public static function getOneCustom($field, $value, $isRaw = false): array
    {
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

        return DB::queryArray($query)[0] ?? [];
    }

    /**
     * Returns model from DB
     * @param int $id
     * @return array
     */
    public static function getOne(int $id): array
    {
        $query = "SELECT * FROM " . static::TABLE_NAME . " WHERE id = $id LIMIT 1";

        return DB::queryArray($query)[0] ?? [];
    }

    /**
     * @param int $id
     * @param bool $ignoreDeleted
     * @return static|null
     */
    public static function getOneNextO(int $id, bool $ignoreDeleted = true): ?object {
        $row = self::getOneNext($id, $ignoreDeleted ? '' : '');

        if (!empty($row)) {
            $res = self::arrayToObject($row);
        }

        return $res ?: null;
    }

    public static function getOneNext($id, $isDelited = ''): array
    {
        $query = ORM::select(['*'], static::TABLE_NAME)
            . ORM::where('id', '>', $id, true)
            . $isDelited
            . ORM::orderBy('id')
            . ORM::limit(1);

        return DB::queryArray($query)[0] ?? [];
    }

    public static function getRand($isDeleted = '')
    {
        $maxID = DB::queryValue(
            ORM::select(['max(id)'], static::TABLE_NAME)
        );

        $query = ORM::select(['*'], static::TABLE_NAME)
            . ORM::where('id', '>', rand(1, $maxID), true)
            . $isDeleted
            . ORM::orderBy('id')
            . ORM::limit(1);

        return DB::queryArray($query)[0] ?? false;
    }

    public static function exists(int $id): bool
    {
        return !empty(static::getOne($id));
    }

    /**
     * if at least one record exists
     * @param array $conditions [field=>value] list
     * @return bool
     */
    public static function existsCustom(array $conditions): bool
    {
        $query = ORM::select(['count(1)'], static::TABLE_NAME)
            . ORM::where(1, '=', 1, true)
            . implode(
                ' ',
                array_map(
                    fn($field, $value) => ORM::andWhere($field, '=', $value),
                    array_keys($conditions),
                    $conditions
                )
            );

        return ((int)DB::queryValue($query) ?: 0) > 0;
    }

    public function __construct()
    {
        return true;
    }

    /**
     * Mass update fields=>values by conditions
     * @param array $fieldsVals ['f1'=>'v1', 'f2'=>'v2'...]
     * @param array $whereArr [[$field, $condition, $value, $isRaw = false],[]...] OR [$field, $condition, $value, $isRaw = false]
     */
    public static function updateWhere(array $fieldsVals, array $whereArr): bool
    {
        $updateQuery = ORM::update(static::TABLE_NAME)
            . ORM::set($fieldsVals)
            . ORM::where(1,'=', 1, true)
            . implode(' ', array_map(
                fn($where) => ORM::andWhere($where[0], $where[1], $where[2], $where[3] ?? false),
                is_array($whereArr[0]) ? $whereArr : [$whereArr]
            ));

        if (DB::queryInsert($updateQuery)) {
            return true;
        } else {
            //Cache::rpush('stats_failed', ['query' => $updateQuery]);

            return false;
        }
    }
}