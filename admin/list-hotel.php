<?php
include 'db.php';

// Function to retrieve hotel details by ID
function getHotelById($conn, $hotelId) {
    $sql = "SELECT * FROM hotels WHERE hotel_id = $hotelId";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return null;
}


// Fetching all hotels with destination details
$sql = "
    SELECT 
        hotels.id AS hotel_id, 
        hotels.name AS hotel_name, 
        hotels.price AS hotel_price, 
        hotels.rating AS hotel_rating, 
        hotels.location AS hotel_location, 
        hotels.image AS hotel_image,
        destinations.name AS destination_name
    FROM 
        hotels 
    JOIN 
        destinations 
    ON 
        hotels.destination_name = destinations.name 
    ORDER BY 
        hotels.id;
";

$result = $conn->query($sql);
if (!$result) {
    die("Query Failed: " . $conn->error);
}

// Fetch counts
$sqlHotels = "SELECT COUNT(id) AS hotel_count FROM hotels";
$resultHotels = $conn->query($sqlHotels);
$rowHotels = $resultHotels->fetch_assoc();
$hotelCount = $rowHotels['hotel_count'];

$sqlUsers = "SELECT COUNT(id) AS user_count FROM users";
$resultUsers = $conn->query($sqlUsers);
$rowUsers = $resultUsers->fetch_assoc();
$userCount = $rowUsers['user_count'];

$sqlRooms = "SELECT COUNT(id) AS room_count FROM hoteldetails";
$resultRooms = $conn->query($sqlRooms);
$rowRooms = $resultRooms->fetch_assoc();
$roomCount = $rowRooms['room_count'];


$sqlDestinations = "SELECT COUNT(id) AS destination_count FROM destinations";
$resultDestinations = $conn->query($sqlDestinations);
$rowDestinations = $resultDestinations->fetch_assoc();
$destinationCount = $rowDestinations['destination_count'];

// Handle view hotel by ID
if (isset($_GET['view_id'])) {
    $viewHotelId = $_GET['view_id'];
    $viewHotel = getHotelById($conn, $viewHotelId);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>WonderLust About</title>
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
/* Table Styling */
table {
    width: 100%; /* Full width */
    border-collapse: collapse; /* Collapse borders */
}

th, td {
    padding: 10px 12px; /* Adjusted padding for cells */
    text-align: left; /* Align text to the left */
    border-bottom: 1px solid #ddd; /* Add bottom border for better separation */
    font-size: 12px; /* Smaller font size for table cells */
}

th {
    background-color: #ed77b3; /* Brighter purple for header */
    color: #ffffff; /* White text color for header */
    font-size: 14px; /* Smaller font size for headers */
}

tbody tr:hover {
    background-color: #e0e0e0; /* Gray background on hover for better visibility */
}

tbody tr:nth-child(odd) {
    background-color: #ffe6f2; /* Light pink for odd rows */
}

tbody tr:nth-child(even) {
    background-color: #ffffff; /* White for even rows */
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    th, td {
        padding: 8px 5px; /* Further adjust padding for smaller screens */
    }

    th {
        font-size: 12px; /* Smaller font size for headers on mobile */
    }

    td {
        font-size: 10px; /* Smaller font size for table cells on mobile */
    }
}
/* Action Buttons Container */
.action-buttons {
    display: flex; /* Use flexbox for alignment */
    gap: 8px; /* Space between buttons */
}

/* Button Styles */
.action-buttons button,
.action-buttons .edit-button,
.action-buttons .delete-button,
.action-buttons .add-room-button {
    font-size: 12px; /* Smaller font size */
    padding: 4px 8px; /* Reduced padding */
    border-radius: 4px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    transition: background-color 0.3s, transform 0.3s; /* Smooth transition */
}

/* View Button Style */
.action-buttons button {
    background-color: #2196F3 !important; /* Blue background */
    color: white; /* White text */
    border: 1px solid #2196F3; /* Optional border for better visibility */
}

.action-buttons button:hover {
    background-color: #1976D2; /* Darker blue on hover */
}

/* Edit Button Style */
.action-buttons .edit-button {
    background-color: #4caf50; /* Green background */
    color: white; /* White text */
    border: none; /* Remove default border */
}

.action-buttons .edit-button:hover {
    background-color: #45a049; /* Darker green on hover */
}

/* Delete Button Style */
.action-buttons .delete-button {
    background-color: #f44336; /* Red background */
    color: white; /* White text */
    border: none; /* Remove default border */
}

.action-buttons .delete-button:hover {
    background-color: #d32f2f; /* Darker red on hover */
}

/* Add Room Button Style */
.add-room-button {
    background-color: #9E9E9E; /* Gray background */
    color: white; /* White text */
    border: none; /* Remove default border */
}

.add-room-button:hover {
    background-color: #757575; /* Darker gray on hover */
    transform: scale(1.05); /* Slightly enlarge on hover */
}
/* Add Hotel Content Button Style */
.add-hotel-button {
    background-color: #FF9800; /* Orange background */
    color: white; /* White text */
    padding: 10px 15px; /* Adjust padding as needed */
    border: none; /* Remove default border */
    border-radius: 4px; /* Rounded corners */
    text-decoration: none; /* Remove underline for link */
    font-size: 14px; /* Adjust font size */
    transition: background-color 0.3s; /* Smooth transition */
}

.add-hotel-button:hover {
    background-color: #F57C00; /* Darker orange on hover */
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
                       <a href=""class="active">
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

<div class="page-header">
                <h1>Hotel List</h1>
            </div>
<!-- ni kasi seragam semua navside ade -->
<div class="page-content">
<div class="analytics">
                    <div class="card">
                        <div class="card-head">
                            <h2><?php echo $userCount; ?></h2>
                            <span class="las la-user-friends"></span>
                        </div>
                        <div class="card-progress">
                            <small>User</small>
                            <div class="card-indicator">
                                <div class="indicator one" style="width: 60%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2><?php echo $destinationCount; ?></h2>
                            <span class="las la-map-marker"></span> 
                        </div>
                        <div class="card-progress">
                            <small>Destination List</small>
                            <div class="card-indicator">
                                <div class="indicator two" style="width: 80%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2><?php echo $hotelCount; ?></h2>
                            <span class="las la-hotel"></span> 
                        </div>
                        <div class="card-progress">
                            <small>Hotel List</small>
                            <div class="card-indicator">
                                <div class="indicator three" style="width: 65%"></div>
                            </div>
                        </div>
                    </div>
                 
                    <div class="card">
                      <div class="card-head">
                          <h2><?php echo $roomCount; ?></h2>
                          <span class="las la-door-open"></span> 
                      </div>
                      <div class="card-progress">
                          <small>Rooms List</small>
                          <div class="card-indicator">
                             <div class="indicator four" style="width: 65%"></div>
                         </div>
                    </div>
                </div>
             </div>


                <a href="add_hotel.php" class="add-hotel-button">Add Hotel Content</a>

                <div class="records table-responsive">
    <table width="100%">
        <thead>
            <tr>
                <th><span class="las la-sort"></span> IMAGE</th>
                <th><span class="las la-sort"></span> NAME</th>
                <th><span class="las la-sort"></span> PRICE PER NIGHT</th>
                <th><span class="las la-sort"></span> STAR RATING</th>
                <th><span class="las la-sort"></span> LOCATION TOUR</th>
                <th><span class="las la-sort"></span> DESTINATION NAME</th>
                <th><span class="las la-sort"></span> ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td>
                        <div class="client">
                            <div class="client-img bg-img" style="background-image: url(<?php echo $row['hotel_image']; ?>)"></div>
                        </div>
                    </td>
                    <td><?php echo $row['hotel_name']; ?></td>
                    <td>RM <?php echo $row['hotel_price']; ?></td>
                    <td><?php echo $row['hotel_rating']; ?>/5</td>
                    <td><?php echo $row['hotel_location']; ?></td>
                    <td><?php echo $row['destination_name']; ?></td>
                    <td>
    <div class="action-buttons">
    <button onclick="openPopup('viewPopup_<?php echo $row['hotel_id']; ?>')" style="background: none; border: 1px solid blue; padding: 5px 10px;" title="View">
    View
</button>
        <div id="viewPopup_<?php echo $row['hotel_id']; ?>" class="popup">
            <div class="popup-content">
                <!-- Close button -->
                <span class="close" onclick="closePopup('viewPopup_<?php echo $row['hotel_id']; ?>')">&times;</span>
                <!-- View hotel details -->
                <h2>View Hotel</h2>
                <div class="container">
                    <div class="image-column">
                        <div class="img">
                            <label for="image-url">Image:</label>
                            <img src="<?php echo $row['hotel_image']; ?>" style="width: 200px; height: 150px;">
                        </div>
                    </div>
                    <div class="data-column">
                        <div class="text p-4">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="hotel-name">Hotel Name:</label>
                                    <input type="text" name="hotel-name" value="<?php echo $row['hotel_name']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price per night:</label>
                                    <input type="text" name="price" value="RM <?php echo $row['hotel_price']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="star-rating">Star Rating:</label>
                                    <input type="text" name="star-rating" value="<?php echo $row['hotel_rating']; ?>/5" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="location">Location:</label>
                                    <input type="text" name="location" value="<?php echo $row['hotel_location']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="destination-name">Destination Name:</label>
                                    <input type="text" name="destination-name" value="<?php echo $row['destination_name']; ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="update_hotel.php?id=<?php echo $row['hotel_id']; ?>" title="Edit" class="edit-button"><i class="fas fa-edit"></i> Edit</a>
        <a href="delete_hotel.php?id=<?php echo $row['hotel_id']; ?>" onclick="return confirm('Are you sure?')" title="Delete" class="delete-button"><i class="fas fa-trash"></i> Delete</a>
        <a href="add_room.php?id=<?php echo $row['hotel_id']; ?>">
    <button type="button" class="add-room-button">Add Room</button>
</a>
    </div>
</td>
                </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='7'>No hotels found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
                </div>
            </div>  
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