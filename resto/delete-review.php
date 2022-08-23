<?php

session_start();

$db = require('../database.php');
$image = $db->query('SELECT * FROM reviews WHERE id = ' . $_POST['review-id'])->fetch_assoc()['image'];
$db->query('DELETE FROM reviews WHERE id = ' . $_POST['review-id']);

$imageUsagesCount = mysqli_num_rows($db->query("SELECT * FROM reviews WHERE image = '" . $image . "'"));

if ($imageUsagesCount === 0) {
    unlink('../' . $image);
}

$_SESSION['alert_message'] = 'Отзыв успешно удалён';
$_SESSION['alert_message_type'] = 'success';

header('Location: ' . $_SERVER['HTTP_REFERER']);