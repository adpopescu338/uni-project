<?php
include 'conn.php';
// get customer id
session_start();
$customer_id = $_SESSION['id'];
// get gift id
$gift_id = $_GET['gift_id'];
// get booking date
$booking_date = $_GET['date'];

// get all bookings for the gift on the booking date
$bookings = $conn->query("SELECT * FROM booking WHERE gift_id = '$gift_id' AND booking_date = '$booking_date'");

// get the gift
$gift = $conn->query("SELECT * FROM gift WHERE id = '$gift_id'");

// get the gift max_services_bookings based on gift id and booking date
$max_bookings = $conn->query("SELECT max_bookings FROM max_services_bookings WHERE gift_id = '$gift_id' AND booking_date = '$booking_date'");
$max_bookings = $max_bookings->fetch(PDO::FETCH_ASSOC);
// check availability
if ($bookings->rowCount() < $max_bookings) {
   // book
   $booked = $conn->query("INSERT INTO booking (customer_id, gift_id, booking_date) VALUES ('$customer_id', '$gift_id', '$booking_date')");
   if ($booked) {
      echo "<h3>Booking successful</h3><script>setTimeout(() => {window.location.href = '../index.html'}, 3000)</script>";
   } else {
      echo "<h3>Failed to book</h3><script>setTimeout(() => history.back() 3000)</script>";
   }
} else {
   echo "<h3>Unavailable</h3><script>setTimeout(() => history.back() 3000)</script>";
}