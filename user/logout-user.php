<?php
session_start();

if(isset($_SESSION['id'])){

$_SESSION=array();
session_destroy();
}

echo"<link rel='stylesheet' type='text/css' href='css/stylesheet.css'>";
echo"<br>";
echo"<p style='text-align:center'>you have successfully logged out. Thank You</p>";
echo"<p style='text-align:center;'>Log Out ...</p>";
echo"<meta http-equiv=\"refresh\" content=\"2; URL=../index.php\">";
?>
