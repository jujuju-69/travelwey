<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wanderlust";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function trackDestinationClick($destinationName) {
    global $conn;

    // Insert a record into individual_clicks for tracking
    $stmt = $conn->prepare("INSERT INTO individual_clicks (destination_name) VALUES (?)");
    $stmt->bind_param("s", $destinationName);
    $stmt->execute();
    $stmt->close();

    // Update the click count in destination_clicks
    $stmt = $conn->prepare("INSERT INTO destination_clicks (destination_name, click_count) VALUES (?, 1)
                             ON DUPLICATE KEY UPDATE click_count = click_count + 1");
    $stmt->bind_param("s", $destinationName);
    $stmt->execute();
    $stmt->close();
}

?>
