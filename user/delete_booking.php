
<?php
include 'db.php'; // Adjust this path as per your actual file structure

// Check if ID parameter is passed via POST method
if(isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare and execute delete query
    $query = $conn->prepare("DELETE FROM booking WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();

    // Redirect back to booking list page after deletion
    header("Location: booking-list.php");
    exit(); // Ensure script execution stops after redirection
} else {
    // Handle case where ID parameter is not provided
    echo "Error: No ID provided for deletion.";
}
?>