<?php
// Database connection
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "faculty_management";

// Create a connection
$con = new mysqli($host, $dbUsername, $dbPassword, $dbname);

// Check connection
if ($con->connect_error) {
    die("Database connection failed: " . $con->connect_error);
}

// Fetch data from the database
$query = "SELECT id, name, department, phone, email FROM teachers";
$result = $con->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Teachers</title>
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
            padding: 20px;
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
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        .btn-info {
            background-color: #007bff;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-info:hover {
            background-color: #0056b3;
        }

        .no-records {
            text-align: center;
            color: #555;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div>Teacher Management System</div>
        <div>
            <a href="index.php">Home</a>
            <a href="add_teacher.php">Add Teacher</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <!-- Container -->
    <div class="container">
        <h1>Teacher Records</h1>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $counter = 1;
                    while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $counter++; ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['department']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td>
                                <a href="teacher_profile.php?id=<?php echo $row['id']; ?>" class="btn btn-info">View Profile</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-records">No teacher records found.</p>
        <?php endif; ?>

        <?php $con->close(); ?>
    </div>
    
    <script src="https://cdn.botpress.cloud/webchat/v2.2/inject.js"></script>
<script src="https://files.bpcontent.cloud/2025/01/04/19/20250104194551-K06IAY6B.js"></script>
    
</body>
</html>
