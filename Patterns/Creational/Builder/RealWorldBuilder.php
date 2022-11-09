<?php

namespace App\Patterns\Creational\Builder;

use Exception;

interface SQLQueryBuilder
{
    public function select(string $table, array $fields): static;

    public function where(string $field, string $value, string $operator = '=',): static;

    public function limit(int $start, int $offset): static;

    public function getSql(): string;

}

class MysqlQueryBuilder implements SQLQueryBuilder
{
    protected object $query;

    protected function reset(): void
    {
        $this->query = new \stdClass();
    }

    public function select(string $table, array $fields): static
    {
        $this->reset();
        $this->query->base = 'SELECT ' . implode(', ', $fields) . ' FROM ' . $table;
        $this->query->type = 'select';

        return $this;
    }

    /**
     * @throws Exception
     */
    public function where(string $field, string $value, string $operator = '=',): static
    {
        if (!in_array($this->query->type, ['select', 'update', 'delete'])) {
            throw new Exception("WHERE can only be added to SELECT, UPDATE OR DELETE");
        }
        $this->query->where[] = "$field $operator '$value'";

        return $this;
    }

    /**
     * @throws Exception
     */
    public function limit(int $start, int $offset): static
    {
        if ($this->query->type != 'select') {
            throw new Exception('LIMIT can only be added to SELECT');
        }
        $this->query->limit = 'LIMIT ' . $start . ',' . $offset;

        return $this;
    }

    public function getSql(): string
    {
        $query = $this->query;
        $sql = $query->base;
        if (!empty($query->where)) {
            $sql .= " WHERE " . implode(' AND ', $query->where);
        }
        if (isset($query->limit)) {
            $sql .= $query->limit;
        }
        $sql .= ";";
        return $sql;
    }
}

class PostgresQueryBuilder extends MysqlQueryBuilder
{
    /**
     * PostgreSQL имеет несколько иной синтаксис LIMIT.
     */
    public function limit(int $start, int $offset): static
    {
        parent::limit($start, $offset);

        $this->query->limit = " LIMIT " . $start . " OFFSET " . $offset;

        return $this;
    }
}

$queryBuilder = new MysqlQueryBuilder();

try {
    $query = $queryBuilder
        ->select('users', ['id', 'name', 'age', ])
        ->where('name', 'Dmitry', '=')
        ->where('age', '18', '>')
        ->limit(0,20)
        ->getSql();

    echo $query . PHP_EOL;

} catch (Exception $exception){
    echo $exception->getMessage() . PHP_EOL;
}


$queryBuilderPostgres = new PostgresQueryBuilder();

try {
    $query = $queryBuilderPostgres
        ->select('users', ['id', 'name', 'age', ])
        ->where('name', 'Dmitry', '=')
        ->where('age', '18', '>')
        ->limit(0,20)
        ->getSql();

    echo $query . PHP_EOL;

} catch (Exception $exception){
    echo $exception->getMessage() . PHP_EOL;
}