<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Database connection
$conn = new mysqli('localhost', 'root', '', 'wanderlust');

// Check for POST request to handle booking status updates

// Fetch all bookings from the database
$result = $conn->query("SELECT * FROM booking");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>WonderLust About</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/booking.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body>
    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-content">
            <div class="profile">
                <div class="profile-img bg-img" style="background-image: url(img/WanderLust-Logo.png)"></div>
                <h4>Admin NWDL</h4>
                <small>N.WanderLust</small>
            </div>

            <div class="side-menu">
                <ul>
                    <li>
                       <a href="index-admin.php" >
                            <span class="las la-home"></span>
                            <small>Dashboard</small>
                        </a>
                    </li>
                    <li>
                       <a href="list-destination.php">
                            <span class="las la-map-marked"></span> 
                            <small>Destination</small>
                        </a>
                    </li>
                    <li>
                       <a href="List-hotel.php"class="active">
                            <span class="las la-hotel"></span>
                            <small>Hotel</small>
                        </a>
                    </li>
                    <li>
                       <a href="logout-admin.php">
                            <span class="las la-sign-out-alt"></span>
                            <small>Log Out</small>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main-content">
        <main>
            
            <div class="page-header">
                <h1>Booking List</h1>
                <small>WanderLust</small>
            </div>
             <div class="page-content">

                <div class="records table-responsive">

                    <div>
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th><span class="las la-sort"></span> FIRST NAME</th>
                                    <th><span class="las la-sort"></span> PHONE NUMBER</th>
                                    <th><span class="las la-sort"></span> EMAIL</th>
                                    <th><span class="las la-sort"></span> CHECK-IN DATE</th>
                                    <th><span class="las la-sort"></span> CHECK-OUT DATE</th>
                                    <th><span class="las la-sort"></span> SPECIAL REQUEST</th>
                                    <th><span class="las la-sort"></span> STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
<?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td>
            <div class="client">
                <div class="client-info">
                    <h4><?php echo $row['first_name']; ?></h4>
                    <small><?php echo $row['last_name']; ?></small>
                </div>
            </div>
        </td>
        <td><?php echo $row['phone']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['check_in']; ?></td>
        <td><?php echo $row['check_out']; ?></td>
        <td><?php echo $row['special_requests']; ?></td>
        <td>
            <?php if ($row['status'] == 'Accepted' || $row['status'] == 'Rejected'): ?>
                <span style="color: <?php echo ($row['status'] == 'Accepted') ? 'green' : 'red'; ?>;">
                    <?php echo $row['status']; ?>
                </span>
            <?php else: ?>
                <form action="update_booking_status.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="status" value="Accepted" style="color: green;">Accept</button>
                    <button type="submit" name="status" value="Rejected" style="color: red;">Reject</button>
                </form>
            <?php endif; ?>
        </td>
    </tr>
<?php endwhile; ?>
</tbody>
                        </table>
                    </div>
                </div>
            </div>  
        </main>

        <script>
            // JavaScript functions to control the popup
            function openPopup(popupId) {
                document.getElementById(popupId).style.display = "block";
            }

            function closePopup(popupId) {
                document.getElementById(popupId).style.display = "none";
            }
        </script>

        
    </div>
</body>
</html>

