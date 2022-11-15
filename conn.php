<?php

$servername = '127.0.0.1';
$username = 'root';
$password = '';
$db_name = 'experiences';

$conn;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection to database failed");
}