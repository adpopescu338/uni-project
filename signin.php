<?php
include 'conn.php';

// get email and password
$email = $_POST['email'];
$password = $_POST['password'];
// check if email and password are correct
$user= $conn->query("SELECT * FROM customer WHERE email = '$email' AND password = '$password'");
if ($user->rowCount() > 0) {
   $user = $user->fetch(PDO::FETCH_ASSOC);

    session_start();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['email_address'] = $email;
    header('Location: ../index.php');
} else {
    echo "<h3>Invalid credentials</h3>";
}
