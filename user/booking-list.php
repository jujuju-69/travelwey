<?php
session_start();
ob_start(); // Start output buffering

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Rest of your booking-list.php code follows...


$servername = "localhost"; 
$username = "root";     
$password = "";     
$dbname = "wanderlust";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM booking WHERE user_id = $user_id"; // Fetch only the user's bookings
$result = $conn->query($sql);

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Booking Record</title>
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <style>
        .hidden-column {
            display: none;
        }
    </style>
</head>
<body>
    <?php
        $title = 'Destination';
        include 'header.php';
    ?>

    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_1.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate pb-5 text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index-user.php">Home <i class="fa fa-chevron-right"></i></a></span> <span>Booking <i class="fa fa-chevron-right"></i></span></p>
                    <h1 class="mb-0 bread">Booking Record</h1>
                </div>
            </div>
        </div>
    </section>

    <section id="booking-list" class="ftco-section">
      <div class="records">
        <h2>Booking Records</h2>
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Check-in Date</th>
                    <th>Check-out Date</th>
                    <th>Total Room</th>
                    <th>Special Request</th>
                    <th>Status</th>
                    <th class="hidden-column">ID</th> <!-- Hidden column for ID -->
                </tr>
            </thead>
            <tbody>
    <?php
    // Loop through each row fetched from the database
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
    ?>
            <tr>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['check_in']; ?></td>
                <td><?php echo $row['check_out']; ?></td>
                <td><?php echo $row['total_room']; ?></td>
                <td><?php echo $row['special_requests']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td class="hidden-column"><?php echo $row['id']; ?></td> <!-- Hidden column for ID -->
            </tr>
    <?php
        }
    } else {
        echo "<tr><td colspan='9'>No bookings found</td></tr>";
    }
    ?>
</tbody>
        </table>
    </div>
    </section>

    <?php include 'footer.php'; ?>

    <script>
        var currentPage = 1; // Track current page

        function showPage(page) {
            if (page === 'page1') {
                document.getElementById('section-page1').style.display = 'block';
                document.getElementById('section-page2').style.display = 'none';
                currentPage = 1;
            } else if (page === 'page2') {
                document.getElementById('section-page1').style.display = 'none';
                document.getElementById('section-page2').style.display = 'block';
                currentPage = 2;
            }
        }

        function navigatePage(direction) {
            if (direction === -1 && currentPage > 1) {
                showPage('page' + (currentPage - 1));
            } else if (direction === 1 && currentPage < 2) {
                showPage('page' + (currentPage + 1));
            }
        }

        function loadFile(event) {
            var image = document.getElementById('profileImage');
            image.src = URL.createObjectURL(event.target.files[0]);
            image.onload = function() {
                URL.revokeObjectURL(image.src) // free memory
            }
        }
    </script>

    <script>
        function openPopup(popupId) {
            document.getElementById(popupId).style.display = 'block';
        }

        function closePopup(popupId) {
            document.getElementById(popupId).style.display = 'none';
        }
    </script>

</body>
</html>
