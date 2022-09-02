<?php

namespace App\Models;

use App\Core\Session;
use App\Core\Model;

class Admin extends Model
{
    public function verifyLoginData(array $data)
    {
        $correctLoginData = $this->getAdminData();
        $isAuthorized = $data['login'] == $correctLoginData->login 
            && password_verify($data['password'], $correctLoginData->password);

        if ($isAuthorized) {
            Session::setLoginData($data);
            return true;
        }
        return false;
    }

    public function getAdminData()
    {
        $queryResult = $this->getFieldsFrom('admin');
        $dataArray = [];

        foreach ($queryResult as $element) {
            $dataArray[$element->name] = $element->value;
        }

        $data = (object)$dataArray;

        return $data;
    }

    public function setAdminData(array $data)
    {
        if ($data['admin-password'] !== $data['admin-password-confirm']) {
            Session::setFlashMessage('admin-danger', 'Пароли не совпадают');
            return;
        }

        if ($data['admin-login'] === '') {
            Session::setFlashMessage('admin-danger', 'Логин не может быть пустым');
            return;
        }
        
        $args = [
            'login' => $data['admin-login']
        ];
        
        if ($data['admin-password'] !== '') {
            $args['password'] = password_hash($data['admin-password'], PASSWORD_DEFAULT);
        }
        
        $this->updateValues('admin', $args);
        Session::setLoginData([
            'login' => $data['admin-login'],
            'password' => $data['admin-password'] !== '' ? $data['admin-password'] : NULL
        ]);

        Session::setFlashMessage('admin-success', 'Данные для входа успешно обновлены');
    }
}
