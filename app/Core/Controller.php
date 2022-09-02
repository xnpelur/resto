<?php

namespace App\Core;

use App\Models\Admin;
use App\Models\Menu;
use App\Models\Options;
use App\Models\Orders;
use App\Models\Reviews;

class Controller
{
    protected Menu $menu;
    protected Options $options;
    protected Reviews $reviews;
    protected Admin $admin;
    protected Orders $orders;

    public function __construct()
    {
        $this->menu = new Menu();
        $this->options = new Options();
        $this->reviews = new Reviews();
        $this->admin = new Admin();
        $this->orders = new Orders();

        Session::start();
    }

    /** Render given view with initializing $data variables */
    protected function render(string $view, array $data = [])
    {
        return Router::renderView($view, $data);
    }

    /** Get request data (GET, POST, FILES) */
    protected function getRequestBody()
    {
        return Request::getBody();
    }

    /** Redirect user to given path */
    protected function redirect(string $path)
    {
        header('Location: ' . $path);
        exit;
    }

    public function __destruct()
    {
        Session::end();
    }
}
