<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database_name = 'eventx';

$database = new mysqli($host, $username, $password, $database_name);

if ($database->connect_error) {
    die('bad connection');
} 


