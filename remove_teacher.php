<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id']; // Get the teacher ID

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

    // Delete query
    $query = "DELETE FROM teachers WHERE id = ?";
    $stmt = $con->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo "Teacher removed successfully.";
        } else {
            echo "Error removing teacher: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $con->error;
    }

    // Close the connection
    $con->close();

    // Redirect back to the display page
    header("Location: display_teacher.php");
    exit();
}
?>
