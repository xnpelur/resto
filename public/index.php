<?php

require_once '../autoload.php';
require_once '../app/config/routes.php';

use App\Core\Application;

$app = new Application(dirname(__DIR__));

$app->run();