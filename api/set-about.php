<?php

$db = require('../database.php');

$sql = $db->prepare('UPDATE options 
    SET value = CASE
        WHEN name = "about_title" THEN ?
        WHEN name = "about_text" THEN ?
        ELSE `value`
    END');

$sql->bind_param('ss', $about_title, $about_text);

$about_title = $_POST['about-title'];
$about_text = $_POST['about-text'];

$sql->execute();

header('Location: ' . $_SERVER['HTTP_REFERER']);