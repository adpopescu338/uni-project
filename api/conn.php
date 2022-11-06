<?php
require 'init_db.php';
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "experiences";

// Create connection
$conn;

// try to connect to database; if database doesn't exist, create it
try {
   $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
   // set the PDO error mode to exception
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   echo "Connected successfully";
} catch (PDOException $e) {
   echo "Database does not exist. Creating and populating it\n";
   $conn = create_db_if_not_existent($db_name, $servername, $username, $password);
}

// check if connection error exists
if ($conn->errorInfo()[0] != 0) {
   die("Connection failed: " . json_encode($conn->errorInfo()));
}else{
   echo "Connected successfully\n";
}


