<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Database connection
$conn = new mysqli('localhost', 'root', '', 'wanderlust');

// Check for POST request to handle booking status updates
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_id = $_POST['id'];
    $status = $_POST['status'];

    // Update booking status in the database
    $stmt = $conn->prepare("UPDATE booking SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $booking_id);
    $stmt->execute();

    // Fetch the booking details to get the email address
    $result = $conn->query("SELECT * FROM booking WHERE id = $booking_id");
    $row = $result->fetch_assoc();

    // If the booking is accepted, send an email
    if ($status == 'Accepted') {
        $email = $row['email'];
        $subject = "Booking Confirmation";
        $message = "Congrats! Your booking is accepted. Please show this email at the counter for verification.";

        // Send email using PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sufifree123@gmail.com'; // Update with your email
            $mail->Password = 'ztohatgqcewqbxlq'; // Update with your email password or app password
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('sufifree123@gmail.com'); // Update with your email
            $mail->addAddress($email); // Recipient's email from the booking

            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->send();
            echo "<script>alert('Email Sent: Booking Accepted');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Email could not be sent. Error: {$mail->ErrorInfo}');</script>";
        }
    }

    // Redirect back to the booking list
    echo "<script>document.location.href = 'booking-list-admin.php';</script>";
}
?>
