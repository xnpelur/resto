<?php

namespace App\Core;

use PDO;

class Database 
{
    private static PDO $connection;

    /** Initialize environment variables and database connection */
    public static function init()
    {
        self::initializeEnvVariables();

        $hostname = getenv('DB_HOSTNAME') ?? '';
        $username = getenv('DB_USERNAME') ?? '';
        $password = getenv('DB_PASSWORD') ?? '';
        $database = getenv('DB_DATABASE') ?? '';

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

    private static function initializeEnvVariables()
    {
        $env = file(dirname(__DIR__, 2) . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($env as $line) {
            putenv($line);
        }
    }
}