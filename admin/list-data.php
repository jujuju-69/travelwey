<?php
include 'db.php';

$query = $conn->query("SELECT * FROM destinations");
$destinations = $query->fetch_all(MYSQLI_ASSOC);
// Query to get count of hotels
$sqlHotels = "SELECT COUNT(id) AS hotel_count FROM hotels";
$resultHotels = $conn->query($sqlHotels);
$rowHotels = $resultHotels->fetch_assoc();
$hotelCount = $rowHotels['hotel_count'];

// Query to get count of users
$sqlUsers = "SELECT COUNT(id) AS user_count FROM users";
$resultUsers = $conn->query($sqlUsers);
$rowUsers = $resultUsers->fetch_assoc();
$userCount = $rowUsers['user_count'];

$sqlRooms = "SELECT COUNT(id) AS room_count FROM hoteldetails";
$resultRooms = $conn->query($sqlRooms);
$rowRooms = $resultRooms->fetch_assoc();
$roomCount = $rowRooms['room_count'];

// Query to get count of destinations (assuming you have a destinations table)
$sqlDestinations = "SELECT COUNT(id) AS destination_count FROM destinations";
$resultDestinations = $conn->query($sqlDestinations);
$rowDestinations = $resultDestinations->fetch_assoc();
$destinationCount = $rowDestinations['destination_count'];

//$query = $conn->query("SELECT * FROM destinations");
//$destinations = $query->fetch_all(MYSQLI_ASSOC);
// Query to get count of hotels
//$sqlHotels = "SELECT COUNT(id) AS hotel_count FROM hotels";
//$resultHotels = $conn->query($sqlHotels);
//$rowHotels = $resultHotels->fetch_assoc();
//$hotelCount = $rowHotels['hotel_count'];

// Query to get count of users
//$sqlUsers = "SELECT COUNT(id) AS user_count FROM users";
//$resultUsers = $conn->query($sqlUsers);
//$rowUsers = $resultUsers->fetch_assoc();
//$userCount = $rowUsers['user_count'];

// Query to get count of destinations (assuming you have a destinations table)
//$sqlDestinations = "SELECT COUNT(id) AS destination_count FROM destinations";
//$resultDestinations = $conn->query($sqlDestinations);
//$rowDestinations = $resultDestinations->fetch_assoc();
//$destinationCount = $rowDestinations['destination_count'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WonderLust Destination List</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                        <a href="list-room.php">
                            <span class="las la-door-open"></span>
                            <small>Rooms</small>
                        </a>
                    </li>

<li>
                        <a href="#" class="active">
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
                <h1>Data Analysis</h1>
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


    <section id="dashboard-powerbi">
                
                <div class="powerbi-report">
                    <h2>BILANGAN TOURIST KE NEGERI</h2>
                    <p>Below you can find key reports and insights:</p>
                    <br>
                    <br>
                    <iframe 
                        title="Power BI Report" 
                        width="100%" 
                        height="600" 
                        src="https://app.powerbi.com/view?r=eyJrIjoiM2QwNTdlYjctNTQ1NS00MWY4LWJhOTQtNTAxZDkzYTU5ZGI1IiwidCI6ImNmYTQxMzJhLTEyZTAtNGVhMi05OThlLTA5ZDUzY2E2ZjkwYyIsImMiOjEwfQ%3D%3D"
                         
                        
                        frameborder="2" 
                        allowFullScreen="true"></iframe>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
                <div class="powerbi-report">
                <br>
                <h2>RATING HOTEL</h2>
                <p>Below you can find key reports and insights:</p>
                <br>
                <br>
                 <!-- ni kena setel kan kasi hias skt kotak power bi -->
                    <iframe 
                        title="Power BI Report" 
                        width="90%" 
                        height="600" 
                        display= "flex"
                        align-items= "center"
                        justify-content= "center"
                         margin-right= "15px" 
                         src="https://app.powerbi.com/view?r=eyJrIjoiZTRhNmVkNmItYWU2ZS00MmIyLTlhOTktNGUwODMwYWRlMmQyIiwidCI6ImNmYTQxMzJhLTEyZTAtNGVhMi05OThlLTA5ZDUzY2E2ZjkwYyIsImMiOjEwfQ%3D%3D"
						
                        
                        frameborder="2" 
                        allowFullScreen="true"></iframe>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
                <div class="powerbi-report">
                <br>
                <h2>CUSTOMER CLICK BY STATE</h2>
                <p>Below you can find key reports and insights:</p>
                <br>
                <br>
                    <iframe 
                        title="Power BI Report" 
                        width="100%" 
                        height="600" 
                        src="https://app.powerbi.com/view?r=eyJrIjoiMjljY2YxMTctZWNhMy00MjdkLWI4NzEtM2I0Y2MxZTdlMzQwIiwidCI6ImNmYTQxMzJhLTEyZTAtNGVhMi05OThlLTA5ZDUzY2E2ZjkwYyIsImMiOjEwfQ%3D%3D"
              
                        
                        
                        frameborder="2" 
                        allowFullScreen="true"></iframe>
                
                </div>
    </section>

    <script>
        // JavaScript functions to control the popup
        function openPopup(popupId) {
            document.getElementById(popupId).style.display = "block";
        }

        function closePopup(popupId) {
            document.getElementById(popupId).style.display = "none";
        }
    </script>
</body>
</html>