<?php
include 'conn.php';
// get customer id
$customer_id = $_SESSION['customer_id'];
// get gift id
$gift_id = $_POST['gift_id'];
// get booking date
$booking_date = $_POST['booking_date'];

// get all bookings for the gift on the booking date
$bookings = $conn->query("SELECT * FROM bookings WHERE gift_id = '$gift_id' AND booking_date = '$booking_date'");

// get the gift
$gift = $conn->query("SELECT * FROM gifts WHERE id = '$gift_id'")->fetch_assoc();
// get the gift max bookings
$max_bookings = $gift['max_bookings'];
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