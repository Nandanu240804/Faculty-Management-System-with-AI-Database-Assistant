<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

require_once 'db_connection.php';

// Fetch the latest uploaded file details
$query = "SELECT file_name, file_path FROM uploaded_files ORDER BY upload_time DESC LIMIT 1";
$result = $con->query($query);

$fileInfo = $result->fetch_assoc();
$filePath = $fileInfo['file_path'];
$fileName = $fileInfo['file_name'];

if (!$filePath || !file_exists($filePath)) {
    die("<p style='color:red; text-align:center;'>❌ No uploaded attendance file found!</p>");
}

// Start file download
header("Content-Description: File Transfer");
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=" . basename($filePath));
header("Expires: 0");
header("Cache-Control: must-revalidate");
header("Pragma: public");
header("Content-Length: " . filesize($filePath));
readfile($filePath);
exit();
?>
