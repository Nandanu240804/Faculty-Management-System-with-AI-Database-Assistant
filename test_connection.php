<?php
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "faculty_management";

$con = new mysqli($host, $dbUsername, $dbPassword, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
echo "Connection successful!";
?>
