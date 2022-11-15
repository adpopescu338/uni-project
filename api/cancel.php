<?php
include "conn.php";
// GET booking id
$booking_id = $_GET['id'];
session_start();
$customer_id = $_SESSION['id'];
// delete booking
$query = "DELETE FROM booking WHERE id = $booking_id AND customer_id = $customer_id";
$conn->query($query);


// check if booking was deleted
if ($conn->errorInfo()[0] != 0) {
    die("Connection failed: " . json_encode($conn->errorInfo()));
}

echo "<h3>Booking cancelled</h3><script>setTimeout(() => {window.location.href = '../my-bookings.php'}, 2000)</script>";
?>