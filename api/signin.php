<?php
include 'conn.php';
// sign in
if (isset($_POST['signin'])) {
   // get email and password
   $email = $_POST['email'];
   $password = $_POST['password'];
   // check if email and password are correct
   $customer = $conn->query("SELECT * FROM customers WHERE email = '$email' AND password = '$password'");
   if ($customer->num_rows > 0) {
      // get customer id
      $customer_id = $customer->fetch_assoc()['id'];
      // set session
      $_SESSION['customer_id'] = $customer_id;
      // redirect to home page
      header('Location: index.php');
   } else {
      echo "Error signing in";
   }
}