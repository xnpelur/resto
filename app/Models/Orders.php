<?php

namespace App\Models;

use App\Core\Model;
use App\Core\Session;

class Orders extends Model
{
    public function add(array $data)
    {
        $data['text'] = implode(', ', array_map(fn($obj) => "$obj->title - $obj->count", $data['cart']));
        unset($data['cart']);

        $this->insertTo('orders', $data);
        Session::setFlashMessage('home-success', 'Ваш заказ оформлен!');
    }
    
    public function get()
    {
        return $this->getFieldsFrom('orders');
    }

    public function delete(int $id)
    {
        $this->deleteFrom('orders', "id = $id");  
    }
}