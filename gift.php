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
    <div id="content">
      <div class="loader"></div>

      <div id="gift-info" class="hidden">
        <form action="api/book.php">
          <input name="gift_id" value="" type="hidden" />
          <select name="date"></select>
          <button type="submit">Book</button>
        </form>
      </div>
    </div>

    <footer>
      <p>© 2022 Experiences.com</p>
      </footer>
  </body>
  <script type="module" src="scripts/gift.js"></script>
</html>