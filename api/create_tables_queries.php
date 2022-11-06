<?php

$db_name = "experiences";

$create_customers_table_query = "CREATE TABLE $db_name.customers (
         id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         name VARCHAR(30) NOT NULL,
         phone VARCHAR(50) NOT NULL,
         email VARCHAR(50) NOT NULL,
         password VARCHAR(50) NOT NULL,
         reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";

$create_gifts_table_query = "CREATE TABLE $db_name.gifts (
         id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         name VARCHAR(30) NOT NULL,
         price VARCHAR(50) NOT NULL,
         description VARCHAR(50) NOT NULL,
         cover_img VARCHAR(50) NOT NULL,
         images VARCHAR(50) NOT NULL,
         max_bookings INT(100) NOT NULL DEFAULT 100)";

$create_bookings_table_query = "CREATE TABLE $db_name.bookings (
         id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         customer_id INT(6) UNSIGNED NOT NULL,
         gift_id INT(6) UNSIGNED NOT NULL,
         booking_date DATE NOT NULL)";


$create_reviews_table_query = "CREATE TABLE $db_name.reviews (
         id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         customer_id INT(6) UNSIGNED NOT NULL,
         gift_id INT(6) UNSIGNED NOT NULL,
         text VARCHAR(1000) NOT NULL)";

// create array with all queries
$create_tables_queries = array(
   $create_customers_table_query,
   $create_gifts_table_query,
   $create_bookings_table_query,
   $create_reviews_table_query
);
