<?php
include 'conn.php';

function signin ($email, $password){
   global $conn;
   $customer = $conn->query("SELECT * FROM customer WHERE email = '$email' AND password = '$password'");
   if ($customer->rowCount() > 0) {
      // get customer id
      $customer = $customer->fetch(PDO::FETCH_ASSOC);
      $id = $customer['id'];
      session_start();
      $_SESSION['id'] = $id;
      $_SESSION['name'] = $customer['name'];
      $_SESSION['email'] = $email;
      // redirect to home page
      header('Location: ../index.html');
   } else {
      echo "<h3>Invalid email or password</h3><script>setTimeout(() => {window.location.href = '../login.html'}, 3000)</script>";
   }
}


if (isset($_POST['email']) && isset($_POST['password'])) {
   // get email and password
   $email = $_POST['email'];
   $password = $_POST['password'];
   // check if email and password are correct
   signin($email, $password);
} else{
   echo "<h3>Invalid email or password</h3><script>setTimeout(() => {window.location.href = '../login.html'}, 3000)</script>";
}

