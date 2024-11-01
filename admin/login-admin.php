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
   $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
   $result = $conn->query($sql);

   if ($result->num_rows == 1) {
      // Successful login
      $_SESSION['username'] = $username; // Store username in session
      header("Location: index-admin.php"); // Redirect to dashboard or any other page
   } else {
      // Invalid login
      $_SESSION['login_error'] = "Invalid username or password";
      header("Location: login-user.php"); // Redirect back to login page
   }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="css/styles.css">

    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <title>Login Form Responsive</title>
    
    <style>
/*===== GOOGLE FONTS =====*/
@import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap");

/*===== VARIABLES CSS =====*/
:root {
    --primary-color: #007bff; /* A shade of blue */
    --secondary-color: #6c757d; /* A gray shade */
    --background-image: url('img/background-login.png');
    --form-background-color: #f8f9fa; /* Light gray for the form background */
    --text-color: #212529; /* Dark text color */
    --body-font: 'Roboto', sans-serif;
}

/*===== BASE =====*/
*, ::before, ::after {
    box-sizing: border-box;
}
body {
    margin: 0;
    padding: 0;
    font-family: var(--body-font);
    background-image: url('img/background-login.png');
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/*===== FORM =====*/
.l-form {
    position: relative;
    width: 100%;
    max-width: 400px; /* Limit the width of the form */
    background-color: white;
    border-radius: 10px; /* Rounded corners */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Box shadow for depth */
    padding: 2rem; /* Padding around the form */
}

.form__title {
    font-size: 2rem;
    font-weight: 500;
    margin-bottom: 1.5rem;
    color: var(--text-color);
    text-align: center;
}

/*=== Input Styles ===*/
.form__div {
    margin-bottom: 1.5rem;
    position: relative;
}

.form__icon {
    position: absolute;
    top: 50%;
    left: 10px;
    transform: translateY(-50%);
    color: var(--secondary-color);
}

.form__input {
    width: 100%;
    padding: 12px 40px; /* Add padding for the icon */
    border: 1px solid var(--secondary-color);
    border-radius: 5px;
    font-size: 1rem;
    color: var(--text-color);
    transition: border 0.3s;
}

.form__input:focus {
    border-color: var(--primary-color); /* Change border color on focus */
    outline: none; /* Remove default outline */
}

/*=== Button Styles ===*/
.form__button {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 5px;
    background-color: var(--primary-color);
    color: white;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s;
}

.form__button:hover {
    background-color: #0056b3; /* Darken on hover */
}

/*=== Responsive Styles ===*/
@media (max-width: 400px) {
    .l-form {
        width: 90%; /* Full width for smaller screens */
    }
}
.form__img {
    width: 200px; /* Adjust width as needed */
    height: 200px; /* Adjust height to match width for a perfect circle */
    border-radius: 50%; /* Make the image circular */
    object-fit: cover; /* Ensure the image covers the entire area without distortion */
    display: block; /* Center the image within the container */
    margin: 0 auto 1rem; /* Center image and add space below */
}

    </style>
</head>
<body>
    <div class="l-form">
        <div class="shape1"></div>
        <div class="shape2"></div>

        <div class="form">
            <img src="img/TravelWey-logo.jpeg" alt="" class="form__img">

            <form action="login-admin.php" method="POST" class="form__content">
                <h1 class="form__title">Welcome</h1>

                <div class="form__div form__div-one">
                    <div class="form__icon">
                        <i class='bx bx-user-circle'></i>
                    </div>

                    <div class="form__div-input">
                        <label for="username" class="form__label"></label>
                        <input type="text" placeholder="Username" id="username" name="username" class="form__input">
                    </div>
                </div>

                <div class="form__div">
                    <div class="form__icon">
                        <i class='bx bx-lock'></i>
                    </div>

                    <div class="form__div-input">
                        <label for="password" class="form__label"></label>
                        <input type="password" placeholder="Password" id="password" name="password" class="form__input">
                    </div>
                </div>

                <input type="submit" class="form__button" value="Login">
            </form>
        </div>
    </div>
</body>
</html>
