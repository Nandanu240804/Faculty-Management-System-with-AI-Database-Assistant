<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Resources</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f9;
            margin: 0;
            padding: 0;
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

        /* Page Content */
        .container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        /* Google Drive Embed */
        .drive-container {
            width: 100%;
            height: 600px;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div>Faculty Management System</div>
        <div>
            <a href="index.php">Home</a>
            <a href="display_teacher.php">View Teachers</a>
            <a href="learning_resources.php">Learning Resources</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <!-- Learning Resources Section -->
    <div class="container">
        <h1>📚 Notes & Question Papers</h1>
        <p>Access all study materials in one place.</p>

        <!-- Embedded Google Drive Folder -->
        <iframe class="drive-container" 
                src="https://drive.google.com/embeddedfolderview?id=1ApDAuwHnu0Kc7y-paqJJYY50YhQWlnmp#grid">
        </iframe>
    </div>
</body>
</html>
