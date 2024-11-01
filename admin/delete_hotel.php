<?php
include 'db.php';

// Check if hotel ID is provided
if (isset($_GET['id'])) {
    $hotelId = $_GET['id'];
    
    // Prepare SQL statement to delete related rows in hoteldetails
    $sqlDetails = "DELETE FROM hoteldetails WHERE hotel_id = $hotelId";
    
    // Execute the query to delete related rows
    if ($conn->query($sqlDetails) === TRUE) {
        // Prepare SQL statement to delete hotel
        $sqlHotel = "DELETE FROM hotels WHERE id = $hotelId";
        
        // Execute the query to delete the hotel
        if ($conn->query($sqlHotel) === TRUE) {
            // Redirect back to hotel list page after successful deletion
            header("Location: list-hotel.php");
            exit();
        } else {
            echo "Error deleting hotel: " . $conn->error;
        }
    } else {
        echo "Error deleting related hotel details: " . $conn->error;
    }
} else {
    echo "Hotel ID not provided";
}
?>
