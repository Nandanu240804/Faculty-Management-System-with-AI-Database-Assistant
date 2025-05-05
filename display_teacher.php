<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Teachers</title>
    <style>
        .navbar {
            background-color: #007bff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px; /* Add spacing between links */
            font-size: 16px;
        }
        .navbar a:hover {
            text-decoration: underline;
        }
        .navbar .nav-links {
            display: flex; /* Align links horizontally */
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
        .remove-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        .remove-btn:hover {
            background-color: #c82333;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div>Teacher Management</div>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="add_teacher.php">Add Teacher</a>
            <a href="display_department.php">Department-wise</a>
            <a href="logout.php">Log out</a>
        </div>
    </div>

    <div class="container">
        <h1>Teacher Records</h1>
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

        // Fetch data from the database
        $query = "SELECT id, name, department, phone, email FROM teachers";
        $result = $con->query($query);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>";

            // Display data in rows with sequential numbering
            $counter = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$counter}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['department']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['email']}</td>
                        <td>
                            <form action='remove_teacher.php' method='post' style='display:inline;' onsubmit=\"return confirm('Are you sure you want to remove this teacher?');\">
                                <input type='hidden' name='id' value='{$row['id']}'>
                                <button type='submit' class='remove-btn'>Remove</button>
                            </form>
                        </td>
                      </tr>";
                $counter++;
            }

            echo "</table>";
        } else {
            echo "<p>No records found.</p>";
        }

        // Close the connection
        $con->close();
        ?>
    </div>
    
    <script src="https://cdn.botpress.cloud/webchat/v2.2/inject.js"></script>
<script src="https://files.bpcontent.cloud/2025/01/04/19/20250104194551-K06IAY6B.js"></script>
    
</body>
</html>
