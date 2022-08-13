<?php

$db = require('database.php');
$db->query('DELETE FROM menu WHERE id = ' . $_POST['id']);