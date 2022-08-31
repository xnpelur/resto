<?php

namespace App\Controllers;

use App\Core\Session;
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
        if (Session::tryLogin() === false) {
            $this->redirect('/login');
        }
        
        $data = [ 'siteName' => $this->options->get('site_name') ];
        $this->render('admin', $data);
    }

    public function login()
    {
        if (Session::tryLogin()) {
            $this->redirect('/admin');
        }
        $this->render('login');
    }

    public function partial()
    {
        $name = $this->getRequestBody()['name'];

        if ($name === null) {
            $this->redirect('/');
        }

        $data = [];
        if ($name === 'orders') {
            $data['orders'] = $this->orders->get();
        } else if ($name === 'menu') {
            $data['specialMeals'] = $this->menu->get('special');
            $data['regularMeals'] = $this->menu->get('regular');
        } else if ($name === 'reviews') {
            $data['reviews'] = $this->reviews->get();
        } else if ($name === 'options' || $name === 'about') {
            $data['options'] = $this->options->get();
        } else if ($name === 'profile') {
            $data['profile'] = $this->admin->getAdminData();
        }

        $this->render('partials/' . $name, $data);
    }

    public function getCart()
    {
        $cart = Session::getShoppingCart();

        $data = [
            'cart' => $cart
        ];

        $this->render('partials/cart', $data);
    }

    public function pageNotFound()
    {
        $data = [
            'options' => $this->options->get()
        ];
        
        $this->render('404', $data);
    }
}