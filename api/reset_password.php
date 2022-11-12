<?php
include "conn.php";
session_start();
// reset password with old password

if (isset($_POST['old_password']) && isset($_POST['new_password'])) {
    // get email, old password, new password
    $id = $_SESSION['id'];

    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    // check if email and old password are correct
    $customer = $conn->query("SELECT * FROM customer WHERE id = '$id' AND password = '$old_password'");
    if ($customer->rowCount() > 0) {
        // get customer id
        $customer_id = $customer->fetch()['id'];
        // update password
        $updated = $conn->query("UPDATE customer SET password = '$new_password' WHERE id = '$customer_id'");
        if ($updated) {
            echo "<h3>Password updated successfully</h3><script>setTimeout(()=>window.location.href='../index.html', 3000)</script>";
        } else {
            echo "<h3>Error updating password</h3><script>setTimeout(history.back, 3000)</script>";
        }
    } else {
        echo "<h3>Error updating password</h3><script>setTimeout(history.back, 3000)</script>";
    }
}
