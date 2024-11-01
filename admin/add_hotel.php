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

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle file upload for hotels
    $target_dir_hotel = "images/";
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
    if ($imageFileType_hotel != "jpg" && $imageFileType_hotel != "png" && $imageFileType_hotel != "jpeg"
        && $imageFileType_hotel != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk_hotel = 0;
    }

     // Proceed if all checks passed
     if ($uploadOk_hotel == 1) {
        // Move uploaded file to the designated directory
        if (move_uploaded_file($_FILES["image-file"]["tmp_name"], $target_file_hotel)) {
            // File uploaded successfully, proceed to insert data into database
            $hotel_name = $_POST['hotel-name'];
            $price = $_POST['price'];
            $star_rating = $_POST['star-rating'];
            $location = $_POST['location'];
            $destination_id = $_POST['hotel_id']; // Capture destination ID
            $image_url_hotel = $target_file_hotel;

              // Fetch destination name based on destination ID
            $result = $conn->query("SELECT name FROM destinations WHERE id = $destination_id");
            $destination_name = ($result && $result->num_rows > 0) ? $result->fetch_assoc()['name'] : null;

            if ($destination_name) {
                // Prepare and bind
                $stmt = $conn->prepare("INSERT INTO hotels (name, price, rating, location, destination_name, image) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssisss", $hotel_name, $price, $star_rating, $location, $destination_name, $image_url_hotel);

                // Execute query and check if successful
                if ($stmt->execute()) {
                    header("Location: list-hotel.php"); // Redirect after successful insertion
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            } else {
                echo "Invalid destination ID selected or no matching destination found.";
            }
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
    <title>WonderLust Add Hotel</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <style>
        /* Add your custom CSS styles here */
        /* Existing styles */
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
        
        /* New styles for the form */
        .page-content {
            background-color: #f0f0f0; /* Light gray background */
            padding: 20px; /* Add padding for better readability */
            border-radius: 10px; /* Rounded corners for the form container */
        }
        
        form {
            background-color: #fff; /* White background for form */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow */
        }
        
        form label {
            font-weight: bold;
            color: #333;
        }
        
        form input[type="text"],
        form input[type="submit"],
        form select,
        form textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        
        form input[type="submit"] {
            background-color: #3498db; /* Blue background for submit button */
            color: #fff;
            cursor: pointer;
        }
        
        form input[type="submit"]:hover {
            background-color: #2980b9; /* Darker blue on hover */
        }
        
        form textarea {
            height: 100px; /* Set height for the textarea */
        }
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
                        <a href="list-hotel.php" class="active">
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

    <!-- Main content -->
    <div class="main-content">
        <main>
            <div class="page-header">
                <div class="header-content">
                    <div class="title-section">
                        <h1>Add Hotel</h1>
                        <small>WanderLust</small>
                    </div>
                </div>
            </div>

            <div class="page-content">
                <!-- Hotel Form -->
                <form action="add_hotel.php" method="post" enctype="multipart/form-data">
                <div class="form-group">

                <!-- Hotel Selection Dropdown -->
                <label for="destinations_id">Select Destination:</label>
                        <select id="destinations_id" name="hotel_id" required>
                            <option value="">Select a Destination</option>
                            <?php
                            // Fetch hotels from the database
                            include ('db.php');
                            $destinations_result = mysqli_query($conn, "SELECT * FROM destinations");
                            while ($destinations = mysqli_fetch_assoc($destinations_result)) {
                                echo '<option value="' . $destinations['id'] . '">' . htmlspecialchars($destinations['name']) . '</option>';
                            }
                            ?>
                        </select>

                <label for="image-file">Choose Image:</label>
                <input type="file" id="image-file" name="image-file" onchange="updateImagePreview(this)" accept="image/*" required>
                <p id="file-name"></p>
                <img id="image-preview" src="" alt="" class="hotel-image">
                </div>
                    <div class="text p-4">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="hotel-name">Hotel Name:</label>
                                <input type="text" id="hotel-name" name="hotel-name" placeholder="Enter hotel name" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Price per person:</label>
                                <input type="text" id="price" name="price" placeholder="Enter price" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="star-rating">Star Rating:</label>
                                <select id="star-rating" name="star-rating" required>
                                    <option value="1">1 Star</option>
                                    <option value="2">2 Stars</option>
                                    <option value="3">3 Stars</option>
                                    <option value="4">4 Stars</option>
                                    <option value="5">5 Stars</option>
                                </select>
                            </div>
                        
                            <div class="form-group">
                                <label for="location">Location:</label>
                                <input type="text" id="location" name="location" placeholder="Enter location" required>
                            </div>
                        </div>
                       
                    </div>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </main>
    </div>

    <script>
function updateImagePreview(input) {
    const file = input.files[0];
    const reader = new FileReader();

    // Update the file name display
    document.getElementById('file-name').textContent = file.name;

    // Update the image preview
    reader.onload = function(e) {
        document.getElementById('image-preview').src = e.target.result;
    };

    // Read the uploaded file as a URL
    reader.readAsDataURL(file);
}
</script>
</body>
</html>
