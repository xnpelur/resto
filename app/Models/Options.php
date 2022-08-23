<?php

namespace App\Models;

use App\Core\Model;

class Options extends Model
{
    public function get(string $optionName = '')
    {
        $queryResult = $this->getFieldsFrom('options');
        $optionsArray = [];

        foreach ($queryResult as $element) {
            $optionsArray[$element->name] = $element->value;
        }

        $options = (object)$optionsArray;

        if ($optionName !== '') {
            return $options->$optionName; 
        }

        return $options; 
    }
}