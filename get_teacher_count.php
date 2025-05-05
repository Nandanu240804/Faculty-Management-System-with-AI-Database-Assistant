<?php
header('Content-Type: application/json');

$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "faculty_management";

$con = new mysqli($host, $dbUsername, $dbPassword, $dbname);

if ($con->connect_error) {
    echo json_encode(["error" => "Connection failed"]);
    exit();
}

$query = "SELECT COUNT(*) AS total_teachers FROM teachers";
$result = $con->query($query);
$row = $result->fetch_assoc();

echo json_encode(["total_teachers" => $row['total_teachers']]);

$con->close();
?>
