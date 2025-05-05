<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

require_once 'db_connection.php'; // Include database connection

// Fetch timetable data
$query = "SELECT * FROM timetable ORDER BY FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'), time_slot";
$result = $con->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timetable</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7f9;
        }
        .navbar {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
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
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div>Teacher Management System</div>
        <div>
            <a href="index.php">Home</a>
           <!-- <a href="add_teacher.php">Add Teacher</a>
            <a href="display_teacher.php">View Teachers</a>
            <a href="timetable.php">Time Table</a> -->
            <a href="add_timetable.php">Add TimeTable</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <!-- Timetable Content -->
    <div class="container">
        <h1>Weekly Timetable</h1>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Day</th>
                    <th>Time Slot</th>
                    <th>Subject</th>
                    <th>Teacher</th>
                    <th>Classroom</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['day']); ?></td>
                        <td><?php echo htmlspecialchars($row['time_slot']); ?></td>
                        <td><?php echo htmlspecialchars($row['subject']); ?></td>
                        <td><?php echo htmlspecialchars($row['teacher']); ?></td>
                        <td><?php echo htmlspecialchars($row['classroom']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No timetable data available.</p>
        <?php endif; ?>
    </div>
    
    <script src="https://cdn.botpress.cloud/webchat/v2.2/inject.js"></script>
<script src="https://files.bpcontent.cloud/2025/01/04/19/20250104194551-K06IAY6B.js"></script>
    
</body>
</html>
