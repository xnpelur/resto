<?php

namespace App\Core;

use App\Models\Admin;
use App\Models\Menu;
use App\Models\Options;
use App\Models\Orders;
use App\Models\Reviews;

class Controller
{
    public Menu $menu;
    public Options $options;
    public Reviews $reviews;
    public Admin $admin;
    public Orders $orders;

    public function __construct()
    {
        $this->menu = new Menu();
        $this->options = new Options();
        $this->reviews = new Reviews();
        $this->admin = new Admin();
        $this->orders = new Orders();
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