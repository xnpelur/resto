<?php

namespace App\Core;

use App\Controllers\SiteController;

class Router
{
    private static array $routes = [];

    /** Define GET route with callback */
    public static function get(string $path, $callback)
    {
        self::$routes['get'][$path] = $callback;
    }

    /** Define POST route with callback */
    public static function post(string $path, $callback)
    {
        self::$routes['post'][$path] = $callback;
    }

    /** Resolve URL to page */
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
        } else if (is_array($callback)) {
            $callback[0] = new $callback[0]();
        }

        return call_user_func($callback);
    }

    /** Render $view with $data arguments */
    public static function renderView(string $view, array $data = [])
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        include_once dirname(__DIR__) . "/Views/$view.php";
    }
}