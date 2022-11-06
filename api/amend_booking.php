<?php
// amend booking
// get booking id
$booking_id = $_POST['booking_id'];
// get booking date
$booking_date = $_POST['booking_date'];
// get gift id
$gift_id = $_POST['gift_id'];
// get customer id
$customer_id = $_SESSION['customer_id'];
// get all bookings for the gift on the booking date
$bookings = $conn->query("SELECT * FROM bookings WHERE gift_id = '$gift_id' AND booking_date = '$booking_date'");
// get the gift
$gift = $conn->query("SELECT * FROM gifts WHERE id = '$gift_id'")->fetch_assoc();
// get the gift max bookings
$max_bookings = $gift['max_bookings'];
// check availability
if ($bookings->num_rows < $max_bookings) {
   // amend booking
   $amended = $conn->query("UPDATE bookings SET booking_date = '$booking_date' WHERE id = '$booking_id' AND customer_id = '$customer_id'");
   if ($amended) {
      echo "Amended successfully";
   } else {
      echo "Error amending";
   }
} else {
   echo "Not available";
}