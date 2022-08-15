<?php

$db = require('../database.php');
$db->query('DELETE FROM menu WHERE id = ' . $_POST['card-id']);

$_SESSION['alert_message'] = 'Блюдо успешно удалено';
$_SESSION['alert_message_type'] = 'success';

header('Location: ' . $_SERVER['HTTP_REFERER']);