<?php

namespace classes;

class ORMPostgre
{
    public $rawExpression;

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
        return "UPDATE $tblName ";
    }

    /**
     * @param array $fieldsvals - ['field'=>,'value'=>,'raw'=>] or [['field'=>,'value'=>,'raw'=>],['field'=>,'value'=>,'raw'=>]..]
     * @return string
     */
    public static function set(array $fieldsvals)
    {
        if (!isset($fieldsvals[0])) {
            return " SET {$fieldsvals['field']} = "
                . (
                $fieldsvals['value'] instanceof ORM
                    ? $fieldsvals['value']->rawExpression
                    : (
                isset($fieldsvals['raw'])
                    ? $fieldsvals['value']
                    : ("'" . trim($fieldsvals['value'], "'") . "'")
                )
                )
                . ' ';
        }

        $fields = [];
        foreach ($fieldsvals as $fv) {
            $fields[] = " {$fv['field']} = "
                . (
                $fv['value'] instanceof ORM
                    ? $fv['value']->rawExpression
                    : (isset($fv['raw'])
                    ? $fv['value']
                    : "'{$fv['value']}'")
                )
                . ' ';
        }

        return ' SET ' . implode(',', $fields);
    }

    public static function where($fieldName, $cond, $value, $isRaw = false)
    {
        return " WHERE ($fieldName $cond " . ($isRaw ? $value : "'$value'") . ') ';
    }

    public static function whereIn($fieldName, array $values)
    {
        return " WHERE $fieldName IN (" . implode(',', $values) . ') ';
    }

    /**
     * Makes join with WHERE and ON clauses
     * @param string $fieldName
     * @param string $cond
     * @param $value
     * @param bool $isRaw
     * @return string
     */
    public static function andWhere(string $fieldName, string $cond, $value, bool $isRaw = false): string
    {
        return " AND ($fieldName $cond " . ($isRaw ? $value : "'$value'") . ') ';
    }

    /**
     * Makes ON clause for JOINs
     * @param string $fieldName
     * @param string $cond
     * @param $value
     * @param bool $isRaw
     * @return string
     */
    public static function on(string $fieldName, string $cond, $value, bool $isRaw = false): string
    {
        return " ON ($fieldName $cond " . ($isRaw ? $value : "'$value'") . ') ';
    }

    public static function orBegin($odin = '')
    {
        if ($odin == '1') {
            $odin = 'true';
        }

        return " OR $odin ";
    }

    public static function andGrBegin($odin = '')
    {
        if ($odin == '1') {
            $odin = 'true';
        }

        return " AND ( $odin ";
    }

    public static function grEnd()
    {
        return " ) ";
    }

    public static function insert($tblName)
    {
        return "INSERT INTO $tblName ";
    }

    public static function ignore()
    {
        return " ON CONFLICT DO NOTHING ";
    }

    public static function insertFields(array $fields)
    {
        return " (" . implode(', ', $fields) . ") ";
    }

    public static function rawValues(array $values)
    {
        return " VALUES (" . implode(", ", $values) . ") ";
    }

    public static function onDupRaw(array $fieldsVals, array $conflictKeys)
    {
        if (is_array($fieldsVals[0])) {
            $expressions = array_map(fn($expr) => $expr[0] . ' = ' . $expr[1], $fieldsVals);
        } else {
            $expressions = ['' . $fieldsVals[0] . '' . ' = ' . $fieldsVals[1]];
        }

        return " ON CONFLICT (" . implode(',', $conflictKeys) . ") DO UPDATE SET " . implode(', ', $expressions) . ' ';
    }

    public static function orderBy(string $orderCond, $asc = true): string
    {
        return " ORDER BY $orderCond " . ($asc ? 'ASC' : 'DESC');
    }

    public static function orderByRand($asc = true): string
    {
        return " ORDER BY RANDOM() " . ($asc ? 'ASC' : 'DESC');
    }

    public static function select(array $fieldArr, string $tableName): string
    {
        return " SELECT " . implode(',', $fieldArr) . " FROM $tableName ";
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

    public static function unixtime($value)
    {
        return " TO_TIMESTAMP({$value}) ";
    }

    public static function andWhereIn(string $fieldName, array $values)
    {
        return " AND $fieldName IN (" . implode(',', $values) . ') ';
    }

    public static function returning(string $field)
    {
        return " RETURNING $field ";
    }
}
