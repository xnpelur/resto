<?php

$db = require('database.php');
$result = $db->query('SELECT name, value FROM options')->fetch_all(MYSQLI_NUM);

$options = array_combine(
    array_map(function($v){ return $v[0]; }, $result),
    array_map(function($v){ return $v[1]; }, $result)
);

return $options;