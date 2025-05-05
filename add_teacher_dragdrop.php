<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Drag and Drop Resume Upload</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f7f9;
    }
    .container {
      max-width: 600px;
      margin: 50px auto;
      text-align: center;
    }
    .drop-zone {
      border: 2px dashed #007bff;
      padding: 50px;
      border-radius: 8px;
      background-color: white;
      cursor: pointer;
    }
    .drop-zone:hover {
      background-color: #f0f8ff;
    }
    .drop-zone p {
      color: #007bff;
      font-size: 18px;
    }
    .upload-btn {
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .upload-btn:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Upload Teacher Resumes</h1>
    <div class="drop-zone" id="dropZone">
      <p>Drag & Drop Resume Here</p>
      <p>or</p>
      <input type="file" id="fileInput" accept=".pdf, .docx" style="display: none;">
      <button class="upload-btn" id="uploadButton">Browse Files</button>
    </div>
    <div id="uploadStatus"></div>
  </div>

  <script>
    const dropZone = document.getElementById("dropZone");
    const fileInput = document.getElementById("fileInput");
    const uploadButton = document.getElementById("uploadButton");

    dropZone.addEventListener("click", () => fileInput.click());
    dropZone.addEventListener("dragover", (e) => {
      e.preventDefault();
      dropZone.style.backgroundColor = "#f0f8ff";
    });
    dropZone.addEventListener("dragleave", () => {
      dropZone.style.backgroundColor = "white";
    });
    dropZone.addEventListener("drop", (e) => {
      e.preventDefault();
      dropZone.style.backgroundColor = "white";
      const file = e.dataTransfer.files[0];
      uploadFile(file);
    });
    uploadButton.addEventListener("click", () => fileInput.click());
    fileInput.addEventListener("change", () => {
      const file = fileInput.files[0];
      uploadFile(file);
    });

    function uploadFile(file) {
      const formData = new FormData();
      formData.append("resume", file);

      fetch("process_resume.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.text())
        .then((data) => {
          document.getElementById("uploadStatus").innerHTML = data;
        })
        .catch((error) => {
          document.getElementById("uploadStatus").innerHTML = "Error uploading file.";
        });
    }
  </script>
</body>
</html>
