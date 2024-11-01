<?php
session_start();

$title = 'Hotel';
include 'header.php';
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login-user.php"); // Redirect to login if not logged in
    exit();
}

// Create connection
$conn = new mysqli('localhost', 'root', '', 'wanderlust');

// Fetch the logged-in user's information
$userId = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <?php
        include 'header.php';
    ?>

    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_1.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate pb-5 text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index-user.php">Home <i class="fa fa-chevron-right"></i></a></span> <span>Profile <i class="fa fa-chevron-right"></i></span></p>
                    <h1 class="mb-0 bread">Profile</h1>
                </div>
            </div>
        </div>
    </section>

    <section id="section-page1" class="ftco-section">
        <div class="container">
            <h2 class="text-center">User Profile</h2>
            <form>
                <div class="form-group profile-image">
                    <img src="images/gokuhead.jpg" alt="Profile Image" id="profileImage">
                   </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" id="firstName" value="<?php echo htmlspecialchars($user['full_name']); ?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
                    </div>
                </div>
                <div class="form-row">
               
                    <div class="form-group col-md-6">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" value="<?php echo htmlspecialchars($user['password']); ?>" readonly>
                </div>
                <div class="btn-row">
                    <button type="submit" class="btn btn-primary btn-delete">Update Profile</button>
                    <button type="button" class="btn btn-danger btn-delete">Delete</button>
                </div>
            </form>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script>
        function loadFile(event) {
            var image = document.getElementById('profileImage');
            image.src = URL.createObjectURL(event.target.files[0]);
            image.onload = function() {
                URL.revokeObjectURL(image.src) // free memory
            }
        }
    </script>
</body>
</html>
