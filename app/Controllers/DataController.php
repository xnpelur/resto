<?php

namespace App\Controllers;

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
}