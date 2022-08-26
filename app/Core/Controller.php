<?php

namespace App\Core;

use App\Models\Menu;
use App\Models\Options;
use App\Models\Reviews;

class Controller
{
    public Menu $menu;
    public Options $options;
    public Reviews $reviews;

    public function __construct()
    {
        $this->menu = new Menu();
        $this->options = new Options();
        $this->reviews = new Reviews();
    }

    public function render($view, $data = [])
    {
        return Router::renderView($view, $data);
    }

    protected function getRequestBody()
    {
        return Request::getBody();
    }

    protected function redirect($path)
    {
        header('Location: ' . $path);
        exit;
    }
}