<?php
session_start();

$valid_user = "admin";
$valid_pass = "password123";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $valid_user && $password === $valid_pass) {
        $_SESSION['loggedin'] = true;
        header("Location: home.php");
        exit;
    } else {
        $error = "Invalid credentials!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login - V3N0M'S Cloud</title>
<style>
body {
  font-family: "Segoe UI", sans-serif;
  background-color: #121212;
  color: #e0e0e0;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}
.container {
  background: #1f1f1f;
  padding: 30px;
  border-radius: 12px;
  box-shadow: 0 0 15px rgba(0,0,0,0.6);
  width: 320px;
  text-align: center;
}
input[type="text"], input[type="password"] {
  width: 90%;
  padding: 10px;
  margin: 8px 0;
  border: none;
  border-radius: 5px;
  background: #333;
  color: #fff;
}
input[type="submit"] {
  background-color: #0d6efd;
  color: white;
  border: none;
  padding: 10px 20px;
  margin-top: 10px;
  border-radius: 5px;
  cursor: pointer;
  width: 100%;
}
input[type="submit"]:hover {
  background-color: #0b5ed7;
}
.error {
  color: #ff6b6b;
  margin-bottom: 10px;
}
h2 {
  margin-bottom: 15px;
}
</style>
</head>
<body>
  <div class="container">
    <h2>🔐 V3N0M'S Cloud</h2>
    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <input type="submit" value="Login">
    </form>
  </div>
</body>
</html>

