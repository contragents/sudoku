<?php

namespace classes;


use BaseModel;
use Iterator;
use ReflectionProperty;
use Throwable;


/**
 * @template T of \BaseModel
 * @mixin \Iterator
 */
trait QueryTrait
{
    protected ?QueryParts $queryParts = null;

    private ?string $model = null;

    /** @var static[] */
    protected array $union = [];

    /**
     * @var static|null the value for the current iteration
     */
    private ?self $Value = null;
    /**
     * @var int|null the limit of query (without offset)
     */
    private ?int $Limit = null;
    /**
     * @var int the offset of query
     */
    private int $Offset = 0;
    /**
     * @var int the current iteration
     */
    private int $Iteration = 0;

    /**
     * @var bool|null if current element is valid
     */
    private ?bool $isValid = null;

    /**
     * @param string[] $fields
     * @return static
     */
    public static function find(array $fields = ['*']): static
    {
        $model = new static(['model' => get_called_class()]);
        $model->queryParts = new QueryParts();
        $model->queryParts->fields = $fields;

        return $model;
    }

    /**
     * Добавляет к выборке условие "неудаленные записи"
     *
     * @return static
     */
    public function active(): static
    {
        return $this->where([static::IS_DELETED_FIELD => 0]);
    }

    /**
     * @param string|array $field
     * @return static
     */
    public function groupBy(string|array $field): static
    {
        $fieldsToAdd = is_array($field) ? $field : [$field];

        // Распаковываем оба массива в один общий и сразу уникализируем
        $this->queryParts->groupBy = array_unique([
            ...$this->queryParts->groupBy,
            ...$fieldsToAdd
        ]);

        return $this;
    }

    /**
     * @param array $conditions [field1=>value1, f2=>v2] or [['field_name' => fn1, 'condition' => c1, 'value' => v1, 'raw' => r1],...]
     * @return static
     */
    public function where(array $conditions): static
    {
        foreach ($conditions as $numOrField => $condition) {
            if (is_array($condition)) {
                $value = $condition['value'] ?? ($condition[2] ?? null);
                if ($value === true || $value === false) {
                    $value = (int)$value;
                }

                if (isset($value)) {
                    $fieldName = $condition['field_name'] ?? $condition[0];

                    $this->queryParts->where[] = [
                        'field_name' => $fieldName,
                        'condition' => $condition['condition'] ?? ($condition[1] ?? '='),
                        'value' => $value,
                        'raw' => $condition['raw'] ?? ($condition[3] ?? in_array(
                                $this->model::getType($fieldName),
                                self::NUMERIC_TYPES
                            )),
                    ];
                }
            } else {
                $value = $condition;
                if ($value === true || $value === false) {
                    $value = (int)$value;
                }

                $this->queryParts->where[] =
                    [
                        'field_name' => (is_numeric($numOrField) ? static::ID_FIELD : $numOrField),
                        // если ключ - число, то поле - это id - добавить проверку
                        'condition' => '=',
                        'value' => $value,
                        'raw' => in_array(self::getType($numOrField), self::NUMERIC_TYPES),
                    ];
            }
        }

        return $this;
    }

    /**
     * @param string $orderField field for order
     * @param bool $asc true for ascending, false for descending
     * @return static
     */
    public function order(string $orderField, bool $asc = true): static
    {
        $this->queryParts->order = [$orderField, $asc];

        return $this;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return static
     */
    public function limit(int $limit, int $offset = 0): static
    {
        $this->queryParts->limit = $offset
            ? [$limit, $offset]
            : $limit;

        return $this;
    }

    /**
     * @return static|null
     */
    public function one(): ?static
    {
        $limit = $this->queryParts->limit;
        $this->limit(1, $this->queryParts->limit[1] ?? 0);

        $res = $this->all()[0] ?? null;

        $this->queryParts->limit = $limit;

        return $res;
    }

    /**
     * @return static[]
     */
    public function all(): array
    {
        $where = '';

        foreach ($this->queryParts->where as $partWhere) {
            $where .= (
            empty($where)
                ? ORM::where(...array_values($partWhere))
                : ORM::andWhere(...array_values($partWhere))
            );
        }

        if ($this->union) {
            $query = $this->getQuery();

            $result = [];
            $rows = DB::queryArray($query) ?: []; // todo сделать метод :array и провести рефакторинг

            foreach ($rows as $row) {
                $result[] = self::arrayToObject($row);
            }

            return $result;
        }

        return self::selectO(
            $this->queryParts->fields,
            $where,
            $this->getGroupBy() . $this->getOrder() . $this->getLimit()
        );
    }

    private static function getType(string $field): string
    {
        $field = ltrim($field, '_');
        $field = '_' . $field;

        try {
            $rp = new ReflectionProperty(get_called_class(), $field);
            return $rp->getType()->getName() ?? 'null';
        } catch (Throwable $e) {
            return 'null';
        }
    }

    private function getGroupBy(): string
    {
        // Если секция groupBy пуста, возвращаем пустую строку
        if (!$this->queryParts->groupBy) {
            return '';
        }

        // Передаем массив полей напрямую. Статический метод ORM сам склеит их через запятую.
        return ORM::groupBy($this->queryParts->groupBy);
    }

    private function getOrder(): string
    {
        if (!$this->queryParts->order) {
            return '';
        }

        return ORM::orderBy(
            is_array($this->queryParts->order)
                ? $this->queryParts->order[0]
                : $this->queryParts->order,
            $this->queryParts->order[1] ?? true
        );
    }

    private function getLimit(): string
    {
        if (!$this->queryParts->limit) {
            return '';
        }

        return ORM::limit(
            is_array($this->queryParts->limit)
                ? $this->queryParts->limit[0]
                : $this->queryParts->limit,
            $this->queryParts->limit[1] ?? 0
        );
    }

    /**
     * @return static&Iterator<int, static>
     */
    public function each(): Iterator
    {
        /** @var static&Iterator $iterator */
        $iterator = new static(
            [
                'model' => get_called_class(),
                'queryParts' => $this->queryParts,
                'Limit' => $this->queryParts->limit[0] ?? $this->queryParts->limit,
                'Offset' => $this->queryParts->limit[1] ?? 0,
                'union' => $this->union,
            ]
        );

        return $iterator;
    }

    /**
     * Return the current element
     * @link https://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current(): ?self
    {
        if ($this->valid()) {
            return $this->Value ?? null;
        } else {
            return null;
        }
    }

    /**
     * Move forward to next element
     * @link https://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next(): void
    {
        unset ($this->Value);
        if ($this->isValid === false) {
            return;
        }

        $this->Iteration++;
        if (isset($this->Limit) && $this->Iteration >= $this->Limit) {
            $this->isValid = false;

            return;
        }

        $this->queryParts->limit = [1, $this->Offset + $this->Iteration];

        $this->Value = $this->one();
        $this->isValid = (bool)$this->Value;
    }

    /**
     * Return the key of the current element
     * @link https://php.net/manual/en/iterator.key.php
     * @return int|null scalar on success, or null on failure.
     */
    public function key(): mixed
    {
        return $this->valid() ? $this->Iteration : null;
    }

    /**
     * Checks if current position is valid
     * @link https://php.net/manual/en/iterator.valid.php
     * @return bool The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid(): bool
    {
        return $this->isValid ?? false;
    }

    /**
     * Rewind the Iterator to the first element
     * @link https://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind(): void
    {
        $this->Iteration = 0;

        $this->queryParts->limit = [1, $this->Offset + $this->Iteration];

        $this->Value = $this->one();

        $this->isValid = (bool)$this->Value;
    }

    public function getQuery(): string
    {
        $where = $this->buildWhere();

        return ORM::select(
                $this->queryParts->fields,
                $this->union
                    ? (' ( (' . implode(
                        ') UNION (',
                        array_map(fn(self $query) => $query->getQuery(), $this->union)
                    ) . ') ) as ' . static::TABLE_NAME . '_union ')
                    : static::TABLE_NAME
            )
            . $where
            . $this->getGroupBy()
            . $this->getOrder()
            . $this->getLimit();
    }

    private function buildWhere(): string
    {
        $where = '';

        foreach ($this->queryParts->where as $partWhere) {
            $where .= (
            empty($where)
                ? ORM::where(...array_values($partWhere))
                : ORM::andWhere(...array_values($partWhere))
            );
        }

        return $where;
    }

    /**
     * Добавляет в union запросы из массива
     * @param static[] $queries
     * @return QueryTrait|BaseModel
     */
    public function union(array $queries): self
    {
        $this->union = array_merge($this->union, $queries);

        return $this;
    }
}