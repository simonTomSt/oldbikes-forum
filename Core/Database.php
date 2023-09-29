<?php

declare(strict_types=1);

namespace Framework;

use PDO;
use PDOException;
use PDOStatement;

class Database
{
    private PDO $connection;
    private PDOStatement $stmt;

    public function __construct(
        array $dbConfig,
    )
    {
        $dsn = $dbConfig['dsn'];
        $username = $dbConfig['username'];
        $password = $dbConfig['password'];

        try {
            $this->connection = new PDO($dsn, $username, $password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException) {
            die("Unable to connect to database");
        }
    }

    public function query(string $query, array $params = []): Database
    {
        $this->stmt = $this->connection->prepare($query);

        $this->stmt->execute($params);

        return $this;
    }

    public function findOne(): mixed
    {
        return $this->stmt->fetch();
    }

    public function findAll(): false|array
    {
        return $this->stmt->fetchAll();
    }
}