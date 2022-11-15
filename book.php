<?php
include 'conn.php';

session_start();
$user_id = $_SESSION['user_id'];

$experience_id = $_GET['id'];

$booking_date = $_GET['day'];

// get all bookings for the gift on the booking date
$bookings = $conn->query("SELECT * FROM booking WHERE gift_id = '$experience_id' AND booking_date = '$booking_date'");

// get the gift
$gift = $conn->query("SELECT * FROM gift WHERE id = '$experience_id'");

// get the gift max_services_bookings based on gift id and booking date
$max_bookings = $conn->query("SELECT max_bookings FROM max_services_bookings WHERE gift_id = '$experience_id' AND booking_date = '$booking_date'");
$max_bookings = $max_bookings->fetch(PDO::FETCH_ASSOC);
// check availability
if ($bookings->rowCount() < $max_bookings) {
   // book
   $booked = $conn->query("INSERT INTO booking (customer_id, gift_id, booking_date) VALUES ('$user_id', '$experience_id', '$booking_date')");
   if ($booked) {
      header("Location: ../my-bookings.php");

   } else {
      echo "<h3>An error occurred</h3>";
   }
} else {
   echo "<h3>All Booked</h3>";
}