<?php

namespace App\Core;

class Session 
{
    public function __construct()
    {
        session_start();

        $flashMessages = $_SESSION['flash_messages'] ?? [];
        foreach ($flashMessages as $key => &$message) {
            $message['remove'] = true;
        }
        $_SESSION['flash_messages'] = $flashMessages;
    }

    public function setFlashMessage($key, $message)
    {
        $_SESSION['flash_messages'][$key] = [
            'remove' => false,
            'message' => $message
        ];
    }

    public function getFlashMessage($key)
    {
        return $_SESSION['flash_messages'][$key]['message'] ?? false;
    }

    public function __destruct()
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