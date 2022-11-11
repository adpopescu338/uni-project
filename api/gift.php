<?php
include 'conn.php';

// get giftId from request
$gift_id = $_GET['gift'];

// find gift by giftId
$sql = "SELECT * FROM gift WHERE id = $gift_id";
$result = $conn->query($sql);
$gift = $result->fetch(PDO::FETCH_ASSOC);

// get all bookings from database for this gift where date > today
$sql = "SELECT * FROM booking WHERE gift_id = $gift_id AND booking_date > CURDATE()";
$result = $conn->query($sql);
$bookings = $result->fetchAll(PDO::FETCH_ASSOC);

// find gift max bookings
$sql = "SELECT * FROM max_services_bookings WHERE gift_id = $gift_id AND booking_date > CURDATE()";
$result = $conn->query($sql);
// pdo fetch all
$max_bookings = $result->fetchAll(PDO::FETCH_ASSOC);

$availability= array();

// loop through all bookings and check if there is a booking for each date
foreach ($max_bookings as  $max ) {
    $date = $max['booking_date'];

    // check if there is a booking for this date using count
    $sql = "SELECT COUNT(*) FROM booking WHERE gift_id = $gift_id AND booking_date = $date";
    $result = $conn->query($sql);
    $count = $result->fetch(PDO::FETCH_ASSOC);
    
    $available = $count['COUNT(*)'] < $max['max_bookings'];
    $gift['availability'][$date] = $available;
}

echo json_encode($gift);