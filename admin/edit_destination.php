<?php
include 'db.php';
include 'add_edit_style.php';

$id = $_GET['id'];
$query = $conn->prepare("SELECT * FROM destinations WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$destination = $query->get_result()->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $highlights = $_POST['highlights'];
    $itinerary = $_POST['itinerary'];
    $included = $_POST['included'];
    $excluded = $_POST['excluded'];
    $address = $_POST['address'];

    // Handle file upload if a new image is selected
    $uploadOk = 1;
    $target_file = null;
    $image = $destination['image']; // Default to existing image

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 5000000) { // 5MB limit
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
                $image = $target_file; // Update image path
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    $query = $conn->prepare("UPDATE destinations SET name=?, location=?, image=?, description=?, highlights=?, itinerary=?, included=?, excluded=?, address=? WHERE id=?");
    $query->bind_param("sssssssssi", $name, $location, $image, $description, $highlights, $itinerary, $included, $excluded, $address, $id);
    $query->execute();

    header("Location: list-destination.php");
    exit(); // Ensure no further code execution after redirect
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>WonderLust Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">

<style>
 /* General Reset and Styling */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f7f6;
    color: #333;
}

h2 {
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

h4 {
    color: black; /* Set text color to black */
}

.sidebar {
    background: linear-gradient(to bottom, #ffffff, #e1bee7); /* White to light purple gradient */
    width: 180px; /* Reduced width for sidebar */
    position: fixed; /* Keep it fixed on the side */
    height: 100%; /* Full height */
    transition: width 0.3s; /* Smooth transition for width changes */
    overflow-y: auto; /* Allow vertical scrolling if necessary */
}

.sidebar .side-menu ul li a {
    color: #000000; /* Black text color */
    padding: 10px 15px; /* Padding for links */
    display: flex; /* Use flexbox for alignment */
    align-items: center; /* Center align vertically */
}

.sidebar .side-menu ul li a.active {
    background-color: #d5006d; /* Darker pink for active item */
    color: #ffffff; /* White text for active item */
}

.main-content {
    margin-left: 180px; /* Adjusted to match sidebar width */
    padding: 20px; /* Add some padding */
    max-width: calc(100% - 180px); /* Ensure the main content does not exceed viewport */
    box-sizing: border-box; /* Include padding in width calculation */
}

/* Add responsive adjustments */
@media (max-width: 768px) {
    .sidebar {
        width: 100px; /* Collapse sidebar on smaller screens */
    }
    
    .main-content {
        margin-left: 100px; /* Adjust margin for smaller sidebar */
    }

    .card {
        margin: 10px; /* Reduce margin on smaller screens */
    }
}

/* Ensure tables and large content are responsive */
.records.table-responsive,
.analytics.table-responsive {
    width: 100%;
    overflow-x: auto; /* Horizontal scroll on tables only if needed */
}

/* Page header and content adjustments */
.page-header, .page-content {
    padding: 20px;
    width: 100%; /* Full width of available space */
    box-sizing: border-box;
}

.page-content {
    background-color: #ffffff; /* White background color */
    padding: 10px;
    margin-left: 10px; /* Optional: add some padding for better spacing */
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Optional: add subtle shadow for depth */
    border-radius: 8px; /* Optional: add rounded corners */
}

.page-header {
  background-color: #ffffff; /* Change the background color to #deeafa */
  color: black; /* Adjust text color for contrast */
  padding-left: 16px; /* Padding for better spacing */
  
}
/* Main container */
.container {
    max-width: 600px;
    margin: 30px auto;
    background: #ffffff;
    padding: 20px;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

form label {
    display: block;
    font-weight: bold;
    margin: 15px 0 5px;
    color: #555;
}

form input[type="text"],
form input[type="file"],
form textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

form textarea {
    resize: vertical;
    min-height: 100px;
}

form button[type="submit"],
.back-button {
    display: inline-block;
    padding: 10px 20px;
    color: #fff;
    background-color: #007BFF;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    font-size: 16px;
    margin: 10px 0;
}

form button[type="submit"]:hover,
.back-button:hover {
    background-color: #0056b3;
}

.back-button {
    background-color: #6c757d;
    margin-bottom: 20px;
}

.back-button:hover {
    background-color: #5a6268;
}

/* Responsive Design */
@media (max-width: 600px) {
    .container {
        padding: 15px;
    }

    h2 {
        font-size: 24px;
    }

    form button[type="submit"],
    .back-button {
        font-size: 14px;
        padding: 8px 15px;
    }
}
</style>
</head>

<body>
    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-content">
            <div class="profile">
                <div class="profile-img bg-img" style="background-image: url(img/TravelWey-logo.jpeg)"></div>
                <h4>Admin Page</h4>
                <small>TravelWey</small>
            </div>

            <div class="side-menu">
                <ul>
                    <li>
                        <a href="" >
                            <span class="las la-home"></span>
                            <small>Dashboard</small>
                        </a>
                    </li>
                    <li>
                        <a href="list-destination.php" class="active">
                            <span class="las la-map-marked"></span>
                            <small>Destination</small>
                        </a>
                    </li>
                    <li>
                        <a href="list-hotel.php">
                            <span class="las la-hotel"></span>
                            <small>Hotel</small>
                        </a>
                    </li>

                    <li>
                        <a href="list-room.php">
                            <span class="las la-door-open"></span>
                            <small>Rooms</small>
                        </a>
                    </li>

                    <li>
                        <a href="list-data.php">
                            <span class="las la-chart-bar"></span>
                            <small>Analysis</small>
                        </a>
                    </li>

                    <li>
                        <a href="logout-admin.php">
                            <span class="las la-sign-out-alt"></span>
                            <small>Log Out</small>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="main-content">
        <main>



<body>
<div class="page-header">
                <h1>Edit Destination</h1>
            </div>

    <div class="container">
        <form method="POST" action="edit_destination.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo $destination['name']; ?>" required>

            <label for="location">Location</label>
            <input type="text" id="location" name="location" value="<?php echo $destination['location']; ?>" required>

            <!-- Input field to select image -->
            <label for="image">Choose Image</label>
            <input type="file" id="image" name="image">
            <?php if (!empty($destination['image']) && file_exists($destination['image'])): ?>
                <img src="<?php echo $destination['image']; ?>" alt="Current Image" style="max-width: 100px; margin-top: 10px;">
            <?php else: ?>
                <p>No image uploaded yet.</p>
            <?php endif; ?>

            <label for="description">Description</label>
            <textarea id="description" name="description" required><?php echo $destination['description']; ?></textarea>

            <label for="highlights">Highlights</label>
            <textarea id="highlights" name="highlights" required><?php echo $destination['highlights']; ?></textarea>

            <label for="itinerary">Itinerary</label>
            <textarea id="itinerary" name="itinerary" required><?php echo $destination['itinerary']; ?></textarea>

            <label for="included">Included</label>
            <textarea id="included" name="included" required><?php echo $destination['included']; ?></textarea>

            <label for="excluded">Excluded</label>
            <textarea id="excluded" name="excluded" required><?php echo $destination['excluded']; ?></textarea>

            <label for="address">Address</label>
            <textarea id="address" name="address" required><?php echo $destination['address']; ?></textarea>

            <button type="submit">Update Destination</button>
        </form>
    </div>
</body>
</html>
        </main>
        <script>
        // JavaScript functions to control the popup
        function openPopup(popupId) {
            document.getElementById(popupId).style.display = "block";
        }

        function closePopup(popupId) {
            document.getElementById(popupId).style.display = "none";
        }
    </script>
    </div>
</body>
</html>

<?php
// Close MySQL connection
$conn->close();
?>