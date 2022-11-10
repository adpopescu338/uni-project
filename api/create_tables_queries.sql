CREATE TABLE customers (
         id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         name VARCHAR(30) NOT NULL,
         phone VARCHAR(50),
         email VARCHAR(50) NOT NULL,
         password VARCHAR(50) NOT NULL,
         reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP);

CREATE TABLE gifts (
         id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         name VARCHAR(50) NOT NULL,
         price FLOAT NOT NULL,
         description TEXT NOT NULL,
         cover_img VARCHAR(100) NOT NULL,
         images TEXT NOT NULL);

CREATE TABLE bookings (
         id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         customer_id INT(6) UNSIGNED NOT NULL,
         gift_id INT(6) UNSIGNED NOT NULL,
         booking_date DATE NOT NULL);


CREATE TABLE reviews (
         id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         customer_id INT(6) UNSIGNED NOT NULL,
         gift_id INT(6) UNSIGNED NOT NULL,
         text TEXT NOT NULL);

CREATE TABLE max_services_bookings(
         booking_date DATE NOT NULL,
         gift_id INT(6) UNSIGNED NOT NULL,
         max_bookings INT(3) NOT NULL DEFAULT 100,
         PRIMARY KEY (booking_date, gift_id));