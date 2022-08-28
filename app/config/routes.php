<?php

use App\Core\Router;
use App\Controllers\SiteController;
use App\Controllers\DataController;

Router::get('/', [SiteController::class, 'index']);
Router::get('/admin', [SiteController::class, 'admin']);
Router::get('/login', [SiteController::class, 'login']);
Router::get('/partial', [SiteController::class, 'partial']);

Router::get('/get-meal', [DataController::class, 'getMeal']);
Router::post('/add-meal', [DataController::class, 'addMeal']);
Router::post('/change-meal', [DataController::class, 'changeMeal']);
Router::post('/delete-meal', [DataController::class, 'deleteMeal']);
Router::post('/add-review', [DataController::class, 'addReview']);
Router::post('/delete-review', [DataController::class, 'deleteReview']);
Router::post('/set-options', [DataController::class, 'setOptions']);
Router::post('/login', [DataController::class, 'login']);
Router::get('/logout', [DataController::class, 'logout']);
Router::post('/set-admin', [DataController::class, 'setAdmin']);
