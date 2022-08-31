<?php

namespace App\Widgets;

use App\Core\Session;

class FlashMessage
{
    public static function show(string $name)
    {
        if ($message = Session::getFlashMessage("$name-success")) {
            $messageType = 'success';
        } else if ($message = Session::getFlashMessage("$name-danger")) {
            $messageType = 'danger';
        } else {
            return;
        }

        echo "<div class='alert alert-message alert-$messageType' role='alert'>
            $message
        </div>";
    }

    public static function showError(string $name)
    {
        if ($message = Session::getFlashMessage("$name-error")) {
            echo "<p class='error'>$message</p>";
        }
    }
}
