<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wanderlust";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize $roomId
$roomId = null;

// Check if Room ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $roomId = $_GET['id'];

    // Query to fetch Rooms details by ID
    $sql = "SELECT id, hotel_id, room_name, price_per_night, amenities_bed, amenities_bath, description, image
            FROM hoteldetails
            WHERE id = $roomId";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $room = $result->fetch_assoc();
    } else {
        echo "Rooms not found.";
        exit; // Or handle error as needed
    }
} else {
    echo "Rooms ID not provided.";
    exit; // Or redirect to an error page
}

// Handle form submission to update rooms details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roomName = $_POST['room-name'];
    $price_per_night = $_POST['price-per-night'];
    $amenitiesBed = $_POST['amenities-bed'];
    $amenitiesBath = $_POST['amenities-bath'];
    $description = $_POST['description'];

    // Initialize $updateSql
    $updateSql = "UPDATE hoteldetails SET 
                  room_name = '$roomName', 
                  price_per_night = '$price_per_night', 
                  amenities_bed = '$amenitiesBed',
                  amenities_bath = '$amenitiesBath',
                  description = '$description'";

    // Handle image upload if a new file is selected
    if ($_FILES['image-file']['error'] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['image-file']['tmp_name'];
        $upload_dir = '../images/';
        $new_filename = uniqid('hotel_image_') . '.' . pathinfo($_FILES['image-file']['name'], PATHINFO_EXTENSION); // Generate a unique filename
        $destination = $upload_dir . $new_filename;
        
        // Move the uploaded file to the designated directory
        if (move_uploaded_file($tmp_name, $destination)) {
            // Update the database with the new image path
            $updateSql .= ", image = '$destination'";
        } else {
            echo "Failed to move uploaded file.";
        }
    }

    // Finalize the update SQL with WHERE clause
    $updateSql .= " WHERE id = $roomId";
    
    // Execute the update query
    if ($conn->query($updateSql) === TRUE) {
        // Redirect back to list-rooms.php upon successful update
        header("Location: list-room.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>WonderLust Hotel List</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <style>
        /* Add your custom CSS styles here */
          .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        
        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }
        
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }
        
        h2 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
        }
        
        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 8px;
            color: #666;
        }
		
		.hotel-image {
    width: 100%;
    height: auto;
    max-height: 300px; /* Adjust height as needed */
    object-fit: cover; /* Ensures the image covers the entire container */
    border-radius: 5px; /* Optional: Adds rounded corners */
}

    /* Existing styles */
    
    /* Styling for file input */
    .img input[type="file"] {
        display: none; /* Hide the default file input */
    }
    
    .img label {
        display: inline-block;
        background-color: #3498db; /* Example background color */
        color: #fff;
        padding: 10px 15px;
        cursor: pointer;
        border-radius: 5px;
        margin-top: 10px;
    }
    
    .img label:hover {
        background-color: #2980b9; /* Darker background color on hover */
    }
    
    .img img {
        max-width: 100px;
        margin-top: 10px;
        display: block; /* Ensure the image is displayed properly */
    }

 body {
    margin: 0; /* Remove default margin */
    overflow-x: hidden; /* Prevent horizontal scrolling */
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

    </style>
</head>

<body>
   <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-content">
            <div class="profile">
                <div class="profile-img bg-img" style="background-image: url(img/TravelWey-logo.jpeg)"></div>
                <h4>Admin NWDL</h4>
                <small>N.WanderLust</small>
            </div>

            <div class="side-menu">
                <ul>
                    <li>
                       <a href="index-admin.php" >
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
    
    <div class="main-content">
        <main>
            <div class="page-header">
                <div class="header-content">
                    <div class="title-section">
                        <h1>Edit Hotel List</h1>
                        <small>WanderLust</small>
                    </div>
                </div>
            </div>
            
            <div class="page-content">
                <div class="edit-hotel-form">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $roomId; ?>" method="post" enctype="multipart/form-data">
        <label for="room-name">Room Name:</label>
        <input type="text" id="room-name" name="room-name" value="<?php echo htmlspecialchars($room['room_name']); ?>" required>

        <label for="price-per-night">Price per Night:</label>
        <input type="text" id="price-per-night" name="price-per-night" value="<?php echo htmlspecialchars($room['price_per_night']); ?>" required>

        <label for="amenities-bed">Amenities (Bed):</label>
        <input type="text" id="amenities-bed" name="amenities-bed" value="<?php echo htmlspecialchars($room['amenities_bed']); ?>" required>

        <label for="amenities-bath">Amenities (Bath):</label>
        <input type="text" id="amenities-bath" name="amenities-bath" value="<?php echo htmlspecialchars($room['amenities_bath']); ?>" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($room['description']); ?></textarea>

        <div class="img">
            <label for="image-file">Choose Image</label>
            <input type="file" id="image-file" name="image-file" onchange="updateImagePreview(this)">
            <?php if (!empty($room['image']) && file_exists($room['image'])): ?>
                <img id="image-preview" src="<?php echo $room['image']; ?>" alt="Current Image">
            <?php else: ?>
                <p>No image uploaded yet.</p>
            <?php endif; ?>
            <span id="file-name"></span>
        </div>
                        <input type="submit" value="Update">
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
    function updateImagePreview(input) {
        const fileName = input.files[0].name;
        document.getElementById('file-name').textContent = fileName;
        
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('image-preview').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
</script>

</body>
</html>
