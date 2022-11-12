<?php
require 'init_db.php';

$creds = array();
// read file and get database credentials
$file_dir = __DIR__ . "/env";

$creds_file = fopen($file_dir, "r") or die("Unable to open file!");
while (!feof($creds_file)) {
    $line = fgets($creds_file);
    $line = explode("=", $line);
    // replace new line character
    $line[1] = str_replace("
", "", $line[1]);
    $creds[$line[0]] = $line[1];
}
fclose($creds_file);

$servername = $creds['db_host'];
$username = $creds['db_username'];
$password = $creds['db_password'];
$db_name = $creds['db_name'];

// Create connection
$conn;

// try to connect to database; if database doesn't exist, create it
try {
    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    //"Database does not exist. Creating and populating it\n";
    $conn = create_db_if_not_existent($db_name, $servername, $username, $password);
}

// check if connection error exists
if ($conn->errorInfo()[0] != 0) {
    die("Connection failed: " . json_encode($conn->errorInfo()));
}
