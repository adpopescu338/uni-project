<?php
// reset password with old password
if (isset($_POST['reset_password'])) {
   // get email, old password, new password
   $email = $_POST['email'];
   $old_password = $_POST['old_password'];
   $new_password = $_POST['new_password'];
   // check if email and old password are correct
   $customer = $conn->query("SELECT * FROM customers WHERE email = '$email' AND password = '$old_password'");
   if ($customer->num_rows > 0) {
      // get customer id
      $customer_id = $customer->fetch_assoc()['id'];
      // update password
      $updated = $conn->query("UPDATE customers SET password = '$new_password' WHERE id = '$customer_id'");
      if ($updated) {
         echo "Password updated successfully";
      } else {
         echo "Error updating password";
      }
   } else {
      echo "Error resetting password";
   }
}
?>