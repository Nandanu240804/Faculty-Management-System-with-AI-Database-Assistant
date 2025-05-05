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

// Fetch all teacher data
$query = "SELECT * FROM teachers";
$result = $con->query($query);

// Close database connection
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Profiles</title>
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

        /* Profile Cards */
        .profile-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .profile-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .profile-card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        }

        .profile-card h2 {
            color: #007bff;
            margin-bottom: 10px;
        }

        .profile-card p {
            color: #555;
            margin: 5px 0;
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

    <!-- Profile Cards -->
    <div class="profile-container">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($teacher = $result->fetch_assoc()): ?>
                <div class="profile-card">
                    <h2><?php echo htmlspecialchars($teacher['name']); ?></h2>
                    <p><strong>Department:</strong> <?php echo htmlspecialchars($teacher['department']); ?></p>
                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($teacher['phone']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($teacher['email']); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align: center;">No teachers found.</p>
        <?php endif; ?>
    </div>
    
    <script src="https://cdn.botpress.cloud/webchat/v2.2/inject.js"></script>
<script src="https://files.bpcontent.cloud/2025/01/04/19/20250104194551-K06IAY6B.js"></script>
    
</body>
</html>
