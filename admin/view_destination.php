<?php
include 'db.php'; // Adjust the path as per your directory structure

// Check if ID parameter is provided in the URL
if (!isset($_GET['id'])) {
    // Redirect to list-destination.php or handle error accordingly
    header("Location: list-destination.php");
    exit();
}

$id = $_GET['id'];

// Fetch destination details from the database
$query = $conn->prepare("SELECT * FROM destinations WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();

// Check if destination exists
if ($result->num_rows > 0) {
    $destination = $result->fetch_assoc();
} else {
    // Redirect to list-destination.php or handle error accordingly
    header("Location: list-destination.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Destination</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Assuming you have a main style.css -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            color: #000; /* Set text color to black */
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 5px;
            margin-top: 20px;
            position: relative; /* Enable absolute positioning for child elements */
        }
        .back-button {
            position: absolute; /* Absolute positioning for the button */
            top: 20px; /* Distance from the top of the container */
            right: 20px; /* Distance from the right of the container */
            padding: 10px 20px;
            color: #fff;
            background-color: #3498db;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .back-button:hover {
            background-color: #2980b9;
        }
        .destination-details {
            margin-top: 20px;
        }
        .destination-details table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .destination-details th,
        .destination-details td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .destination-details th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>View Destination</h2>
        <a href="list-destination.php" class="back-button">Back to List</a>

        <div class="destination-details">
            <table>
                <tr>
                    <th>Attribute</th>
                    <th>Details</th>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><?php echo isset($destination['name']) ? htmlspecialchars($destination['name']) : 'Name not available'; ?></td>
                </tr>
                <tr>
                    <td>Location</td>
                    <td><?php echo isset($destination['location']) ? htmlspecialchars($destination['location']) : 'Location not available'; ?></td>
                </tr>
                <tr>
                    <td>Image URL</td>
                    <td>    
                        <?php if (!empty($destination['image']) && file_exists($destination['image'])): ?>
                            <img src="<?php echo $destination['image']; ?>" alt="Current Image" style="max-width: 100px; margin-top: 10px;">
                        <?php else: ?>
                            <p>No image uploaded yet.</p>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><?php echo isset($destination['description']) ? htmlspecialchars($destination['description']) : 'Description not available'; ?></td>
                </tr>
                <tr>
                    <td>Highlights</td>
                    <td><?php echo isset($destination['highlights']) ? htmlspecialchars($destination['highlights']) : 'Highlights not available'; ?></td>
                </tr>
                <tr>
                    <td>Itinerary</td>
                    <td><?php echo isset($destination['itinerary']) ? htmlspecialchars($destination['itinerary']) : 'Itinerary not available'; ?></td>
                </tr>
                <tr>
                    <td>Included</td>
                    <td><?php echo isset($destination['included']) ? htmlspecialchars($destination['included']) : 'Included details not available'; ?></td>
                </tr>
                <tr>
                    <td>Excluded</td>
                    <td><?php echo isset($destination['excluded']) ? htmlspecialchars($destination['excluded']) : 'Excluded details not available'; ?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><?php echo isset($destination['address']) ? htmlspecialchars($destination['address']) : 'Address not available'; ?></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
