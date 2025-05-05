<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Management System</title>
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

        /* Hero Section */
        .hero {
            background-color: #0056b3;
            color: white;
            text-align: center;
            padding: 80px 20px;
        }
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 1.3rem;
            margin-bottom: 30px;
        }
        .hero a {
            background-color: white;
            color: #007bff;
            padding: 12px 25px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 8px;
        }
        .hero a:hover {
            background-color: #f4f7f9;
        }

        /* Features Section */
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 50px 20px;
        }
        .feature-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }
        .feature-card:hover {
            transform: scale(1.05);
        }
        .feature-card h3 {
            color: #007bff;
            margin-bottom: 15px;
        }
        .feature-card p {
            color: #555;
            margin-bottom: 20px;
        }
        .feature-card a {
            text-decoration: none;
            color: white;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .feature-card a:hover {
            background-color: #0056b3;
        }

        /* AI Panel Button */
        .ai-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-radius: 50%;
            font-size: 20px;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .ai-button:hover {
            background-color: #0056b3;
        }

        /* AI Panel */
        .ai-panel {
            position: fixed;
            bottom: 0;
            right: 20px;
            background-color: white;
            width: 350px;
            max-height: 80vh;
            border-radius: 15px 15px 0 0;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transform: translateY(100%);
            transition: transform 0.4s ease-in-out;
            overflow: hidden;
        }
        .ai-panel.active {
            transform: translateY(0);
        }
        .ai-header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 18px;
            position: relative;
        }
        .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
        }
        .ai-content {
            padding: 20px;
            max-height: 60vh;
            overflow-y: auto;
        }
        .ai-input {
            display: flex;
            padding: 10px;
            border-top: 1px solid #ddd;
        }
        .ai-input input[type="text"] {
            flex: 1;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .ai-input button {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            margin-left: 10px;
            cursor: pointer;
        }
        .ai-input button:hover {
            background-color: #0056b3;
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
            <a href="attendance.php">Mark Attendance</a>
            <a href="view_attendance.php">View Attendance</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="hero">
        <h1>Welcome to the Faculty Management System</h1>
        <p>Efficiently manage faculty data, attendance, and more with ease.</p>
        <a href="display_teacher.php">Explore Now</a>
    </div>

    <!-- Features Section -->
    <div class="features">
        <div class="feature-card">
            <h3>Add Teachers</h3>
            <p>Quickly add new teachers to your system with detailed information.</p>
            <a href="add_teacher.php">Add Now</a>
        </div>
        <div class="feature-card">
            <h3>View Teachers</h3>
            <p>Access and manage the complete teacher directory.</p>
            <a href="display_teacher.php">View Now</a>
        </div>
        <div class="feature-card">
            <h3>Track Attendance</h3>
            <p>Monitor teacher attendance with accuracy.</p>
            <a href="attendance.php">Track Now</a>
        </div>
    </div>

    <!-- AI Chatbot Button -->
    <button class="ai-button" onclick="toggleAiPanel()">🤖</button>

    <!-- AI Panel -->
    <div class="ai-panel" id="aiPanel">
        <div class="ai-header">FacultyBot <button class="close-btn" onclick="toggleAiPanel()">×</button></div>
        <div class="ai-content" id="aiContent">How can I assist you today?</div>
        <div class="ai-input">
            <input type="text" id="aiQuestion" placeholder="Type your question...">
            <button onclick="askQuestion()">Send</button>
        </div>
    </div>

    <script>
        function toggleAiPanel() {
            const panel = document.getElementById('aiPanel');
            panel.classList.toggle('active');
        }

        function askQuestion() {
            const question = document.getElementById('aiQuestion').value;
            const aiContent = document.getElementById('aiContent');

            if (!question.trim()) {
                alert("Please enter a question.");
                return;
            }

            // Append user's question to the chat
            aiContent.innerHTML += `<div><strong>You:</strong> ${question}</div>`;

            fetch('ask.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ question: question })
            })
            .then(response => response.json())
            .then(data => {
                // Append bot's response to the chat
                aiContent.innerHTML += `<div><strong>FacultyBot:</strong> ${data.answer || "No response from AI."}</div>`;
                document.getElementById('aiQuestion').value = ''; // Clear input
                aiContent.scrollTop = aiContent.scrollHeight; // Scroll to bottom
            })
            .catch(error => {
                console.error('Error:', error);
                aiContent.innerHTML += `<div><strong>Error:</strong> Failed to fetch response.</div>`;
            });
        }
    </script>
</body>
</html>