<?php

namespace classes;

/** Класс ORM для работы с MariaDB */
class ORM
{
    public $rawExpression;

    const COUNT = 'COUNT';
    const MAX = 'MAX';
    const MIN = 'MIN';
    const ANY_VALUE = 'ANY_VALUE';
    const AVG = 'AVG';
    const DATE = 'DATE';
    const AGG_FUNCTIONS = [self::COUNT, self::MAX, self::MIN, self::ANY_VALUE, self::AVG, self::DATE];

    public function __construct($expression)
    {
        $this->rawExpression = $expression;
    }

    /**
     * Use ORM::set() as next constructor element
     * @param $tblName
     * @return string
     */
    public static function update($tblName)
    {
        if (!str_contains($tblName, '.')) {
            return "UPDATE `$tblName` ";
        } else return "UPDATE $tblName ";
    }

    /**
     * @param array $fieldsvals - ['field'=>,'value'=>,'raw'=>] or [['field'=>,'value'=>,'raw'=>],['field'=>,'value'=>,'raw'=>]..]
     * @return string
     */
    public static function set(array $fieldsvals)
    {
        if (!isset($fieldsvals[0]) && isset($fieldsvals['field']) && isset($fieldsvals['value'])) {
            return " SET {$fieldsvals['field']} = "
                . (
                $fieldsvals['value'] instanceof ORM
                    ? $fieldsvals['value']->rawExpression
                    : (($fieldsvals['raw'] ?? false)
                    ? $fieldsvals['value']
                    : ("'" . DB::escapeString($fieldsvals['value']) . "'")
                )
                )
                . ' ';
        }

        if (isset($fieldsvals[0]['field']) && isset($fieldsvals[0]['value'])) {
            $fields = [];
            foreach ($fieldsvals as $fv) {
                $fields[] = " {$fv['field']} = "
                    . (
                    $fv['value'] instanceof ORM
                        ? $fv['value']->rawExpression
                        : (($fv['raw'] ?? false)
                        ? $fv['value']
                        : ("'" . DB::escapeString($fv['value']) . "'")
                    )
                    )
                    . ' ';
            }

            return ' SET ' . implode(',', $fields);
        }

        return ' SET ' . implode(',', array_map(fn($field, $value) => " $field = " . ("'" . DB::escapeString($value) . "'"), array_keys($fieldsvals), $fieldsvals));
    }

    public static function where($fieldName, $cond, $value, $isRaw = false)
    {
        return " WHERE ($fieldName $cond " . ($value instanceof ORM ? $value->rawExpression : ($isRaw ? $value : "'$value'")) . ') ';
    }

    public static function andWhere($fieldName, $cond, $value, $isRaw = false)
    {
        return " AND ($fieldName $cond " . ($value instanceof ORM ? $value->rawExpression : ($isRaw ? $value : "'$value'")) . ') ';
    }

    public static function orBegin($odin = '')
    {
        return " OR $odin ";
    }

    public static function andGrBegin($odin = '')
    {
        return " AND ( $odin ";
    }

    public static function grEnd()
    {
        return " ) ";
    }

    public static function insert($tblName, $ignore = ''): string
    {
        if (!str_contains($tblName, '.')) {
            return "INSERT $ignore INTO `$tblName` ";
        } else {
            return "INSERT $ignore INTO $tblName ";
        }
    }

    public static function insertFieldsRawValues(array $fieldsVarsArr): string
    {
        return self::insertFields(array_keys($fieldsVarsArr))
            . self::rawValues($fieldsVarsArr);
    }

    public static function insertFields(array $fields): string
    {
        return " (" . implode(', ', $fields) . ") ";
    }

    public static function rawValues(array $values): string
    {
        return " VALUES (" . implode(", ", $values) . ") ";
    }

    public static function onDupRaw(array $fieldsVals, $conflictKeys = [])
    {
        if (is_array($fieldsVals[0])) {
            $expressions = array_map(
                function ($expr) {
                    return '`' . $expr[0] . '`' . ' = ' . $expr[1];
                },
                $fieldsVals
            );
        } else {
            $expressions = ['`' . $fieldsVals[0] . '`' . ' = ' . $fieldsVals[1]];
        }

        return " ON DUPLICATE KEY UPDATE " . implode(', ', $expressions);
    }

    public static function orderBy(string $orderCond, $asc = true): string
    {
        return " ORDER BY $orderCond " . ($asc ? 'ASC' : 'DESC');
    }

    public static function orderByRand($asc = true): string
    {
        return " ORDER BY rand() " . ($asc ? 'ASC' : 'DESC');
    }

    public static function select(array $fieldArr, string $tableName): string
    {
        return " SELECT " . implode(',', $fieldArr ?: ['*']) . " FROM $tableName ";
    }

    public static function limit(int $count, $offset = 0): string
    {
        return " LIMIT $count " . ($offset ? " OFFSET $offset " : '');
    }

    public static function union(): string
    {
        return ' UNION ';
    }

    public static function innerJoin($tableName): string
    {
        return " INNER JOIN $tableName ";
    }

    public static function leftJoin($tableName): string
    {
        return " LEFT JOIN $tableName ";
    }

    public static function on($fieldName, $cond, $value, $isRaw = false)
    {
        return " ON ($fieldName $cond " . ($isRaw ? $value : "'$value'") . ') ';
    }

    public static function unixtime($value)
    {
        return " FROM_UNIXTIME({$value}) ";
    }

    public static function groupBy(array $conditions)
    {
        return ' GROUP BY ' . implode(', ', $conditions) . ' ';
    }

    public static function andWhereIn(string $fieldName, array $values)
    {
        return " AND $fieldName IN (" . implode(',', $values) . ') ';
    }

    public static function whereIn($fieldName, array $values)
    {
        return " WHERE $fieldName IN (" . implode(',', $values) . ') ';
    }

    /**
     * @param string $function
     * @param string $field
     * @param ?string $as if NULL - no 'as...' alias will folow
     * @return string
     * @throws \Exception
     */
    public static function agg(string $function, string $field, ?string $as = ''): string
    {
        if (!in_array($function, self::AGG_FUNCTIONS)) {
            throw new \Exception("$function is not a valid function");
        }

        return ' '
            . $function
            . '('
            . $field
            . ') '
            . (is_null($as) ? '' : ($as ?: $field))
            . ' ';
    }

    public static function andNot($fieldName, $cond, $value, $isRaw = false): string
    {
        return ' AND NOT ' . self::getWhereCondition($fieldName, $cond, $value, $isRaw);
    }

    public static function skobki(string $expression): string
    {
        return ' ( ' . $expression . ' ) ';
    }

}
