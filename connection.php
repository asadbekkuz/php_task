<?php

$host                = 'localhost';  // 172.17.0.1
$port                = '3306';        // 3310
$user                = 'root';
$password_connection = '';
$db                  = 'task';
$dsn                 = "mysql:host=$host;port=$port;dbname=$db";

try {
    $pdo = new PDO($dsn, $user, $password_connection);
} catch (PDOException $e) {
    echo $e->getMessage();
}