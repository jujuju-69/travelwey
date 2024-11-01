<?php
include 'db.php';

// Check if room ID is provided
if (isset($_GET['id'])) {
    $roomId = $_GET['id'];
    
    // Prepare SQL statement to delete the room from hoteldetails
    $sqlDetails = "DELETE FROM hoteldetails WHERE id = $roomId";
    
    // Execute the query to delete the room
    if ($conn->query($sqlDetails) === TRUE) {
        // Redirect back to room list page after successful deletion
        header("Location: list-room.php");
        exit();
    } else {
        echo "Error deleting room: " . $conn->error;
    }
} else {
    echo "Room ID not provided";
}

// Close the database connection
$conn->close();
?>
