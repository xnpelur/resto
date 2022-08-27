<?php

namespace App\Models;

use App\Core\Session;
use App\Core\Model;

class Admin extends Model
{
    private static $isAuthorized = false;
    
    public function verifyLoginData(array $data)
    {
        $correctLoginData = $this->getLoginData();
        self::$isAuthorized = $data['login'] == $correctLoginData['login'] && password_verify($data['password'], $correctLoginData['password']);
        
        if (self::$isAuthorized) {
            Session::setLoginData($data);
            return true;
        }
        return false;
    }
    
    private function getLoginData()
    {
        $queryResult = $this->getFieldsFrom('admin');
        $loginData = [];

        foreach ($queryResult as $element) {
            $loginData[$element->name] = $element->value;
        }

        return $loginData; 
    }
}