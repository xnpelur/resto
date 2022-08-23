<?php

namespace App\Models;

use App\Core\Model;

class Reviews extends Model
{
    public function get()
    {
        return $this->getFieldsFrom('reviews');
    }
}