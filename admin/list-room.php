<?php
include 'db.php';

// Function to retrieve hotel details by ID
function getHotelById($conn, $hotelId) {
    $sql = "SELECT * FROM hoteldetails WHERE id = $hotelId";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
       return $result->fetch_assoc();
    }
    return null;
}

//Fetching all hotels
$sql = "SELECT id, room_name, price_per_night, amenities_bed, amenities_bath,description, image FROM hoteldetails";
$result = $conn->query($sql);

//Fetch counts
$sqlHotels = "SELECT COUNT(id) AS hotel_count FROM hotels";
$resultHotels = $conn->query($sqlHotels);
$rowHotels = $resultHotels->fetch_assoc();
$hotelCount = $rowHotels['hotel_count'];

$sqlRooms = "SELECT COUNT(id) AS room_count FROM hoteldetails";
$resultRooms = $conn->query($sqlRooms);
$rowRooms = $resultRooms->fetch_assoc();
$roomCount = $rowRooms['room_count'];


$sqlUsers = "SELECT COUNT(id) AS user_count FROM users";
$resultUsers = $conn->query($sqlUsers);
$rowUsers = $resultUsers->fetch_assoc();
$userCount = $rowUsers['user_count'];

$sqlDestinations = "SELECT COUNT(id) AS destination_count FROM destinations";
$resultDestinations = $conn->query($sqlDestinations);
$rowDestinations = $resultDestinations->fetch_assoc();
$destinationCount = $rowDestinations['destination_count'];

//Handle view hotel by ID
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

.actions {
    display: flex; /* Use flexbox for button alignment */
    gap: 8px; /* Space between buttons */
}

.action-button {
    color: white; /* Text color */
    padding: 6px 10px; /* Padding for a balanced look */
    border-radius: 4px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    border: none; /* Remove default button border */
    transition: background-color 0.3s, transform 0.2s; /* Smooth transitions */
    font-size: 14px; /* Font size */
    display: flex; /* Flexbox for better alignment */
    align-items: center; /* Center items vertically */
    text-decoration: none; /* Remove underline for links */
}

.action-button span {
    margin-right: 6px; /* Space between icon and text */
    font-size: 16px; /* Increase icon size slightly */
}

.view-button {
    background-color: #007BFF; /* Blue for View */
}

.edit-button {
    background-color: #28A745; /* Green for Edit */
}

.delete-button {
    background-color: #DC3545; /* Red for Delete */
}

/* Hover effects for buttons */
.action-button:hover {
    opacity: 0.9; /* Slightly dim the buttons on hover */
    transform: scale(1.05); /* Slightly increase size on hover */
}
.add-room-button {
    background-color: #FFA500; /* Orange color */
    color: white; /* Text color */
    padding: 8px 15px; /* Padding for a balanced look */
    border-radius: 4px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    border: none; /* Remove default button border */
    transition: background-color 0.3s, transform 0.2s; /* Smooth transitions */
    font-size: 16px; /* Font size */
    display: inline-flex; /* Inline-flex for better alignment */
    align-items: center; /* Center items vertically */
}

.add-room-button:hover {
    opacity: 0.9; /* Slightly dim the button on hover */
    transform: scale(1.05); /* Slightly increase size on hover */
}

.add-room-button span {
    margin-right: 6px; /* Space between icon and text */
    font-size: 18px; /* Increase icon size slightly */
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
                       <a href="list-hotel.php">
                            <span class="las la-hotel"></span>
                            <small>Hotel</small>
                        </a>
                    </li>

                    <li>
                       <a href=""class="active">
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
                <h1>Room List</h1>
            </div>
<!-- ni kasi seragam semua analysis ade -->
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

   
                <a href="add_room.php" class="add-room-button">
    <span class="las la-plus"></span> Add Room Content
</a>

<div class="records table-responsive">
                        <table width="100%">
                            <thead>
                                <tr>
                                    
                                    <th><span class="las la-sort"></span> IMAGE</th>
                                    <th><span class="las la-sort"></span> NAME</th>
                                    <th><span class="las la-sort"></span> PRICE PER NIGHT</th>    
                                    <th><span class="las la-sort"></span> AMENITIES BED</th>              
                                    <th><span class="las la-sort"></span> AMENITIES BATH</th>
                                    <th><span class="las la-sort"></span> DESCRIPTION</th>
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
                                                <div class="client-img bg-img" style="background-image: url(<?php echo $row['image']; ?>)"></div>
                                                <div class="client-info"></div>
                                            </div>
                                        </td>
                                        <td><?php echo $row['room_name']; ?></td>
                                        <td>RM <?php echo $row['price_per_night']; ?></td>
                                        <td><?php echo $row['amenities_bed']; ?></td>
                                        <td><?php echo $row['amenities_bath']; ?></td>
                                        <td><?php echo $row['description']; ?></td>
                                        <td>
    <div class="actions">
        <button onclick="openPopup('viewPopup_<?php echo $row['id']; ?>')" class="action-button view-button">
            <span class="las la-binoculars"></span> View
        </button>
        <div id="viewPopup_<?php echo $row['id']; ?>" class="popup">
            <div class="popup-content">
                <!-- Close button -->
                <span class="close" onclick="closePopup('viewPopup_<?php echo $row['id']; ?>')">&times;</span>
                <!-- View hotel details -->
                <h2>View Room</h2>
                <div class="container">
                    <div class="image-column">
                        <div class="img">
                            <img src="<?php echo $row['image']; ?>" style="width: 200px; height: 150px;">
                        </div>
                    </div>
                    <div class="data-column">
                        <div class="text p-4">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="hotel-name">Room Name:</label>
                                    <input type="text" name="hotel-name" value="<?php echo $row['room_name']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price per night:</label>
                                    <input type="text" name="price" value="RM <?php echo $row['price_per_night']; ?>" readonly>
                                </div>
                            </div>
                            <label for="amenities_bed">Amenities Bed:</label>
                            <input type="text" name="amenities_bed" value="<?php echo $row['amenities_bed']; ?>" readonly>

                            <label for="amenities_bath">Amenities Bath:</label>
                            <input type="text" name="amenities_bath" value="<?php echo $row['amenities_bath']; ?>" readonly>

                            <label for="amenities_bath"> Description:</label>
                            <input type="text" name="description" value="<?php echo $row['description']; ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="update_room.php?id=<?= $row['id'] ?>" class="action-button edit-button">
            <span class="las la-edit"></span> Edit
        </a>
        <a href="delete_room.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete hotel <?php echo $row['room_name']; ?>?')" class="action-button delete-button">
            <span class="las la-trash"></span> Delete
        </a>
    </div>
</td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='8'>No Rooms found</td></tr>";
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