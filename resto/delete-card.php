<?php

session_start();

$db = require('../database.php');
$image = $db->query('SELECT * FROM menu WHERE id = ' . $_POST['card-id'])->fetch_assoc()['image'];
$db->query('DELETE FROM menu WHERE id = ' . $_POST['card-id']);

$imageUsagesCount = mysqli_num_rows($db->query("SELECT * FROM menu WHERE image = '" . $image . "'"));

if ($imageUsagesCount === 0) {
    unlink('../' . $image);
}

$_SESSION['alert_message'] = 'Блюдо успешно удалено';
$_SESSION['alert_message_type'] = 'success';

header('Location: ' . $_SERVER['HTTP_REFERER']);