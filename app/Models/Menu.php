<?php

namespace App\Models;

use App\Core\Model;

class Menu extends Model
{
    public function get($type)
    {
        return $this->getFieldsFrom('menu', "type = '$type'");
    }
}