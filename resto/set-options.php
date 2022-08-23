<?php

$db = require('../database.php');

$sql = $db->prepare('UPDATE options 
    SET value = CASE
        WHEN name = "site_name" THEN ?
        WHEN name = "phone" THEN ?
        WHEN name = "email" THEN ?
        WHEN name = "facebook_link" THEN ?
        WHEN name = "instagram_link" THEN ?
        WHEN name = "vk_link" THEN ? 
        ELSE `value`
    END');

$sql->bind_param('ssssss', $site_name, $phone, $email, $facebook_link, $instagram_link, $vk_link);

$site_name = $_POST['options-name'];
$phone = $_POST['options-phone'];
$email = $_POST['options-email'];
$facebook_link = $_POST['options-facebook'];
$instagram_link = $_POST['options-instagram'];
$vk_link = $_POST['options-vk'];

$sql->execute();

header('Location: ' . $_SERVER['HTTP_REFERER']);