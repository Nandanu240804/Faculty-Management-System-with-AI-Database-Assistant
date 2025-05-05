<?php
$apiKey = ""; // Replace with your actual API Key
$folderId = ""; // Replace with your Google Drive Folder ID

// ✅ Corrected API Request
$url = "https://www.googleapis.com/drive/v3/files?q=" . urlencode("'" . $folderId . "' in parents") . "&fields=files(id,name,mimeType)&key=" . $apiKey;
$response = file_get_contents($url);
$data = json_decode($response, true);

// ✅ Improved Error Handling
if (!$data || !isset($data['files'])) {
    die("<p style='color: red; text-align: center;'>⚠️ API Error: Check API Key and Folder Permissions</p>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Resources</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f9;
            text-align: center;
            margin: 0;
            padding: 0;
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
            width: 80%;
            margin: auto;
            padding: 20px;
        }

        .search-box {
            width: 100%;
            max-width: 400px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .file-card {
            background-color: white;
            padding: 15px;
            margin: 10px;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
            display: inline-block;
            width: 300px;
        }

        .file-card:hover {
            transform: scale(1.05);
            box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.15);
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .no-files {
            font-size: 18px;
            color: red;
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
            <a href="fetch_files.php">📚 Learning System</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <h1>📚 Notes & Question Papers</h1>
        <p>Browse all study materials dynamically fetched from Google Drive.</p>

        <!-- Search Bar -->
        <input type="text" id="searchInput" class="search-box" placeholder="🔍 Search files..." onkeyup="searchFiles()">

        <!-- Display Files -->
        <div id="fileList">
            <?php
            if (!empty($data['files'])) {
                foreach ($data['files'] as $file) {
                    echo "<div class='file-card'>";
                    echo "<p class='file-name'><a href='https://drive.google.com/file/d/" . $file['id'] . "/view' target='_blank'>" . htmlspecialchars($file['name']) . "</a></p>";
                    echo "</div>";
                }
            } else {
                echo "<p class='no-files'>⚠️ No files found in the Google Drive folder.</p>";
            }
            ?>
        </div>
    </div>

    <script>
        function searchFiles() {
            let input = document.getElementById("searchInput").value.toLowerCase();
            let fileCards = document.querySelectorAll(".file-card");

            fileCards.forEach(card => {
                let fileName = card.querySelector(".file-name").textContent.toLowerCase();
                if (fileName.includes(input)) {
                    card.style.display = "inline-block";
                } else {
                    card.style.display = "none";
                }
            });
        }
    </script>

</body>
</html>
