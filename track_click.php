
<?php
include 'db.php'; // Include your database connection

if (isset($_GET['destination'])) {
    $destination = $_GET['destination'];
    trackDestinationClick($destination);
    echo json_encode(["status" => "success", "message" => "Click tracked"]);
} else {
    echo json_encode(["status" => "error", "message" => "No destination specified"]);
}
?>
