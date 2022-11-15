<?php
include __DIR__ . "conn.php";
session_start();
// get customer bookings
$customer_id = $_SESSION['user_id'];

// get customer bookings, join with gift table on booking.gift_id = gift.id
$bookings = $conn->query("SELECT booking.gift_id, booking.booking_date, booking.id  as booking_id, gift.name, gift.description, gift.cover_img, gift.price FROM booking JOIN gift ON booking.gift_id = gift.id WHERE customer_id = $customer_id");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Experience day gift</title>
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/header.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <style>
    table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
  </head>
  <body>
  <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
        <?php
session_start();
if (isset($_SESSION['user_id'])) {
    echo "<li>
            <a href='my-bookings.php'>Bookings</a>
          </li>
          <li style='tranform: '>
            <a style='display:flex;' href='signout.php'><img src='logout.svg' style='width:25px;' /></a>
          </li>";
}
?>
      </ul>
    </nav>
    <h1 style="text-align: center;">My bookings</h1>

    <?php
if ($bookings->rowCount() === 0) {
    echo "<h3>You have no bookings</h3>";

} else {
    $bookings = $bookings->fetchAll(PDO::FETCH_ASSOC);
    echo "<table>
    
    <tr>
        <th>Gift</th>
        <th>Booking date</th>
        <th>Description</th>
        <th>Price</th>
    </tr>";
        
    foreach ($bookings as $booking) {
        echo "<tr>
        <td>{$booking['name']}</td>
        <td>{$booking['booking_date']}</td>
        <td>{$booking['description']}</td>
        <td>£{$booking['price']}</td>
        </tr>
        ";
    }
    echo "</table>";
}
?>

<footer>
      <p>© 2022 Experiences.com</p>
      </footer>
  </body>
</html>
