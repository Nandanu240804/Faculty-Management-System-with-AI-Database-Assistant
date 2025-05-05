<?php
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

// SQL query to fetch teacher names and count grouped by department
$query = "SELECT department, GROUP_CONCAT(name SEPARATOR ', ') AS teacher_names, COUNT(*) AS total_teachers 
          FROM teachers GROUP BY department";
$result = $con->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teacher Count by Department</title>
  <style>
    /* General Styles */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f7f9;
    }

    h1 {
      text-align: center;
      margin-top: 20px;
      color: #333;
    }

    /* Navbar Styles */
    .navbar-horizontal {
      background-color: #007bff;
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      color: white;
    }

    .navbar-horizontal nav {
      display: flex;
    }

    .navbar-horizontal nav a {
      color: white;
      text-decoration: none;
      margin: 0 15px;
      font-size: 16px;
    }

    .navbar-horizontal nav a:hover {
      text-decoration: underline;
    }

    /* Card Container */
    .card-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      margin: 20px;
    }

    /* Individual Card */
    .card {
      background-color: #ffffff;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      width: 300px;
      margin: 10px;
      padding: 20px;
      text-align: center;
      transition: transform 0.3s ease-in-out;
    }

    .card:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
    }

    .card h2 {
      margin: 0;
      color: #007bff;
      font-size: 24px;
    }

    .card p {
      font-size: 18px;
      color: #555;
      margin: 10px 0;
    }

    .card ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
      font-size: 16px;
      color: #333;
    }

    .card li {
      margin: 5px 0;
    }

    /* Footer */
    footer {
      text-align: center;
      padding: 10px;
      background-color: #007bff;
      color: white;
      position: fixed;
      bottom: 0;
      width: 100%;
    }
  </style>
</head>
<body>
  <div class="navbar-horizontal">
    <div>Teacher Management</div>
    <nav>
      <a href="index.php">Home</a>
      <a href="teacher_profile.php">Teachers_profile</a>
      <a href="display_teacher.php">View Teachers</a>
      <a href="add_teacher.php">Add Teachers</a>
      <a href="logout.php">Logout</a>
    </nav>
  </div>

  <h1>Teacher Count by Department</h1>

  <div class="card-container">
    <?php
    if ($result && $result->num_rows > 0) {
        // Fetch each row and display it in a card
        while ($row = $result->fetch_assoc()) {
            echo "
            <div class='card'>
                <h2>" . htmlspecialchars($row['department']) . "</h2>
                <p>Total Teachers: <strong>" . $row['total_teachers'] . "</strong></p>
                <p>Teachers:</p>
                <ul>";
            // Split the teacher names into a list
            $teacher_names = explode(", ", $row['teacher_names']);
            foreach ($teacher_names as $name) {
                echo "<li>" . htmlspecialchars($name) . "</li>";
            }
            echo "
                </ul>
            </div>";
        }
    } else {
        echo "<p style='text-align:center;'>No teachers found.</p>";
    }

    // Close the connection
    if ($con) {
        $con->close();
    }
    ?>
  </div>
  <footer>
    © 2024 Faculty Management System
  </footer>
  
  <script src="https://cdn.botpress.cloud/webchat/v2.2/inject.js"></script>
<script src="https://files.bpcontent.cloud/2025/01/04/19/20250104194551-K06IAY6B.js"></script>
    
</body>
</html>
