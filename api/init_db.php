<?php

function make_images($min, $max)
{
    $random_nr = rand($min, $max);
    $images = array();
    for ($i = 0; $i < $random_nr; $i++) {
        // push random image to array
        array_push($images, "https://picsum.photos/" . rand(200, 400));
    }

    return json_encode($images);
}

// create db if doesn't exist and populate it
function create_db_if_not_existent($db_name, $servername, $username, $password)
{
    // create db
    function create_db($conn, $db_name)
    {
        $create_db_query = "CREATE DATABASE $db_name";
        $db_created_success = $conn->query($create_db_query);
        if ($db_created_success) {
            // "Database created successfully\n";
        } else {
            die("Error creating database: " . json_encode($conn->errorInfo()));
        }
    }

    // create tables
    function create_tables($conn)
    {
        // read sql file and execute
        $sql = file_get_contents(__DIR__ . '/create_tables_queries.sql');
        // execute all sql queries

        $tables_created_success = $conn->exec($sql);
        if ($tables_created_success !== false) {
            // "Tables created successfully\n";
        } else {
            die("Error creating tables: " . json_encode($conn->errorInfo()));
        }
    }

    function populate_gifts_table($conn, $db_name)
    {

        // array of gift names
        $gift_names = ['Spa', 'Hot air baloon flight', 'Dinner at a Michelin star restaurant', 'Helicopter ride', 'Private jet ride', 'Yacht ride', 'Private island'];

        $gifts = array_map(function ($gift_name) {
            return array('name' => $gift_name, 'price' => rand(100, 1000), 'cover_img' => "https://picsum.photos/" . rand(800, 1000), 'images' => make_images(4, 9), 'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.');
        }, $gift_names);

        foreach ($gifts as $gift) {
            $name = $gift['name'];
            $price = $gift['price'];
            $cover_img = $gift['cover_img'];
            $images = $gift['images'];
            $description = $gift['description'];
            $sql = "INSERT INTO $db_name.gift (name, price, cover_img, images, description) VALUES ('$name', '$price', '$cover_img', '$images', '$description')";
            $result = $conn->query($sql);
            if ($result) {
                // "Gift added successfully\n";
            } else {
                die("Error adding gift: " . json_encode($conn->errorInfo()));
            }
        }
    }

    function populate_reviews_table($conn, $db_name)
    {
        // get all gifts ids
        $sql = "SELECT id FROM $db_name.gift";
        $result = $conn->query($sql);
        $gifts_ids = array();
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                array_push($gifts_ids, $row['id']);
            }
        } else {
            die("Error getting gifts ids: " . json_encode($conn->errorInfo()));
        }

        // get all customer ids
        $sql = "SELECT id FROM $db_name.customer";
        $result = $conn->query($sql);
        $customers_ids = array();
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                array_push($customers_ids, $row['id']);
            }
        } else {
            die("Error getting customers ids: " . json_encode($conn->errorInfo()));
        }

        $reviews = array();

        // loop through each gift
        foreach ($gifts_ids as $gift_id) {
            // random loop
            for ($i = 0; $i < rand(1, 3); $i++) {
                // get random customer id
                $customer_id = $customers_ids[array_rand($customers_ids)];
                $text = "Amazing experience! I would recommend it to everyone!";
                $review = array('gift_id' => $gift_id, 'customer_id' => $customer_id, 'text' => $text, 'images' => make_images(0, 2));
                array_push($reviews, $review);
            }
        }

        // insert reviews in db
        foreach ($reviews as $review) {
            $customer_id = $review['customer_id'];
            $gift_id = $review['gift_id'];
            $text = $review['text'];
            //reduce images array to string
            $images = $review['images'];
            $sql = "INSERT INTO $db_name.review (customer_id, gift_id, text, images) VALUES ('$customer_id', '$gift_id', '$text', '$images')";
            $result = $conn->query($sql);
            if ($result) {
                // "Review added successfully\n";
            } else {
                die("Error adding review: " . json_encode($conn->errorInfo()));
            }
        }
    }

    function populate_customers_table($conn, $db_name)
    {
        $customers = array();

        $names = ['John', 'Jane', 'Peter', 'Paul', 'Mary', 'Mark', 'Sarah', 'Sara', 'Sally', 'Samantha', 'Sam', 'Samuel', 'Sammy', 'Samira', 'Samir', 'Sami', 'Sammy', 'Samuel', 'Sam', 'Samantha', 'Sally', 'Sara', 'Sarah', 'Mark', 'Mary', 'Paul', 'Peter', 'Jane', 'John'];

        // rando loop
        for ($i = 0; $i < rand(2, 8); $i++) {
            $fname = $names[array_rand($names)];
            $lname = $names[array_rand($names)];
            $name = $fname . ' ' . $lname;
            $email = $fname . '.' . $lname . '@gmail.com';
            $password = "" . rand(100000, 999999);
            $customer = array('name' => $name, 'email' => $email, 'password' => $password);
            array_push($customers, $customer);
        }

        // insert customers in db
        foreach ($customers as $customer) {
            $name = $customer['name'];
            $email = $customer['email'];
            $password = $customer['password'];
            $sql = "INSERT INTO $db_name.customer (name, email, password) VALUES ('$name', '$email', '$password')";
            $result = $conn->query($sql);
            if ($result) {
                // "Customer added successfully\n";
            } else {
                die("Error adding customer: " . json_encode($conn->errorInfo()));
            }
        }
    }

    function populate_max_services_bookings_table($conn, $db_name)
    {
        // find all gifts ids
        $sql = "SELECT id FROM $db_name.gift";
        $result = $conn->query($sql);
        $gifts_ids = array();
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                array_push($gifts_ids, $row['id']);
            }
        } else {
            die("Error getting gifts ids: " . json_encode($conn->errorInfo()));
        }

        // create an array with all dates from today to 30 days from now
        $dates = array();
        $date = new DateTime();
        $date->modify('+90 days');
        $interval = new DateInterval('P1D');
        $period = new DatePeriod(new DateTime(), $interval, $date);
        foreach ($period as $date) {
            array_push($dates, $date->format('Y-m-d'));
        }

        // for each date, create a max service booking for each gift
        foreach ($dates as $date) {
            foreach ($gifts_ids as $gift_id) {
                $random_availability = rand(50, 100);
                $sql = "INSERT INTO $db_name.max_services_bookings (gift_id, booking_date, max_bookings) VALUES ('$gift_id', '$date', '$random_availability')";
                $result = $conn->query($sql);
                if ($result === false) {
                    die("Error adding max service booking: " . json_encode($conn->errorInfo()));
                }
            }
            // "Max service booking added successfully for " . $date . "\n";
        }
    }

    $conn = new PDO("mysql:host=$servername", $username, $password);
    // "Database does not exist\n";
    // create database
    create_db($conn, $db_name);
    // now we can connect directly to the database
    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
    // create tables
    create_tables($conn);
    // populate gifts table
    populate_gifts_table($conn, $db_name);
    // populate customers table
    populate_customers_table($conn, $db_name);
    // populate reviews table
    populate_reviews_table($conn, $db_name);
    // populate max_services_bookings table
    populate_max_services_bookings_table($conn, $db_name);

    return $conn;
}
