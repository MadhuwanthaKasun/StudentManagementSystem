<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_management_system";

// Create connection without specifying the database
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if (mysqli_query($conn, $sql)) {
    // Select the database
    mysqli_select_db($conn, $dbname);

    // Create tables if they don't exist
    $createStudentsTable = "
    CREATE TABLE IF NOT EXISTS `students` (
      `id` int(255) NOT NULL AUTO_INCREMENT,
      `full_name` varchar(255) NOT NULL,
      `nic` varchar(255) NOT NULL,
      `address` varchar(255) NOT NULL,
      `telephone` varchar(255) NOT NULL,
      `gender` varchar(255) NOT NULL,
      `email` varchar(255) NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";

    $createUsersTable = "
    CREATE TABLE IF NOT EXISTS `users` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `user_name` varchar(200) DEFAULT NULL,
      `email` varchar(200) DEFAULT NULL,
      `user_type` int(11) DEFAULT 1,
      `password` varchar(200) DEFAULT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";

    if (mysqli_query($conn, $createStudentsTable)) {
        // echo "Students table created successfully or already exists.";
    } else {
        echo "Error creating students table: " . mysqli_error($conn);
    }

    if (mysqli_query($conn, $createUsersTable)) {
        // echo "Users table created successfully or already exists.";
    } else {
        echo "Error creating users table: " . mysqli_error($conn);
    }
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

?>