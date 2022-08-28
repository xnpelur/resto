<?php

namespace App\Core;

use App\Models\Admin;

class Session 
{
    public static function start()
    {
        session_start();

        $flashMessages = $_SESSION['flash_messages'] ?? [];
        foreach ($flashMessages as $key => &$message) {
            $message['remove'] = true;
        }
        $_SESSION['flash_messages'] = $flashMessages;
    }

    public static function setFlashMessage($key, $message)
    {
        $_SESSION['flash_messages'][$key] = [
            'remove' => false,
            'message' => $message
        ];
    }

    public static function getFlashMessage($key)
    {
        return $_SESSION['flash_messages'][$key]['message'] ?? false;
    }

    public static function setLoginData(array $data)
    {
        $_SESSION['login'] = $data['login'];
        $_SESSION['password'] = $data['password'] ?? $_SESSION['password'];
    }

    public static function tryLogin()
    {
        if (!isset($_SESSION['login']) || !isset($_SESSION['password'])) {
            return false;
        }

        $data = [
            'login' => $_SESSION['login'],
            'password' => $_SESSION['password']
        ];

        $admin = new Admin();
        return $admin->verifyLoginData($data);
    }

    public static function logout()
    {
        unset($_SESSION['login']);
        unset($_SESSION['password']);
    }

    public static function end()
    {
        $flashMessages = $_SESSION['flash_messages'] ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
            if ($flashMessage['remove']) {
                unset($flashMessages[$key]);
            }
        }
        $_SESSION['flash_messages'] = $flashMessages;
    }
}