<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

require_once 'db_connection.php';

// Fetch attendance records
$query = "SELECT a.id, t.name AS teacher_name, a.date, a.status FROM attendance a JOIN teachers t ON a.teacher_id = t.id ORDER BY a.date DESC";
$result = $con->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance</title>
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
            max-width: 800px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
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

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div>Teacher Management System</div>
        <div>
            <a href="index.php">Home</a>
            <a href="attendance.php">Mark Attendance</a>
            <a href="view_attendance.php">View Attendance</a>
            <a href="generate_attendance_pdf.php">Download Attendance PDF</a>
            <a href="generate_attendance_word.php">Download Attendance Word</a>

            <a href="logout.php">Logout</a>
        </div>
    </div>

    <!-- Container -->
    <div class="container">
        <h1>Attendance Records</h1>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>#</th>
                    <th>Teacher Name</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
                <?php $counter = 1; ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $counter++; ?></td>
                        <td><?php echo htmlspecialchars($row['teacher_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['date']); ?></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No attendance records found.</p>
        <?php endif; ?>
    </div>
    
    <script src="https://cdn.botpress.cloud/webchat/v2.2/inject.js"></script>
<script src="https://files.bpcontent.cloud/2025/01/04/19/20250104194551-K06IAY6B.js"></script>
    
</body>
</html>
