<?php
include 'conn.php';

// get name, phone, email, password
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];

$registered = $conn->query("INSERT INTO customers (name, phone, email, password) VALUES ('$name', '$phone', '$email', '$password')");

if ($registered) {
   echo "Registered successfully";
} else {
   echo "Error registering";
}