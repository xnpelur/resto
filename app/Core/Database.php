<?php

namespace App\Core;

use PDO;

class Database 
{
    private static PDO $connection;

    /** Initialize database connection */
    public static function init()
    {
        require dirname(__DIR__) . '/config/database.php';

        $dsn = "mysql:host=$hostname;dbname=$database";

        self::$connection = new PDO($dsn, $username, $password);
    }

    /** Execute SQL statement without preparation */
    public static function query(string $sql)
    {
        $result = self::$connection->query($sql);
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    /** Execute prepared SQL statement using given arguments */
    public static function executePrepared(string $sql, array $args)
    {        
        $stmt = self::$connection->prepare($sql);
        $stmt->execute($args);
    }
}