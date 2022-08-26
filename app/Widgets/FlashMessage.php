<?php

namespace App\Widgets;

use App\Core\Application;

class FlashMessage
{
    public static function show($name)
    {
        if ($message = Application::$app->session->getFlashMessage("$name-success")) {
            $messageType = 'success';
        } else if ($message = Application::$app->session->getFlashMessage("$name-danger")) {
            $messageType = 'danger';
        } else {
            return;
        }

        echo "<div class='alert alert-message alert-$messageType' role='alert'>
            $message
        </div>";
    }
}
