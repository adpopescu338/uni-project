<?php
include 'conn.php';

// get name, phone, email, password
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];

$registered = $conn->query("INSERT INTO customer (name, phone, email, password) VALUES ('$name', '$phone', '$email', '$password')");
if ($registered) {
   // "New record created successfully\n";
   // get customer id
   $customer_id = $conn->lastInsertId();
   // start session
   session_start();
   $_SESSION['id'] = $customer_id;
   $_SESSION['name'] = $name;
   $_SESSION['email'] = $email;
   // redirect to home page
   echo "<h1>Registered successfully</h1><script>setTimeout(() => {window.location.href = '../index.html'}, 2000)</script>";
} else {
   die("Connection failed: " . json_encode($conn->errorInfo()));
}
