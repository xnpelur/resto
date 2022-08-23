<?php

require_once '../autoload.php';

use App\Core\Application;
use App\Controllers\SiteController;

$app = new Application(dirname(__DIR__));

$app->router->get('/', [SiteController::class, 'index']);

$app->router->get('/admin', [SiteController::class, 'admin']);

$app->router->get('/partial', [SiteController::class, 'partial']);

$app->router->get('/options', [DataController::class, 'options']);

$app->run();