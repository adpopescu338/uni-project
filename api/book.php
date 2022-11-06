<?php
include 'conn.php';
// get customer id
$customer_id = $_SESSION['customer_id'];
// get gift id
$gift_id = $_POST['gift_id'];
// get booking date
$booking_date = $_POST['date'];

// get all bookings for the gift on the booking date
$bookings = $conn->query("SELECT * FROM bookings WHERE gift_id = '$gift_id' AND booking_date = '$booking_date'");

// get the gift
$gift = $conn->query("SELECT * FROM gifts WHERE id = '$gift_id'");

// get the gift max_services_bookings based on gift id and booking date
$max_bookings = $conn->query("SELECT max_bookings FROM max_services_bookings WHERE gift_id = '$gift_id' AND booking_date = '$booking_date'");

// check availability
if ($bookings->num_rows < $max_bookings) {
   // book
   $booked = $conn->query("INSERT INTO bookings (customer_id, gift_id, booking_date) VALUES ('$customer_id', '$gift_id', '$booking_date')");
   if ($booked) {
      echo "Booked successfully";
   } else {
      echo "Error booking";
   }
} else {
   echo "Not available";
}