<?php
session_start();

// Database connection and credentials (replace with your actual database details)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wanderlust";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $username = $_POST['username'];
   $password = $_POST['password'];

   // SQL query to check if the username and password match
   $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
   $result = $conn->query($sql);

   if ($result->num_rows == 1) {
      // Successful login
      $user = $result->fetch_assoc(); // Fetch user data
      $_SESSION['username'] = $user['username']; // Store username in session
      $_SESSION['user_id'] = $user['id']; // Store user_id in session
      header("Location: ../user/index-user.php"); // Redirect to dashboard or any other page
  } else {
      // Invalid login
      $_SESSION['login_error'] = "Invalid username or password";
      header("Location: login-user.php"); // Redirect back to login page
  }
  
}

$conn->close();
?>
