<?php

use App\Core\Router;
use App\Controllers\SiteController;
use App\Controllers\DataController;

Router::get('/', [SiteController::class, 'index']);
Router::get('/admin', [SiteController::class, 'admin']);
Router::get('/login', [SiteController::class, 'login']);
Router::post('/partial', [SiteController::class, 'partial']);

Router::post('/get-meal', [DataController::class, 'getMeal']);
Router::post('/add-meal', [DataController::class, 'addMeal']);
Router::post('/change-meal', [DataController::class, 'changeMeal']);
Router::post('/delete-meal', [DataController::class, 'deleteMeal']);

Router::post('/add-review', [DataController::class, 'addReview']);
Router::post('/delete-review', [DataController::class, 'deleteReview']);

Router::post('/set-options', [DataController::class, 'setOptions']);
Router::post('/set-admin', [DataController::class, 'setAdmin']);

Router::post('/login', [DataController::class, 'login']);
Router::get('/logout', [DataController::class, 'logout']);

Router::post('/add-to-cart', [DataController::class, 'addToCart']);
Router::post('/get-cart', [SiteController::class, 'getCart']);
Router::post('/change-cart-count', [DataController::class, 'changeCartCount']);
Router::post('/delete-cart-meal', [DataController::class, 'deleteCartMeal']);
Router::post('/get-cart-total-amount', [DataController::class, 'getCartTotalAmount']);
Router::post('/get-cart-total-sum', [DataController::class, 'getCartTotalSum']);
Router::post('/add-order', [DataController::class, 'addOrder']);
Router::post('/delete-order', [DataController::class, 'deleteOrder']);
