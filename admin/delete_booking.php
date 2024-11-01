<?php


include 'db.php';

$id = $_GET['id'];
$query = $conn->prepare("DELETE FROM booking WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();

header("Location: list-hotel.php");
?>