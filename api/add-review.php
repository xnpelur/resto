<?php

require_once('../utils.php');
$db = require('../database.php');

session_start();

if ($path = upload_image($_FILES['review-image'])) {
    $sql = $db->prepare('INSERT INTO reviews (name, text, stars, image) VALUES (?, ?, ?, ?)');
    $sql->bind_param('ssss', $name, $text, $stars, $image);

    $name = $_POST['review-name'];
    $text = $_POST['review-text'];
    $stars = $_POST['review-stars'];
    $image = $path;

    $sql->execute();

    $_SESSION['alert_message_index'] = 'Отзыв успешно сохранен';
    $_SESSION['alert_message_type_index'] = 'success';
} else {
    $_SESSION['alert_message_index'] = 'Во время загрузки изображения возникла ошибка, попробуйте ещё раз';
    $_SESSION['alert_message_type_index'] = 'danger';
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
