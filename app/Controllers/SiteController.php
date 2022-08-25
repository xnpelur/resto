<?php

namespace App\Controllers;

use App\Core\Controller;

class SiteController extends Controller
{
    public function index()
    {
        $data = [
            'specialMeals'  => $this->menu->get('special'),
            'regularMeals'  => $this->menu->get('regular'),
            'reviews'       => $this->reviews->get(),
            'options'       => $this->options->get()
        ];

        $this->render('home', $data);
    }
    
    public function admin()
    {
        $data = [
            'siteName' => $this->options->get('site_name')
        ];

        $this->render('admin', $data);
    }

    public function partial()
    {
        $name = $this->getRequestBody()['name'];

        if ($name === null) {
            header('Location: /');
        }

        $data = [];
        if ($name === 'menu') {
            $data['specialMeals'] = $this->menu->get('special');
            $data['regularMeals'] = $this->menu->get('regular');
        } else if ($name === 'reviews') {
            $data['reviews'] = $this->reviews->get();
        } else if ($name === 'options' || $name === 'about') {
            $data['options'] = $this->options->get();
        }

        $this->render('partials/' . $name, $data);
    }

    public function pageNotFound()
    {
        $data = [
            'options' => $this->options->get()
        ];

        $this->render('404', $data);
    }
}