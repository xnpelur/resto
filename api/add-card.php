<?php

require_once('../utils.php');
$db = require('../database.php');

session_start();

if ($path = upload_image($_FILES['card-image'])) {
    $sql = $db->prepare('INSERT INTO menu (title, description, price, image, type) VALUES (?, ?, ?, ?, ?)');
    $sql->bind_param('sssss', $title, $description, $price, $image, $type);

    $title = $_POST['card-title'];
    $description = $_POST['card-description'];
    $price = $_POST['card-price'];
    $image = $path;
    $type = $_POST['card-type'];

    $sql->execute();

    $_SESSION['alert_message'] = 'Блюдо успешно добавлено в меню';
    $_SESSION['alert_message_type'] = 'success';
}   
else {
    $_SESSION['alert_message'] = 'Во время загрузки изображения возникла ошибка, попробуйте ещё раз';
    $_SESSION['alert_message_type'] = 'danger';
}

header('Location: ' . $_SERVER['HTTP_REFERER']);