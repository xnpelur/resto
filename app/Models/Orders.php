<?php

namespace App\Models;

use App\Core\Model;

class Orders extends Model
{
    public function add(array $data)
    {
        $data['text'] = implode(', ', array_map(fn($obj) => "$obj->title - $obj->count", $data['cart']));
        unset($data['cart']);

        $this->insertTo('orders', $data);
    }
}