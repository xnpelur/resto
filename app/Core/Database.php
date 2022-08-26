<?php

namespace App\Core;

use PDO;

class Database 
{
    public PDO $connection;

    public function __construct()
    {
        $hostname = getenv('DB_HOSTNAME') ?? '';
        $username = getenv('DB_USERNAME') ?? '';
        $password = getenv('DB_PASSWORD') ?? '';
        $database = getenv('DB_DATABASE') ?? '';

        $dsn = "mysql:host=$hostname;dbname=$database";

        $this->connection = new PDO($dsn, $username, $password);
    }

    public function query(string $sql)
    {
        $result = $this->connection->query($sql);
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public function executePrepared(string $sql, array $args)
    {        
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($args);
    }
}