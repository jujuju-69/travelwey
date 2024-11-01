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
   <!-- Additional styles specific to your login page -->
   <style>
      /* Add your additional styles here */
   </style>
</head>
<body>
   <div class="login">
      <img src="../images/pic1register.jpg" alt="login image" class="login__img">

      <form action="act_login.php" method="POST" class="login__form">
         <h1 class="login__title">Login</h1>

         <div class="login__content">
               <div class="login__box">
                  <i class="ri-user-3-line login__icon"></i>

                  <div class="login__box-input">
                     <input type="username" required class="login__input" id="username" name="username" placeholder=" ">
                     <label style="color: var(--white-color)"for="login-username" class="login__label">Username</label>
                  </div>
               </div>

            <div class="login__box">
               <i class="ri-lock-2-line login__icon"></i>
               <div class="login__box-input">
                  <input type="password" required class="login__input" id="password" name="password" placeholder=" ">
                  <label style="color: var(--white-color)" for="password" class="login__label">Password</label>
                  
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
         session_start();
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

   <style>
  body {  
    background-image: url('path/to/your/background.jpg'); /* Use your background image */  
    background-size: cover;  
    background-position: center;  
    margin: 0;  
    font-family: 'Arial', sans-serif;  
}  

.login {  
    display: flex;  
    justify-content: center;  
    align-items: center;  
    min-height: 100vh;  
    padding: 20px;  
}  

.login__form {  
    background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white */  
    border-radius: 10px;  
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);  
    padding: 40px;  
    width: 100%;  
    max-width: 400px;  
}  

.login__title {  
    font-size: 1.8em;  
    color: #2c3e50;  
    text-align: center;  
    margin-bottom: 20px;  
}  

.login__box {  
    position: relative;  
    margin-bottom: 20px;  
}  

.login__icon {  
    position: absolute;  
    left: 10px;  
    top: 50%;  
    transform: translateY(-50%);  
    color: #2980b9;  
}  

.login__box-input {  
    position: relative;  
}  

.login__input {  
    width: 100%;  
    padding: 10px 10px 10px 40px;  
    border: none;  
    border-bottom: 2px solid #ccc;  
    outline: none;  
    font-size: 1em;  
    color: #2c3e50;  
    background: transparent;  
    transition: border-color 0.3s;  
}  

.login__input:focus {  
    border-color: #2980b9;  
}  

.login__label {  
    position: absolute;  
    top: 0;  
    left: 40px;  
    color: #aaa;  
    pointer-events: none;  
    transition: all 0.3s;  
    font-size: 0.9em;  
}  

.login__input:focus + .login__label,  
.login__input:not(:placeholder-shown) + .login__label {  
    top: -20px;  
    left: 10px;  
    font-size: 0.8em;  
    color: #2980b9;  
}  



.login__button {  
    width: 100%;  
    padding: 10px;  
    border: none;  
    background-color: #2980b9;  
    color: #ffffff;  
    font-size: 1em;  
    border-radius: 5px;  
    cursor: pointer;  
    transition: background-color 0.3s;  
}  

.login__button:hover {  
    background-color: #3b99d9;  
}  

.login__error {  
    color: #e74c3c;  
    font-size: 0.9em;  
    text-align: center;  
    margin-top: 10px;  
}  

.login__register {  
    text-align: center;  
    margin-top: 20px;  
    color: #2c3e50;  
}
      </style>


</body>
</html>
