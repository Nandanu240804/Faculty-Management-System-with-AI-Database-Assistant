<?php
require_once 'vendor/autoload.php'; // Include PHPWord via Composer

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

// Database connection
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "faculty_management";
$con = new mysqli($host, $dbUsername, $dbPassword, $dbname);

if ($con->connect_error) {
    die("Database connection failed: " . $con->connect_error);
}

// Fetch attendance data
$query = "SELECT teachers.name, teachers.department, attendance.date, attendance.status 
          FROM attendance 
          JOIN teachers ON attendance.teacher_id = teachers.id 
          ORDER BY attendance.date DESC";
$result = $con->query($query);

// Create Word Document
$phpWord = new PhpWord();
$section = $phpWord->addSection();
$section->addTitle('Teacher Attendance Report', 1);

$table = $section->addTable();
$table->addRow();
$table->addCell(3000)->addText('Name', ['bold' => true]);
$table->addCell(3000)->addText('Department', ['bold' => true]);
$table->addCell(2000)->addText('Date', ['bold' => true]);
$table->addCell(2000)->addText('Status', ['bold' => true]);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $table->addRow();
        $table->addCell(3000)->addText($row['name']);
        $table->addCell(3000)->addText($row['department']);
        $table->addCell(2000)->addText($row['date']);
        $table->addCell(2000)->addText($row['status']);
    }
} else {
    $section->addText('No attendance records found.');
}

$con->close();

// Save Word Document
$filename = 'Attendance_Report.docx';
$phpWord->save($filename, 'Word2007');
header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
readfile($filename);
unlink($filename); // Delete the file after download
?>
