<?php
include 'conn.php';
// get all gift rows
$gifts = $conn->query("SELECT * FROM gifts");

// get each gift availability
foreach ($gifts as $gift) {
   // get gift id
   $gift_id = $gift['id'];
   // get gift max bookings
   $max_bookings = $gift['max_bookings'];
   // get gift bookings
   $bookings = $conn->query("SELECT * FROM bookings WHERE gift_id = '$gift_id'");
   // get gift availability
   $availability = $max_bookings - $bookings->num_rows;
   // set gift object availability
   $gift['availability'] = $availability;
}


// send the gifts as json
echo json_encode($gifts);