<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

require_once 'db_connection.php'; // Ensure database connection

$message = ""; // To store success/error messages

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["txt_file"])) {
    $file = $_FILES["txt_file"]["tmp_name"];

    if (!file_exists($file) || !is_readable($file)) {
        $message = "<p style='color:red;'>❌ Error: File not found or unreadable!</p>";
    } else {
        $message = processTXT($file);
    }
}

// **Function to Process TXT File**
function processTXT($file) {
    global $con;

    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $index => $line) {
        $data = explode("|", $line); // Split line using "|"
        insertAttendance($data);
    }

    return "<p style='color:green;'>✅ Attendance uploaded successfully! <br><a href='index.php' class='go-home'>Go to Home</a></p>";
}

// **Function to Insert Data into Database**
function insertAttendance($data) {
    global $con;

    if (count($data) < 5) {
        return "<p style='color:red;'>⚠️ TXT format error: Not enough columns detected.</p>";
    }

    list($teacher_id, $name, $intime, $outtime, $date) = array_map('trim', $data);

    if (empty($teacher_id) || empty($name) || empty($intime) || empty($outtime) || empty($date)) {
        return "<p style='color:red;'>⚠️ Missing values in TXT file. Skipping this row.</p>";
    }

    $intime = date("H:i:s", strtotime($intime));
    $outtime = date("H:i:s", strtotime($outtime));
    $date = date("Y-m-d", strtotime($date));

    // **Calculate Attendance Status**
    $status = ($intime >= "09:00:00" && $intime <= "09:15:00") || ($intime >= "13:00:00" && $intime <= "13:30:00") ? "Present" : "Absent";

    $stmt = $con->prepare("INSERT INTO teacher_attendance (teacher_id, name, intime, outtime, date, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $teacher_id, $name, $intime, $outtime, $date, $status);

    if (!$stmt->execute()) {
        return "<p style='color:red;'>⚠️ Error inserting data: " . $stmt->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Attendance (TXT Format)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
            background-color: #f4f7f9;
        }
        .navbar {
            background-color: #007bff;
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }
        .navbar a:hover {
            text-decoration: underline;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }
        h2 {
            color: #333;
        }
        input[type="file"] {
            margin: 15px 0;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            font-weight: bold;
            margin: 10px 0;
        }
        .go-home {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        .go-home:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <div>Teacher Management System</div>
    <div>
        <a href="index.php">Home</a>
        <a href="view_attendance.php">View Attendance</a>
        <a href="download_attendance.php">Download PDF</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<!-- Container -->
<div class="container">
    <h2>Upload Attendance (TXT Format Only)</h2>
    <p>Upload a `.txt` file with teacher attendance data.</p>
    
    <?php if (!empty($message)) echo "<p class='message'>$message</p>"; ?>

    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="txt_file" accept=".txt" required>
        <br>
        <button type="submit">Upload</button>
    </form>
</div>

</body>
</html>
