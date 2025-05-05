<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

require_once 'db_connection.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $day = $_POST['day'];
    $time_slot = $_POST['time_slot'];
    $subject = $_POST['subject'];
    $teacher = $_POST['teacher'];
    $classroom = $_POST['classroom'];

    $query = "INSERT INTO timetable (day, time_slot, subject, teacher, classroom) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("sssss", $day, $time_slot, $subject, $teacher, $classroom);

    if ($stmt->execute()) {
        $success = "Timetable entry added successfully!";
    } else {
        $error = "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Timetable</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7f9;
        }

        /* Navbar */
        .navbar {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
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

        /* Container */
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 4px rgba(0, 123, 255, 0.5);
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .success, .error {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div>Teacher Management System</div>
        <div>
            <a href="index.php">Home</a>
            <a href="timetable.php">View Timetable</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <!-- Container -->
    <div class="container">
        <h1>Add Timetable Entry</h1>
        <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST" action="">
            <label for="day">Day:</label>
            <input type="text" id="day" name="day" placeholder="e.g., Monday" required>

            <label for="time_slot">Time Slot:</label>
            <input type="text" id="time_slot" name="time_slot" placeholder="e.g., 9:00 AM - 10:00 AM" required>

            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" placeholder="e.g., Mathematics" required>

            <label for="teacher">Teacher:</label>
            <input type="text" id="teacher" name="teacher" placeholder="e.g., John Doe" required>

            <label for="classroom">Classroom:</label>
            <input type="text" id="classroom" name="classroom" placeholder="e.g., Room 101" required>

            <button type="submit">Add Timetable</button>
        </form>
    </div>
    
    <script src="https://cdn.botpress.cloud/webchat/v2.2/inject.js"></script>
<script src="https://files.bpcontent.cloud/2025/01/04/19/20250104194551-K06IAY6B.js"></script>
    
</body>
</html>
