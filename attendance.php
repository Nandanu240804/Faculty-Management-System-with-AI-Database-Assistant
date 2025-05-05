<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

require_once 'db_connection.php';

// Fetch teacher list
$teachers = $con->query("SELECT id, name FROM teachers");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teacher_id = $_POST['teacher_id'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    $stmt = $con->prepare("INSERT INTO attendance (teacher_id, date, status) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $teacher_id, $date, $status);

    if ($stmt->execute()) {
        $success = "Attendance recorded successfully!";
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
    <title>Mark Attendance</title>
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
            margin-bottom: 20px;
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

        select, input {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        select:focus, input:focus {
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
            <a href="view_attendance.php">View Attendance</a>
            <a href="index.php"></a>
            <a href="generate_attendance_pdf.php">Download Attendance PDF</a>
            <a href="generate_attendance_word.php">Download Attendance Word</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <!-- Container -->
    <div class="container">
        <h1>Mark Attendance</h1>
        <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST" action="">
            <label for="teacher_id">Select Teacher:</label>
            <select name="teacher_id" required>
                <option value="">-- Select Teacher --</option>
                <?php while ($row = $teachers->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>">
                        <?php echo htmlspecialchars($row['name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label for="date">Date:</label>
            <input type="date" name="date" required>

            <label for="status">Status:</label>
            <select name="status" required>
                <option value="">-- Select Status --</option>
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
            </select>

            <button type="submit">Submit</button>
        </form>
    </div>
    
    <script src="https://cdn.botpress.cloud/webchat/v2.2/inject.js"></script>
<script src="https://files.bpcontent.cloud/2025/01/04/19/20250104194551-K06IAY6B.js"></script>
    
</body>
</html>
