<?php
require 'conn.php';
// get all gifts 
$gifts = $conn->query("SELECT * FROM gifts");
// extracts all gifts
$gifts = $gifts->fetchAll(PDO::FETCH_ASSOC);
// send the gifts as json
echo json_encode($gifts);