<?php

namespace App\Core;

use App\Controllers\SiteController;

class Router
{
    private Request $request;
    protected array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $args = [];

        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            $this->response->setStatusCode(404);
            $callback = [SiteController::class, 'pageNotFound'];
            // return $this->renderView('404');
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            $callback[0] = new $callback[0]();
            if (isset($callback[2])) {
                // If additional args are set
                $args = array_slice($callback, 2);
                $callback = array($callback[0], $callback[1]);
            }
        }

        return call_user_func_array($callback, $args);
    }

    public function renderView($view, $data = [])
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        include_once Application::$ROOT_DIR . "/app/Views/$view.php";
    }
}