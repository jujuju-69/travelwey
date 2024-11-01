// delete_destination.php
<?php


include 'db.php';

$id = $_GET['id'];
$query = $conn->prepare("DELETE FROM destinations WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();

header("Location: list-destination.php");
?>