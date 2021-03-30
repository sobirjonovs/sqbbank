<?php

namespace Database;

use PDO;

class Currency extends Database
{
    private $table = "currencies";

    /**
     * @param array $columns
     * @param string|null $tableName
     * @return false|\PDOStatement
     */
    public function createTable(array $columns)
    {
        $columns = implode(',', $columns);
        $this->exec("CREATE TABLE `{$this->table}` ({$columns})");
    }

    public function create(array $parameters)
    {
        $tables = implode(',', array_keys($parameters));
        try {
            $countValues = substr(str_repeat('?,', count($parameters)),0,-1);
            $statement = $this->prepare("INSERT INTO {$this->table} ({$tables}) VALUES({$countValues})");
            $statement->execute(array_values($parameters));
        } catch (\PDOException $PDOException) {
            echo $PDOException->getMessage();
        }
    }

    public function all()
    {
        return $this->query("SELECT * FROM {$this->table}")->fetchAll(PDO::FETCH_ASSOC);
    }
}