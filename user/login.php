<?php
session_start();
include 'db.php'; // Make sure this includes your database connection

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Query to check the user's credentials
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id']; // Store user ID in session
        header("Location: booking-list.php"); // Redirect to booking list page
        exit();
    } else {
        $_SESSION['login_error'] = "Invalid username or password.";
        header("Location: login.php"); // Redirect back to login page
        exit();
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login User</title>

   <!-- Include your CSS files -->
   <link rel="stylesheet" href="../admin/css/style.css">
   <!-- Include Remixicon for icons -->
   <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>
   <div class="login">
      <img src="../images/pic1register.jpg" alt="login image" class="login__img">

      <form action="login.php" method="POST" class="login__form"> <!-- Changed action to 'login.php' -->
         <h1 class="login__title">Login</h1>

         <div class="login__content">
            <div class="login__box">
               <i class="ri-user-3-line login__icon"></i>
               <div class="login__box-input">
                  <input type="text" required class="login__input" id="username" name="username" placeholder=" ">
                  <label for="username" class="login__label">Username</label>
               </div>
            </div>

            <div class="login__box">
               <i class="ri-lock-2-line login__icon"></i>
               <div class="login__box-input">
                  <input type="password" required class="login__input" id="password" name="password" placeholder=" ">
                  <label for="password" class="login__label">Password</label>
                  <i class="ri-eye-off-line login__eye" id="login-eye"></i>
               </div>
            </div>
         </div>

         <div class="login__check">
            <p class="login__register">
               Don't have an account? <a href="register-user.php">Register</a>
            </p>
         </div>

         <button type="submit" class="login__button">Login</button>

         <?php
         // Display login error if it exists
         if (isset($_SESSION['login_error'])) {
            echo '<p class="login__error">' . $_SESSION['login_error'] . '</p>';
            unset($_SESSION['login_error']); // Clear the error message after displaying
         }
         ?>

         <p class="login__register">
            Are you admin? <a href="../admin/login-admin.php">Login</a>
         </p>
      </form>
   </div>
</body>
</html>
