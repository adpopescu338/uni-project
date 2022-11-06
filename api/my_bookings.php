<?php
// get customer bookings
$customer_id = $_SESSION['customer_id'];
$bookings = $conn->query("SELECT * FROM bookings WHERE customer_id = '$customer_id'");

// send bookings as json
echo json_encode($bookings);
?>