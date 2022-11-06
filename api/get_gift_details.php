<?php
// get gift id
$gift_id = $_GET['gift_id'];

// get gift details
$gift = $conn->query("SELECT * FROM gifts WHERE id = '$gift_id'");
// get gift details as associative array
$gift = $gift->fetch(PDO::FETCH_ASSOC);

// return gift details as json
echo json_encode($gift);
