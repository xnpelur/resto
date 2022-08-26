<?php

namespace App\Core;

class Application
{
    public static string $ROOT_DIR;
    public static Application $app;
    public Database $db;
    public Session $session;
    
    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;

        $this->initEnvironmentVariables();
        $this->db = new Database();
        $this->session = new Session();
    }

    public function run()
    {
        echo Router::resolve();
    }

    private function initEnvironmentVariables()
    {
        $env = file(self::$ROOT_DIR . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($env as $line) {
            putenv($line);
        }
    }
}