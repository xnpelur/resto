<?php

require_once('../utils.php');
$db = require('../database.php');

if ($path = upload_image($_FILES['card-image'])) {
    $sql = $db->prepare('UPDATE menu SET title = ?, description = ?, price = ?, image = ? WHERE id = ' . $_POST['card-id']);
    $sql->bind_param('ssss', $title, $description, $price, $image);

    $title = $_POST['card-title'];
    $description = $_POST['card-description'];
    $price = $_POST['card-price'];
    $image = $path;

    $sql->execute();
} else {
    $sql = $db->prepare('UPDATE menu SET title = ?, description = ?, price = ? WHERE id = ' . $_POST['card-id']);
    $sql->bind_param('sss', $title, $description, $price);

    $title = $_POST['card-title'];
    $description = $_POST['card-description'];
    $price = $_POST['card-price'];

    $sql->execute();
}

$_SESSION['alert_message'] = 'Блюдо успешно изменено';
$_SESSION['alert_message_type'] = 'success';

header('Location: ' . $_SERVER['HTTP_REFERER']);