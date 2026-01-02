<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $msg = "✅ File uploaded successfully!";
    } else {
        $msg = "❌ File upload failed!";
    }
}

// Handle file download
if (isset($_GET['download'])) {
    $file = "uploads/" . basename($_GET['download']);
    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        readfile($file);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Cloud Dashboard</title>
<style>
body {
  font-family: "Segoe UI", sans-serif;
  background-color: #121212;
  color: #e0e0e0;
  margin: 0;
  padding: 0;
}
.header {
  background: #1f1f1f;
  padding: 15px 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.header h2 {
  margin: 0;
}
.header a {
  color: #ff6b6b;
  text-decoration: none;
}
.container {
  max-width: 800px;
  margin: 40px auto;
  background: #1e1e1e;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 15px rgba(0,0,0,0.5);
}
form {
  margin-bottom: 25px;
}
input[type="file"] {
  background: #2c2c2c;
  color: #ccc;
  border: none;
  padding: 8px;
  border-radius: 5px;
}
input[type="submit"] {
  background-color: #0d6efd;
  color: white;
  border: none;
  padding: 10px 15px;
  margin-left: 10px;
  border-radius: 5px;
  cursor: pointer;
}
input[type="submit"]:hover {
  background-color: #0b5ed7;
}
ul {
  list-style: none;
  padding: 0;
}
li {
  padding: 8px;
  background: #252525;
  border-radius: 5px;
  margin-bottom: 8px;
}
li a {
  color: #0d6efd;
  text-decoration: none;
}
li a:hover {
  text-decoration: underline;
}
.message {
  margin-bottom: 15px;
  color: #90ee90;
}
</style>
</head>
<body>
  <div class="header">
    <h2>☁️ V3N0M Cloud</h2>
    <a href="logout.php">Logout</a>
  </div>
  <div class="container">
    <?php if (!empty($msg)) echo "<div class='message'>$msg</div>"; ?>
    <h3>📤 Upload File</h3>
    <form method="POST" enctype="multipart/form-data">
      <input type="file" name="file" required>
      <input type="submit" value="Upload">
    </form>

    <h3>📂 Your Files</h3>
    <ul>
      <?php
      $files = scandir("uploads");
      foreach ($files as $file) {
          if ($file != "." && $file != "..") {
              echo "<li>📄 <a href='home.php?download=$file'>$file</a></li>";
          }
      }
      ?>
    </ul>
  </div>
</body>
</html>

