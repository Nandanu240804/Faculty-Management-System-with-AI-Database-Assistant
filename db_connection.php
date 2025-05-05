<?php
$host = "localhost";
$dbUsername = "root";
$dbPassword = ""; // Default password for XAMPP is empty
$dbname = "faculty_management"; // Your existing database name

// Create a connection
$con = new mysqli($host, $dbUsername, $dbPassword, $dbname);

// Check connection
if ($con->connect_error) {
    die("Database connection failed: " . $con->connect_error);
}
?>
