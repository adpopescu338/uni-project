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
      #banner {
        background: #fff;
        text-align: center;
        font-weight: 700;
        letter-spacing: 0;
        text-align: center;
        color: #1c0950;
        background-image: url(gift-icon.png);
        background-position: center center;
        background-repeat: no-repeat;
        padding: 75px 0 10px 0;
        background-size: 206px;
      }
      #banner h1 {
        font-size: 40px;
        color: rgb(189, 154, 102);
      }

.box {
  box-shadow: 0 0 5px black;
  height: auto;
  border-radius: 8px;
  background-color: blanchedalmond;
  width: 90%;
  margin: 0 auto;
  text-align: center;
  padding-bottom: 40px;
  position: relative;
}

.box img {
  width: 90%;
  border-radius: 10px;
}

.buttonParent button {
  background-color: #1c0950;
  color: white;
  border: none;
  border-radius: 8px;
  padding: 8px;
  font-size: 18px;
  cursor: pointer;
  transition: all 0.3s;
}
.box button:hover {
  background-color: #2b088c;
  color: white;
  box-shadow: 0 0 8px black;
}

.buttonParent {
  position: absolute;
  bottom: 10px;
  width: 100%;
}

.box > p {
  padding: 0 5px;
}

#presentation {
    width: 90%;
    margin: 0 auto;
    margin-top: 40px;
}

#gifts-container {
    padding: 20px 10%;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
  }

  #gifts-container > a {
    color: black;
    padding: 0 10px 10px 10px;
    background: blanchedalmond;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-decoration: none;
    cursor: pointer;
    transition: all 0.5s ease-in-out;
    width: 210px;
    position: relative;
    padding-bottom: 40px;
  }
  #gifts-container > a:hover {
    box-shadow: 0 0 8px black;
  }

  #gifts-container img {
    width: 190px;
    border-radius: 10px 10px 0 0;
  }

  #gifts-container span {
    background-color: pink;
    border-radius: 8px;
    transform: rotate(-30deg);
    padding-right: 5px;
    font-size: 19px;
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
    <div id="banner">
      <h1>Book an unforgivable day</h1>
    </div>

    <p style='padding: 8px;'>
      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
</p>

<?php
include 'conn.php';
$gifts = $conn->query("SELECT * FROM gift");
// extracts all gifts
$gifts = $gifts->fetchAll(PDO::FETCH_ASSOC);

foreach ($gifts as $gift) {
    echo "<div class='box'>
  <h2>{$gift['name']}</h2>
  <img src='{$gift['cover_img']}' />
  <p>
    {$gift['description']}
  </p>
  <div class='buttonParent'>
    <a href='experience.php?id={$gift['id']}'>
      <button>Book for £{$gift['price']}</button>
    </a>
  </div>
  </div>";
}
?>

    <footer>
      <p>© 2022 Experiences.com</p>
      </footer>
  </body>
</html>
