<?php
include 'db.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch list of hotels
$hotelsQuery = "SELECT id, name FROM hotels"; 
$result = $conn->query($hotelsQuery);

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle file upload for rooms
    $target_dir_hotel = "images/";  // Specify the directory for hotel files
    $target_file_hotel = $target_dir_hotel . basename($_FILES["image-file"]["name"]);
    $uploadOk_hotel = 1;
    $imageFileType_hotel = strtolower(pathinfo($target_file_hotel, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check_hotel = getimagesize($_FILES["image-file"]["tmp_name"]);
    if ($check_hotel === false) {
        echo "File is not an image.";
        $uploadOk_hotel = 0;
    }

    // Check file size
    if ($_FILES["image-file"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk_hotel = 0;
    }

    // Allow certain file formats
    if (!in_array($imageFileType_hotel, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk_hotel = 0;
    }

    // Proceed if all checks passed
    if ($uploadOk_hotel == 1) {
        // Move uploaded file to the designated directory
        if (move_uploaded_file($_FILES["image-file"]["tmp_name"], $target_file_hotel)) {
            // File uploaded successfully, proceed to insert data into database
            $hotel_id = $_POST['hotel_id']; // Fetch the hotel ID from the form
            $room_name = $_POST['room-name'];
            $price_per_night = $_POST['price_per_night'];
            $amenities_bed = $_POST['amenities-bed'] ?? '';  // Handle optional fields
            $amenities_bath = $_POST['amenities-bath'] ?? '';
            $description = $_POST['description'];
            $image_url_hotel = $target_file_hotel; // Store image path in database

            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO hoteldetails (hotel_id, room_name, price_per_night, amenities_bed, amenities_bath, description, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssss", $hotel_id, $room_name, $price_per_night, $amenities_bed, $amenities_bath, $description, $image_url_hotel);

            // Execute query and check if successful
            if ($stmt->execute()) {
                // Redirect back to hotel list page after successful insertion
                header("Location: list-room.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, your file was not uploaded.";
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WonderLust Add Rooms</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <style>
 body {
    margin: 0; /* Remove default margin */
    overflow-x: hidden; /* Prevent horizontal scrolling */
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

.card {
    background: linear-gradient(135deg, #f0f4ff, #e0e7ff); /* Light gradient background */
    border-radius: 10px; /* Rounded corners */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    padding: 20px; /* Inner padding */
    margin: 15px; /* Space between cards */
    transition: transform 0.3s, box-shadow 0.3s; /* Smooth hover effect */
}

.card:hover {
    transform: translateY(-5px); /* Lift effect on hover */
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2); /* Darker shadow on hover */
}

.card-head {
    display: flex; /* Use flexbox for alignment */
    justify-content: space-between; /* Space between elements */
    align-items: center; /* Center align vertically */
}

.card-head h2 {
    font-size: 24px; /* Larger font size for the title */
    color: #333; /* Dark color for better readability */
}

.card-progress {
    margin-top: 10px; /* Space above progress bar */
}

.card-indicator {
    background-color: #e0e0e0; /* Light gray background for progress bar */
    border-radius: 5px; /* Rounded corners for the bar */
    height: 8px; /* Height of the progress bar */
    overflow: hidden; /* Clip overflow */
}

.card-indicator .indicator {
    height: 100%; /* Full height of the bar */
    transition: width 0.3s; /* Smooth transition for progress */
}

.indicator.one { background-color: #4caf50; } /* Green for users */
.indicator.two { background-color: #2196F3; } /* Blue for destinations */
.indicator.three { background-color: #ff9800; } /* Orange for hotels */
.indicator.four { background-color: #f44336; } /* Red for rooms */

/* Add specific styling for the User card (first card in the .analytics section) */
.analytics .card:first-child {
    background: linear-gradient(135deg, #e0f7e9, #b2e8b6); /* Green gradient background */
}

/* Ensure indicator for User card matches green theme */
.indicator.one { 
    background-color: #4caf50; /* Green for the progress indicator */
}

/* User card - Green */
.analytics .card:nth-child(1) {
    background: linear-gradient(135deg, #e0f7e9, #b2e8b6); /* Green gradient */
}
.indicator.one {
    background-color: #4caf50; /* Green progress indicator */
}

/* Destination card - Blue */
.analytics .card:nth-child(2) {
    background: linear-gradient(135deg, #e0f3ff, #b2d7ff); /* Blue gradient */
}
.indicator.two {
    background-color: #2196F3; /* Blue progress indicator */
}

/* Hotel card - Orange */
.analytics .card:nth-child(3) {
    background: linear-gradient(135deg, #ffe8d1, #ffc18b); /* Orange gradient */
}
.indicator.three {
    background-color: #ff9800; /* Orange progress indicator */
}

/* Room card - Red */
.analytics .card:nth-child(4) {
    background: linear-gradient(135deg, #ffd6d6, #ff9e9e); /* Red gradient */
}
.indicator.four {
    background-color: #f44336; /* Red progress indicator */
}

.records {
    margin-top: 20px; /* Space above the table */
    border-radius: 8px; /* Rounded corners */
    overflow: hidden; /* Ensure no overflow */
}

.table-responsive {
    width: 100%; /* Full width */
    border: 1px solid #e0e0e0; /* Light border around the table */
    border-radius: 8px; /* Rounded corners for the table */
    overflow: hidden; /* Hide overflow for rounded corners */
}

table {
    width: 100%; /* Full width */
    border-collapse: collapse; /* Collapse borders */
    
}

th, td {
    padding: 12px 15px; /* Padding for cells */
    text-align: left; /* Align text to the left */
}

th {
    background-color: #ed77b3; /* Brighter purple for header */
    color: #ffffff; /* White text color for header */
    border-bottom: 2px solid #8e44ad; /* Darker border below header */
}

tbody tr {
    background-color: #f2f2f2; /* Brighter light gray for all rows */
}

.client-img {
    border-radius: 50%; /* Circle shape for images */
    width: 40px; /* Fixed width for images */
    height: 40px; /* Fixed height for images */
    object-fit: cover; /* Cover the area */
}

.client-info h4 {
    margin: 0; /* Remove default margin */
    color: #333; /* Darker color for client name */
}

.client {
    display: flex; /* Flexbox for layout */
    align-items: center; /* Center vertically */
}
.add-room-button {
    background-color: #FFA500; /* Orange color */
    color: white; /* Text color */
    padding: 10px 20px; /* Padding for a balanced look */
    border-radius: 4px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    border: none; /* Remove default button border */
    font-size: 16px; /* Font size */
    transition: background-color 0.3s, transform 0.2s; /* Smooth transitions */
    display: inline-flex; /* Inline-flex for better alignment */
    align-items: center; /* Center items vertically */
}

.add-room-button:hover {
    background-color: #ff8c00; /* Darker orange on hover */
    transform: scale(1.05); /* Slightly increase size on hover */
}

.add-room-button span {
    margin-right: 6px; /* Space between icon and text */
}


</style>
</head>
<body>
    <!-- Sidebar -->
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
                        <a href="index-admin.php">
                            <span class="las la-home"></span>
                            <small>Dashboard</small>
                        </a>
                    </li>
                    <li>
                        <a href="list-destination.php">
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
                       <a href="list-room.php"class="active">
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

    <!-- Main content -->
    <div class="main-content">
        <main>
            <div class="page-header">
                <div class="header-content">
                    <div class="title-section">
                        <h1>Add Rooms</h1>
                        <small>WanderLust</small>
                    </div>
                </div>
            </div>

            <div class="page-content">
                <!-- Rooms Form -->
                <form action="add_room.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <!-- Hotel Selection Dropdown -->
                        <label for="hotel_id">Select Hotel:</label>
                        <select id="hotel_id" name="hotel_id" required>
                            <option value="">Select a hotel</option>
                            <?php
                            // Fetch hotels from the database
                            include ('db.php');
                            $hotels_result = mysqli_query($conn, "SELECT * FROM hotels");
                            while ($hotel = mysqli_fetch_assoc($hotels_result)) {
                                echo '<option value="' . $hotel['id'] . '">' . htmlspecialchars($hotel['name']) . '</option>';
                            }
                            ?>
                        </select>

                        <label for="image-file">Choose Image:</label>
                        <input type="file" id="image-file" name="image-file" onchange="updateImagePreview(this)" accept="image/*" required>
                        <p id="file-name"></p>
                        <img id="image-preview" src="" alt= "" class="hotel-image">
                    </div>
                    <div class="text p-4">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="room-name">Room Name:</label>
                                <input type="text" id="room-name" name="room-name" placeholder="Enter Room name" required>
                            </div>
                            <div class="form-group">
                                <label for="price_per_night">Price per Night:</label>
                                <input type="text" id="price_per_night" name="price_per_night" placeholder="Enter price per night" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="amenities-bed">Bed Amenities:</label>
                                <input type="text" id="amenities-bed" name="amenities-bed" placeholder="e.g. King Size, Queen Size">
                            </div>
                            <div class="form-group">
                                <label for="amenities-bath">Bath Amenities:</label>
                                <input type="text" id="amenities-bath" name="amenities-bath" placeholder="e.g. Shower, Bathtub">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea id="description" name="description" placeholder="Enter description" required></textarea>
                        </div>
                    </div>
                    <button type="submit" class="add-room-button">
     Add Room
</button>
                </form>
            </div>
        </main>
    </div>

    <script>
        function updateImagePreview(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('image-preview').src = e.target.result;
                    document.getElementById('file-name').textContent = input.files[0].name;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>



