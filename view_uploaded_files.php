<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

require_once 'db_connection.php';

// Fetch all uploaded attendance files
$query = "SELECT id, file_name, file_path, upload_time FROM uploaded_files ORDER BY upload_time DESC";
$result = $con->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Attendance Files</title>
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

        .download-btn {
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
        }

        .download-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div>Teacher Management System</div>
        <div>
            <a href="index.php">Home</a>
            <a href="upload_attendance.php">Upload Attendance</a>
            <a href="view_uploaded_files.php">View Uploaded Files</a>
            <a href="generate_uploaded_pdf.php">Download as PDF</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <!-- Container -->
    <div class="container">
        <h1>Uploaded Attendance Files</h1>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>#</th>
                    <th>File Name</th>
                    <th>Uploaded Time</th>
                    <th>Download</th>
                </tr>
                <?php $counter = 1; ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $counter++; ?></td>
                        <td><?php echo htmlspecialchars($row['file_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['upload_time']); ?></td>
                        <td>
                            <a href="download_uploaded_file.php?id=<?php echo $row['id']; ?>" class="download-btn">📥 Download</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No uploaded attendance files found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
