<?php
include 'conn.php';

// get giftId from request
$experience_id = $_GET['id'];

// find gift by giftId
$sql = "SELECT * FROM gift WHERE id = $experience_id";
$result = $conn->query($sql);
$gift = $result->fetch(PDO::FETCH_ASSOC);

// get all bookings from database for this gift where date > today
$sql = "SELECT * FROM booking WHERE gift_id = $experience_id AND booking_date > CURDATE()";
$result = $conn->query($sql);
$bookings = $result->fetchAll(PDO::FETCH_ASSOC);

// find gift max bookings
$sql = "SELECT * FROM max_services_bookings WHERE gift_id = $experience_id AND booking_date > CURDATE()";
$result = $conn->query($sql);
// pdo fetch all
$max_bookings = $result->fetchAll(PDO::FETCH_ASSOC);

$availability = array();

// loop through all bookings and check if there is a booking for each date
foreach ($max_bookings as $max) {
    $date = $max['booking_date'];

    // check if there is a booking for this date using count
    $sql = "SELECT COUNT(*) FROM booking WHERE gift_id = $experience_id AND booking_date = $date";
    $result = $conn->query($sql);
    $count = $result->fetch(PDO::FETCH_ASSOC);

    $available = $count['COUNT(*)'] < $max['max_bookings'];
    $gift['availability'][$date] = $available;
}
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
      #container {
        min-height: 90vh;
        text-align: center;
        margin-top: 40px;
      }

      #gift-info {
        margin: 0 auto;
        width: 80%;
        text-align: center;
      }

      .loader {
        margin-top: 150px;
      }

      select {
        width: 100%;
        height: 50px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 0 10px;
        font-size: 1.2rem;
      }

      form button {
        width: 100%;
        height: 50px;
        border: none;
        border-radius: 5px;
        background-color: #4caf50;
        color: white;
        font-size: 1.2rem;
        cursor: pointer;
        transition: background-color 0.5s ease;
      }
      form button :hover {
        background-color: #45a049;
      }

      #gift-info img {
        width: 90%;
        max-width: 700px;
        border-radius: 9px;
        box-shadow: 0 0 7px black;
      }

      form {
        padding: 20px 30px;
        margin-top: 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 20px;
      }

      .reviews {
        margin-top: 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 20px;
      }

      .review {
        width: 80%;
        max-width: 700px;
        padding: 20px;
        border-radius: 9px;
        box-shadow: 0 0 7px black;
      }

      .avatar {
        vertical-align: middle;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 10px;
      }

      .gift-price {
        background-color: pink;
        border-radius: 8px;
        font-size: 19px;
        padding: 3px 8px;
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
    <div id="content">

      <div id="gift-info">
      <div>

<?php
echo "<h2>{$gift['name']}</h2>
<img src='{$gift['cover_img']}' alt='{$gift['name']}' />
<p>{$gift['description']}</p>"
?>
</div>
        <form action="<?php echo isset($_SESSION['user_id']) ? 'book.php' : 'login.php' ?>"">
          <input name="id" value=<?php echo $gift['id']; ?> type="hidden" />
          <select name="day">
            <?php
foreach ($gift['availability'] as $date => $available) {
    if ($available) {
        echo "<option value='$date'>$date</option>";
    }
}
?>
          </select>
          <button type="submit"><?php echo isset($_SESSION['user_id']) ? 'Book for £'.$gift['price'] : 'Sign in to book' ?></button>
        </form>
      </div>
    </div>

    <footer>
      <p>© 2022 Experiences.com</p>
      </footer>
  </body>
</html>
