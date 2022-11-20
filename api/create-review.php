<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo "<h3>Not logged in</h3><script>setTimeout(() => history.back(), 3000)</script>";
    exit();
}

include 'conn.php';
// get gift_id and text from POST
$gift_id = $_POST['gift_id'];
$text = $_POST['text'];

// get files from POST
$files = $_FILES['images'];

// save files in ../images folder
$images = [];
foreach ($files['name'] as $key => $value) {
    // ignore non-image files
    if (strpos($files['type'][$key], 'image') === false) {
        continue;
    }
    $image = $files['name'][$key];
    $tmp_name = $files['tmp_name'][$key];
    $image = time() . $image;
    move_uploaded_file($tmp_name, "../images/$image");
    $images[] = $image;
}

// get customer id
$customer_id = $_SESSION['id'];

// insert review
$encoded_images = json_encode($images);
$sql = "INSERT INTO review (customer_id, gift_id, text, images) VALUES ('$customer_id', '$gift_id', '$text', '$encoded_images')";
echo $sql;

try{
    $conn->exec($sql);
    echo "<h3>Review created</h3><script>setTimeout(() => window.location.href = '../gift.html?gift=$gift_id', 3000)</script>";
} catch(PDOException $e) {
    echo "<h3>Failed to create review</h3><script>setTimeout(() => history.back(), 3000)</script>";
}

