<?php

namespace App\Core;

use PDO;

class Database 
{
    public PDO $connection;

    public function __construct()
    {
        // Move this to config file
        // ------------------------
        $hostname = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'resto';
        
        $dsn = 'mysql:host=' . $hostname . ';dbname=' . $database;

        $this->connection = new PDO($dsn, $username, $password);
        // $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function query(string $sql)
    {
        $result = $this->connection->query($sql);
        return $result->fetchAll(PDO::FETCH_OBJ);
    }
}