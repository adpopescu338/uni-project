<?php
include "conn.php";
session_start();
$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];

$user_id = $_SESSION['user_id'];

// check if email and old password are correct
$customer = $conn->query("SELECT * FROM customer WHERE id = '$user_id' AND password = '$old_password'");
if ($customer->rowCount() > 0) {
    // update password
    $success = $conn->query("UPDATE customer SET password = '$new_password' WHERE id = '$user_id'");
    if ($success) {
        echo "<h3>Password updated</h3>";
    } else {
        echo "<h3>An error occurred</h3>";
    }
} else {
    echo "<h3>Invalid credentials</h3>";
}
