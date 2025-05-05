<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Teacher</title>
  <style>
    /* General Styles */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    /* Horizontal Navbar */
    .navbar-horizontal {
      background-color: #007bff;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
    }

    .navbar-horizontal a {
      color: white;
      text-decoration: none;
      margin-left: 20px;
    }

    .navbar-horizontal a:hover {
      text-decoration: underline;
    }

    /* Main Content Area */
    .main-content {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f4f7f9;
    }

    /* Form Container */
    .form-container {
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 20px 30px;
      width: 100%;
      max-width: 400px;
      box-sizing: border-box;
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
      color: #555;
    }

    .form-group input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 14px;
    }

    .form-group input:focus {
      outline: none;
      border-color: #007bff;
      box-shadow: 0 0 4px rgba(0, 123, 255, 0.5);
    }

    .form-container button {
      width: 100%;
      background-color: #007bff;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
    }

    .form-container button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <!-- Horizontal Navbar -->
  <div class="navbar-horizontal">
    <div>Teacher Management</div>
    <nav>
      <a href="index.php">Home</a>
      <a href="teacher_profiles.php">Teachers Profile</a>
      <a href="display_teacher.php">View Teachers</a>
      <a href="logout.php">Logout</a>
    </nav>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <div class="form-container">
      <h2>Add Teacher</h2>
      <form id="teacherForm" action="insert_teacher.php" method="post">
        <div class="form-group">
          <label for="teacherName">Name</label>
          <input type="text" id="teacherName" name="name" required>
        </div>
        <div class="form-group">
          <label for="teacherDepartment">Department</label>
          <input type="text" id="teacherDepartment" name="department" required>
        </div>
        <div class="form-group">
          <label for="teacherPhone">Phone Number</label>
          <input type="text" id="teacherPhone" name="phone" maxlength="10" pattern="\d{10}" title="Please enter a valid 10-digit phone number" required>
        </div>
        <div class="form-group">
          <label for="teacherEmail">Email</label>
          <input type="email" id="teacherEmail" name="email" required>
        </div>
        <button type="submit">Submit</button>
      </form>
    </div>
  </div>
</body>
</html>
