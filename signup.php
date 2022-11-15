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
   $_SESSION['user_id'] = $customer_id;
   $_SESSION['user_name'] = $name;
   $_SESSION['email_address'] = $email;
   // redirect to home page
   header('Location: index.php');
} else {
   die("Connection failed" );
}
