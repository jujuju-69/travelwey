<?php
$title = 'Hotel Booking Form';
ob_start();
session_start();
include 'header.php';
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $price_per_night = $_POST['price_per_night'];
    $room_name = $_POST['room_name'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $special_requests = $_POST['special_requests'];
    $user_id = $_SESSION['user_id']; // Assuming the user is logged in

    // Insert the booking into the database
    $sql = "INSERT INTO booking (user_id, first_name, last_name, email, phone, check_in, check_out, total_room, special_requests, status) 
            VALUES ('$user_id', '$first_name', '$last_name', '$email', '$phone', '$check_in', '$check_out', '1', '$special_requests', 'Pending')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the booking list page after successful booking
        header("Location: booking-list.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/profile.css">
</head>

<style>
/* Profile CSS (profile.css) */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f9fa;
}

.hero-wrap {
    position: relative;
    height: 50vh;
    background-size: cover;
    background-position: center center;
    background-attachment: fixed;
}

.hero-wrap h1 {
    color: #fff;
    font-size: 48px;
    font-weight: bold;
}

#booking .container {
    margin-top: 50px;
}

.room-details img {
    border-radius: 10px;
    width: 100%;
    height: auto;
    max-height: 400px;
    object-fit: cover;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
}

.room-details h4 {
    font-size: 24px;
    font-weight: bold;
    color: #333;
    margin-top: 15px;
}

.room-details p {
    font-size: 18px;
    color: #555;
}

.room-details p strong {
    color: #000;
}

.form-container {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    padding: 30px;
}

.form-container h2 {
    font-size: 28px;
    color: #333;
    margin-bottom: 20px;
    text-align: center;
    font-weight: bold;
}

.form-container label {
    font-size: 16px;
    color: #555;
    margin-bottom: 5px;
}

.form-container input, 
.form-container select, 
.form-container textarea {
    border-radius: 5px;
    border: 1px solid #ced4da;
    padding: 10px;
    font-size: 16px;
    width: 100%;
    margin-bottom: 20px;
}

.form-container button {
    background-color: #007bff;
    border: none;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    width: 100%;
}

.form-container button:hover {
    background-color: #0056b3;
}

@media (max-width: 768px) {
    #booking .row {
        display: block;
    }

    .room-details {
        margin-bottom: 30px;
    }

    .form-container {
        padding: 20px;
    }
}

</style>


<body>
    <?php include 'header.php'; ?>

    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_1.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate pb-5 text-center">
                    <h1 class="mb-0 bread">Hotel Booking</h1>
                </div>
            </div>
        </div>
    </section>

    <section id="booking" class="ftco-section">
        <div class="container">
            <div class="row">
                <!-- Left side: Room details -->
               <!-- <div class="col-md-6">
                    <div class="room-details">
                        <img src="<?php echo $image; ?>" alt="<?php echo $room_name; ?>" class="img-fluid mb-3">
                        <h4><?php echo $room_name; ?></h4>
                        <p><strong>Price per night: </strong>$<?php echo $price_per_night; ?></p>
                    </div>
                </div> -->

                <!-- Right side: Booking form -->
                <div class="col-md-6">
                    <h2>Hotel Booking Form</h2>
                    <form action="booking.php" method="POST">
                        <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
                        <input type="hidden" name="price_per_night" value="<?php echo $price_per_night; ?>">
                        <input type="hidden" name="room_name" value="<?php echo $room_name; ?>">
                        <input type="hidden" name="image" value="<?php echo $image; ?>">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="first_name">First Name:</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last_name">Last Name:</label>
                                <input type="text" id="last_name" name="last_name" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone">Phone Number:</label>
                                <input type="tel" id="phone" name="phone" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="check_in">Check-in Date:</label>
                                <input type="date" id="check_in" name="check_in" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="check_out">Check-out Date:</label>
                                <input type="date" id="check_out" name="check_out" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="special_requests">Special Requests:</label>
                            <textarea id="special_requests" name="special_requests" class="form-control" rows="4"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Book Now</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>
</body>
</html>
