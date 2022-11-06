<?php
include 'conn.php';
// get date
$date = $_GET['date'];
// get all gift rows
$gifts = $conn->query("SELECT * FROM gifts");

// get all max services bookings rows based on date
$max_services_bookings = $conn->query("SELECT * FROM max_services_bookings WHERE date = '$date'");


// get each gift availability
foreach ($gifts as $gift) {
   // get gift id
   $gift_id = $gift['id'];
   // get gift max bookings from $max_services_bookings based on gift id and date USING PDO
   $gift_max_bookings = $max_services_bookings->fetch(PDO::FETCH_ASSOC);
   // extract max bookings from $gift_max_bookings
   $max_bookings = $gift_max_bookings['max_bookings'];
   // get gift bookings
   $bookings = $conn->query("SELECT * FROM bookings WHERE gift_id = '$gift_id'");
   // get gift availability
   $availability = $max_bookings - $bookings->num_rows;
   // set gift object availability
   $gift['availability'] = $availability;
}


// send the gifts as json
echo json_encode($gifts);