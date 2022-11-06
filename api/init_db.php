<?php
include 'create_tables_queries.php';
include 'conn.php';

$db_name = "experiences";


// check if db exists
function db_exists($db_name)
{
   global $conn;
   $sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db_name'";
   $result = $conn->query($sql);
   return $result->num_rows > 0;
}

// create db
function create_db()
{
   global $conn, $db_name;
   $create_db_query = "CREATE DATABASE $db_name";
   $db_created_success = $conn->query($create_db_query);
   if ($db_created_success) {
      echo "Database created successfully\n";
   } else {
      die("Error creating database: " . $conn->error);
   }
}

// create tables
function create_tables()
{
   global $conn, $create_tables_queries;

   // loop through all queries
   foreach ($create_tables_queries as $query) {
      $table_created_success = $conn->query($query);
      if ($table_created_success) {
         echo "Table created successfully\n";
      } else {
         die("Error creating table: " . $conn->error);
      }
   }
}

function populate_gifts_table()
{
   global $conn, $db_name;

   function make_images()
   {
      $random_nr  = rand(1, 5);
      $images = array();
      for ($i = 0; $i < $random_nr; $i++) {
         // push random image to array
         array_push($images, "https://picsum.photos/" . rand(200, 400));
      }

      return json_encode($images);
   }

   // array of gift names
   $gift_names = ['Spa', 'Hot air baloon flight', 'Dinner at a Michelin star restaurant', 'Helicopter ride', 'Private jet ride', 'Yacht ride', 'Private island'];

   $gifts = array_map(function ($gift_name) {
      return array('name' => $gift_name, 'price' => rand(100, 1000),  'cover_img' => "https://picsum.photos/" . rand(800, 1000), 'images' => make_images(), 'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.');
   }, $gift_names);



   foreach ($gifts as $gift) {
      $name = $gift['name'];
      $price = $gift['price'];
      $cover_img = $gift['cover_img'];
      $images = $gift['images'];
      $description = $gift['description'];
      $sql = "INSERT INTO $db_name.gifts (name, price, cover_img, images, description) VALUES ('$name', '$price', '$cover_img', '$images', '$description')";
      $result = $conn->query($sql);
      if ($result) {
         echo "Gift added successfully\n";
      } else {
         die("Error adding gift: " . $conn->error);
      }
   }
}

function populate_reviews_table()
{
   global $conn, $db_name;
   // get all gifts ids
   $sql = "SELECT id FROM $db_name.gifts";
   $result = $conn->query($sql);
   $gifts_ids = array();
   if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
         array_push($gifts_ids, $row['id']);
      }
   } else {
      die("Error getting gifts ids: " . $conn->error);
   }

   // get all customer ids
   $sql = "SELECT id FROM $db_name.customers";
   $result = $conn->query($sql);
   $customers_ids = array();
   if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
         array_push($customers_ids, $row['id']);
      }
   } else {
      die("Error getting customers ids: " . $conn->error);
   }

   $reviews = array();

   // rando loop
   for($i = 0; $i < rand(2, 8); $i++) {
      $gift_id = $gifts_ids[array_rand($gifts_ids)];
      $customer_id = $customers_ids[array_rand($customers_ids)];
      $text = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.";
      $review = array('gift_id' => $gift_id, 'customer_id' => $customer_id, 'text' => $text);
      array_push($reviews, $review);
   }

   // insert reviews in db
   foreach ($reviews as $review) {
      $customer_id = $review['customer_id'];
      $gift_id = $review['gift_id'];
      $text = $review['text'];
      $sql = "INSERT INTO $db_name.reviews (customer_id, gift_id, text) VALUES ('$customer_id', '$gift_id', '$text')";
      $result = $conn->query($sql);
      if ($result) {
         echo "Review added successfully\n";
      } else {
         die("Error adding review: " . $conn->error);
      }
   }
}


function populate_customers_table()
{
   global $conn, $db_name;
   $customers = array();

   $names = ['John', 'Jane', 'Peter', 'Paul', 'Mary', 'Mark', 'Sarah', 'Sara', 'Sally', 'Samantha', 'Sam', 'Samuel', 'Sammy', 'Samira', 'Samir', 'Sami', 'Sammy', 'Samuel', 'Sam', 'Samantha', 'Sally', 'Sara', 'Sarah', 'Mark', 'Mary', 'Paul', 'Peter', 'Jane', 'John'];

   // rando loop
   for($i = 0; $i < rand(2, 8); $i++) {
      $fname = $names[array_rand($names)];
      $lname = $names[array_rand($names)];
      $name = $fname . ' ' . $lname;
      $email = $fname . '.' . $lname . '@gmail.com';
      $password = "".rand(100000, 999999);
      $customer = array('name' => $name, 'email' => $email, 'password' => $password);
      array_push($customers, $customer);
   }

   // insert customers in db
   foreach ($customers as $customer) {
      $name = $customer['name'];
      $email = $customer['email'];
      $password = $customer['password'];
      $sql = "INSERT INTO $db_name.customers (name, email, password) VALUES ('$name', '$email', '$password')";
      $result = $conn->query($sql);
      if ($result) {
         echo "Customer added successfully\n";
      } else {
         die("Error adding customer: " . $conn->error);
      }
   }
}


// create db if doesn't exist and populate it
function create_db_if_not_existent()
{
   // reference global variables inside function
   global $db_name, $conn;



   if (db_exists($db_name)) {
      echo "Database exists\n";
      // if there are no gifts in db, populate gifts table
      $sql = "SELECT * FROM $db_name.gifts";
      $result = $conn->query($sql);
      if ($result->num_rows == 0) {
         populate_gifts_table();
      }

      // if there are no customers in db, populate customers table
      $sql = "SELECT * FROM $db_name.customers";
      $result = $conn->query($sql);
      if ($result->num_rows == 0) {
         populate_customers_table();
      }

      // if there are no reviews in db, populate reviews table
      $sql = "SELECT * FROM $db_name.reviews";
      $result = $conn->query($sql);
      if ($result->num_rows == 0) {
         populate_reviews_table();
      }
   } else {
      echo "Database does not exist\n";
      // create database
      create_db();
      // create tables
      create_tables();
      // populate gifts table
      populate_gifts_table();
      // populate customers table
      populate_customers_table();
      // populate reviews table
      populate_reviews_table();
   }
}

create_db_if_not_existent();
$conn->close();
