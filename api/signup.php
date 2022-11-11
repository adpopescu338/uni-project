<?php
include 'conn.php';

// get name, phone, email, password
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];

$registered = $conn->query("INSERT INTO customers (name, phone, email, password) VALUES ('$name', '$phone', '$email', '$password')");

if ($registered) {
   echo "<h1>Registered successfully</h1><script>setTimeout(() => {window.location.href = '../index.html'}, 2000)</script>";
} else {
   echo "Error registering";
}