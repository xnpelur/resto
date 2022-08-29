<?php

namespace App\Controllers;

use App\Core\Session;
use App\Core\Controller;

class DataController extends Controller
{
    public function addMeal()
    {
        $postData = $this->getRequestBody();
        $this->menu->add($postData);

        $this->redirect('/admin');
    }

    public function getMeal()
    {
        $id = $this->getRequestBody()['id'];
        $meal = $this->menu->getMeal($id)[0];

        return json_encode($meal);
    }

    public function changeMeal()
    {
        $postData = $this->getRequestBody();
        $this->menu->change($postData);

        $this->redirect('/admin');
    }

    public function deleteMeal()
    {
        $id = $this->getRequestBody()['meal-id'];
        $this->menu->delete($id);

        $this->redirect('/admin');
    }

    public function addReview()
    {
        $postData = $this->getRequestBody();
        $this->reviews->add($postData);

        $this->redirect('/');
    }

    public function deleteReview()
    {
        $id = $this->getRequestBody()['review-id'];
        $this->reviews->delete($id);

        $this->redirect('/admin');
    }

    public function setOptions()
    {
        $postData = $this->getRequestBody();
        $this->options->set($postData);

        $this->redirect('/admin');
    }

    public function login()
    {
        $postData = $this->getRequestBody();

        Session::setLoginData($postData);
        $result = Session::tryLogin();

        if ($result) {
            $this->redirect('/admin');
        } else {
            Session::setFlashMessage('login-error', 'Неверный логин или пароль');
            $this->redirect('/login');
        }
    }

    public function logout()
    {
        Session::logout();
        $this->redirect('/login');
    }

    public function setAdmin()
    {
        $postData = $this->getRequestBody();
        $this->admin->setAdminData($postData);

        $this->redirect('/admin');
    }

    public function addToCart()
    {
        $data = $this->getRequestBody();
        $data['count'] = 1;
        $meal = (object)$data;
        Session::addToShoppingCart($meal);
    }

    public function changeCartCount()
    {
        $postData = $this->getRequestBody();
        Session::changeCartCount($postData);
    }

    public function deleteCartMeal()
    {
        $id = $this->getRequestBody()['id'];
        Session::deleteCartMeal($id);
    }

    public function getCartTotalAmount()
    {
        echo Session::getCartTotalAmount();
    }
}
