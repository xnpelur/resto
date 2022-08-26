<?php

namespace App\Core;

use App\Controllers\SiteController;

class Router
{
    private static array $routes = [];

    public static function get($path, $callback)
    {
        self::$routes['get'][$path] = $callback;
    }

    public static function post($path, $callback)
    {
        self::$routes['post'][$path] = $callback;
    }

    public static function resolve()
    {
        $path = Request::getPath();
        $method = Request::getMethod();

        $callback = self::$routes[$method][$path] ?? false;
        if ($callback === false) {
            http_response_code(404);
            $callback = [SiteController::class, 'pageNotFound'];
        }

        if (is_string($callback)) {
            return self::renderView($callback);
        }

        if (is_array($callback)) {
            $callback[0] = new $callback[0]();
        }

        return call_user_func($callback);
    }

    public static function renderView($view, $data = [])
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        include_once Application::$ROOT_DIR . "/app/Views/$view.php";
    }
}