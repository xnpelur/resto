<?php

require_once('../utils.php');
$db = require('../database.php');

// session_start();

var_dump($_FILES);

if ($path = upload_image($_FILES['card-image'])) {
    $sql = $db->prepare('INSERT INTO menu (title, description, price, image) VALUES (?, ?, ?, ?)');
    $sql->bind_param('ssss', $title, $description, $price, $image);

    $title = $_POST['card-title'];
    $description = $_POST['card-description'];
    $price = $_POST['card-price'];
    $image = $path;

    $sql->execute();

    // $_SESSION['upload_message'] = 'Блюдо успешно добавлено в меню';
    // $_SESSION['upload_message_type'] = 'success';
}   
else {
    // $_SESSION['upload_message'] = 'Во время загрузки изображения возникла ошибка, попробуйте позже';
    // $_SESSION['upload_message_type'] = 'danger';
}

header('Location: ' . $_SERVER['HTTP_REFERER']);