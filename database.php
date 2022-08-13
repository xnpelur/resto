<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'resto';

$connection = new mysqli($hostname, $username, $password, $database);

return $connection;