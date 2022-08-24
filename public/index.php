<?php

require_once '../autoload.php';

use App\Core\Application;
use App\Controllers\SiteController;
use App\Controllers\DataController;

$app = new Application(dirname(__DIR__));

$app->router->get('/', [SiteController::class, 'index']);
$app->router->get('/admin', [SiteController::class, 'admin']);
$app->router->get('/partial', [SiteController::class, 'partial']);

$app->router->get('/get-meal', [DataController::class, 'getMeal']);
$app->router->post('/add-meal', [DataController::class, 'addMeal']);
$app->router->post('/change-meal', [DataController::class, 'changeMeal']);
$app->router->post('/delete-meal', [DataController::class, 'deleteMeal']);
$app->router->post('/add-review', [DataController::class, 'addReview']);
$app->router->post('/delete-review', [DataController::class, 'deleteReview']);
$app->router->post('/set-options', [DataController::class, 'setOptions']);

$app->run();