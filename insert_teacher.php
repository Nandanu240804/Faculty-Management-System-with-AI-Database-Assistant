<?php
// Get form data
$name = $_POST['name'];
$department = $_POST['department'];
$phone = $_POST['phone'];
$email = $_POST['email'];

// Check if all fields are filled
if (!empty($name) && !empty($department) && !empty($phone) && !empty($email)) {
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

    // Validate email uniqueness
    $selectQuery = "SELECT email FROM teachers WHERE email = ? LIMIT 1";
    $insertQuery = "INSERT INTO teachers (name, department, phone, email) VALUES (?, ?, ?, ?)";

    $stmt = $con->prepare($selectQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Error: A teacher with this email already exists.";
    } else {
        $stmt->close();
        $stmt = $con->prepare($insertQuery);
        $stmt->bind_param("ssss", $name, $department, $phone, $email);

        if ($stmt->execute()) {
            echo "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Success</title>
                <style>
                    /* Navbar */
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
                        margin-left: 20px;
                    }
                    .navbar a:hover {
                        text-decoration: underline;
                    }

                    /* Success Card */
                    .card {
                        max-width: 400px;
                        margin: 50px auto;
                        padding: 20px;
                        text-align: center;
                        background-color: #f4f7f9;
                        border-radius: 8px;
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    }
                    .card h1 {
                        color: #007bff;
                    }
                    .card p {
                        margin: 10px 0;
                        color: #333;
                    }
                    .card a {
                        color: #007bff;
                        text-decoration: none;
                        font-weight: bold;
                        transition: color 0.3s ease, transform 0.3s ease;
                    }
                    .card a:hover {
                        color: #0056b3;
                        transform: scale(1.1);
                    }
                </style>
            </head>
            <body>
                <div class='navbar'>
                    <div>Teacher Management</div>
                    <div>
                        <a href='index.php'>Home</a>
                        <a href='add_teacher.php'>Add Teacher</a>
                        <a href='display_teacher.php'>View Teachers</a>
                    </div>
                </div>
                <div class='card'>
                    <h1>Success!</h1>
                    <p>Teacher added successfully.</p>
                    <a href='index.php'>Go to Home</a>
                </div>
            </body>
            </html>";
        } else {
            echo "Error during insertion: " . $stmt->error;
        }
    }

    $stmt->close();
    $con->close();
} else {
    echo "All fields are required.";
    exit();
}
?>
