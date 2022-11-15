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
        h1{
            text-align: center;
        }
        form{
            width: 90%;
            margin: 0 auto;
            border: 1px solid black;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            padding: 50px 10px 30px 10px;
            gap: 15px;
        }
        input{
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.5s ease;
        }

        input[type=submit]:hover {
            background-color: #45a049;
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
    <h1>Register</h1>
    <form method="post" action="signup.php">
        <input required placeholder="Name" name="name" />
        <input required placeholder="Email address" name="email" type="email" />
        <input placeholder="Phone number" name="phone" type="number" />
        <input required placeholder="Password" name="password" type="password" />
        <input type="submit" />
    </form>

    <footer>
        <p>© 2022 Experiences.com</p>
        </footer>
  </body>
</html>
