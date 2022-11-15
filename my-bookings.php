<?php
include __DIR__ . "/api/conn.php";
session_start();
// get customer bookings
$customer_id = $_SESSION['id'];

// get customer bookings, join with gift table on booking.gift_id = gift.id
$bookings = $conn->query("SELECT booking.gift_id, booking.booking_date, booking.id  as booking_id, gift.name, gift.description, gift.cover_img FROM booking JOIN gift ON booking.gift_id = gift.id WHERE customer_id = $customer_id");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Experience day gift</title>
    <link rel="stylesheet" href="styles/main.css" />
    <link rel="stylesheet" href="styles/header.css" />
    <link rel="stylesheet" href="styles/footer.css" />
    <style>
        .bookings{
            display: flex;
            justify-content: space-between;
            flex-direction: column;
            align-items: center;
            gap:20px;
            margin-top: 50px;
        }

        .booking{
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid grey;
            border-radius: 8px;
            width: 80%;
            box-shadow: 0 0 80px blanchedalmond inset;
            overflow: hidden;
        }
        .booking img{
            width: 300px;
            box-shadow: 0 0 5px black;
            border-radius: 8px;
        }

        h1{
            text-align: center;
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
if (isset($_SESSION['id'])) {
    echo "<li id='menu-icon'>
            <span> ⚙ </span>
            <div id='menu'>
              <a href='my-bookings.php'>Bookings</a>
              <a href='api/signout.php'>Logout</a>
            </div>
          </li>";
}
?>
      </ul>
    </nav>
    <h1>My bookings</h1>
    <div class="bookings">
    <?php
if ($bookings->rowCount() === 0) {
    echo "<h3>You have no bookings</h3>";

} else {
    $bookings = $bookings->fetchAll(PDO::FETCH_ASSOC);
    foreach ($bookings as $booking) {
        echo "<div class='booking'>
        <h3>{$booking['name']}</h3>
        <img src='{$booking['cover_img']}' alt='{$booking['name']}' />
        <p>{$booking['description']}</p>
        <p>{$booking['booking_date']}</p>
        </div>
        ";
    }
}
?>
</div>

<footer>
      <p>© 2022 Experiences.com</p>
      </footer>
  </body>
</html>
