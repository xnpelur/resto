<?php

$db = require('../database.php');
$card = $db->query('SELECT title, description, price FROM menu WHERE id = ' . $_GET['id'])->fetch_assoc();

echo json_encode($card);