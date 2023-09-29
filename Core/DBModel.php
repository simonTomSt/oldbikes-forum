<?php

declare(strict_types=1);

namespace App\Core;

use Framework\Database;

abstract class DBModel
{
    protected readonly Database $db;

    public function __construct(protected readonly string $tableName)
    {
        $this->db = Application::$database;
    }

    public function create($data): void
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $query = "INSERT INTO $this->tableName($columns) VALUES($placeholders)";

        $this->db->query($query, $data);
    }


    public function find($fields = '*', $conditions = [], $limit = 25, $offset = 0): false|array
    {
        $fieldList = is_array($fields) ? implode(', ', $fields) : $fields;

        $where = '';
        if (!empty($conditions)) {
            $where = 'WHERE ';
            $conditionsList = [];
            foreach ($conditions as $key => $value) {
                $conditionsList[] = "$key = :$key";
            }
            $where .= implode(' AND ', $conditionsList);
        }

        $query = "SELECT $fieldList FROM $this->tableName $where LIMIT $limit OFFSET $offset";

        $result = $this->db->query($query, $conditions);

        return $result->findAll();
    }

    public function findById($id, $fields = '*'): mixed
    {
        $fieldList = is_array($fields) ? implode(', ', $fields) : $fields;

        $query = "SELECT $fieldList FROM $this->tableName WHERE id = :id";
        $params = ['id' => $id];

        $result = $this->db->query($query, $params);

        return $result->findOne();
    }

    public function update($id, $data): void
    {
        $setValues = [];
        $params = ['id' => $id];

        foreach ($data as $key => $value) {
            $setValues[] = "$key = :$key";
            $params[$key] = $value;
        }

        $setClause = implode(', ', $setValues);

        $query = "UPDATE $this->tableName SET $setClause WHERE id = :id";

        $this->db->query($query, $params);
    }

    public function delete($id): void
    {
        $query = "DELETE FROM $this->tableName WHERE id = :id";
        $params = ['id' => $id];

        $this->db->query($query, $params);
    }
}