Kuro, [27/10/2024 3:59 AM]
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>WonderLust About</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body>
    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-content">
            <div class="profile">
                <div class="profile-img bg-img" style="background-image: url(img/WanderLust-Logo.png)"></div>
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
                       <a href="list-about.php">
                            <span class="las la-info-circle"></span>
                            <small>About</small>
                        </a>
                    </li>
                    <li>
                       <a href="list-destination.php">
                            <span class="las la-map-marked"></span> 
                            <small>Destination</small>
                        </a>
                    </li>
                    <li>
                       <a href="List-hotel.php">
                            <span class="las la-hotel"></span>
                            <small>Hotel</small>
                        </a>
                    </li>
                    <li>
                       <a href="list-blog.php"class="active">
                            <span class="las la-blog"></span>
                            <small>Blog</small>
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
                <h1>Feedback List</h1>
                <small>WanderLust</small>
            </div>
             <div class="page-content">
                <a onclick="openPopup('addPopup')"class="button">Add Feedback</a>
                    <div id="addPopup" class="popup">
                    <div class="popup-content">
                        <!-- Close button -->
                        <span class="close" onclick="closePopup('addPopup')">&times;</span>
                        <!-- Your form HTML content -->
                        <h2 style="color:black">Feedback Form</h2>
                        <form action="" method="post">
                            <div class="img">
                                <label for="image-url">Image URL:</label>
                                <input type="text" id="image-url" name="image-url" placeholder="Enter image URL">
                            </div>
                            <div class="text p-4">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="feedback-name">Client Name:</label>
                                        <input type="text" id="feedback-name" name="feedback-name" placeholder="Enter client name">
                                    </div>
                                    <div class="form-group">
                                        <label for="potion">Potion Client:</label>
                                        <input type="text" id="position" name="position" placeholder="Enter client position">

</div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="star-rating">Star Rating:</label>
                                        <select id="star-rating" name="star-rating">
                                            <option value="1">1 Star</option>
                                            <option value="2">2 Stars</option>
                                            <option value="3">3 Stars</option>
                                            <option value="4">4 Stars</option>
                                            <option value="5">5 Stars</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="feedback-desc">Feedback:</label>
                                        <textarea id="feedback-desc" name="feedback-desc" placeholder="Enter feedback client"></textarea>
                                   </div>
                               </div>
                            </div>
                            <input type="submit" value="Submit">
                        </form>
                    </div>
                 </div>

                <div class="records table-responsive">

                    <div>
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th><span class="las la-sort"></span> IMAGE</th>
                                    <th><span class="las la-sort"></span> POSITION</th>
                                    <th><span class="las la-sort"></span> STAR RATING</th>
                                    <th><span class="las la-sort"></span> TOUR DURATION</th>
                                    <th><span class="las la-sort"></span> DESCRIPTION</th>
                                    <th><span class="las la-sort"></span> ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="client">
                                           <div class="client-img bg-img" style="background-image: url(img/3.jpeg)"></div>
                                            <div class="client-info">
                                                <h4>Andrew Bruno</h4>
                                                <small>bruno@crossover.org</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        $3171
                                    </td>
                                    <td>
                                        $3171
                                    </td>
                                    <td>
                                        $3171
                                    </td>
                                    <td>
                                        $3171
                                    </td>
                                    <td>
                                        <div class="actions">
                                            <span onclick="openPopup('viewPopup')" style="color:blue" class="las la-binoculars"></span>
                                            <div id="viewPopup" class="popup">
                                                <div class="popup-content">
                                                    <!-- Close button -->
                                                    <span class="close" onclick="closePopup('viewPopup')">&times;</span>
                                                    <h2>View Fedback</h2>
                                                    <form>

<div class="container">
                                                            <div class="image-column">
                                                                <div class="img">
                                                                    <label for="image-url">Image URL:</label>
                                                                    <input type="text" name="image-url" placeholder="Enter image URL" value="<?php echo$row[''] ?>"required>
                                                                </div>
                                                            </div>
                                                            <div class="data-column">
                                                                <div class="text p-4">
                                                                    <div class="form-row">
                                                                        <div class="form-group">
                                                                            <label for="feedback-name">Client Name:</label>
                                                                            <input type="text" name="feedback-name" placeholder="Enter client name" value="<?php echo$row[''] ?>"required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group">
                                                                            <label for="potion">Positon:</label>
                                                                            <input type="text" id="potion" name="potion" placeholder="Enter client position" value="<?php echo$row[''] ?>"required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group">
                                                                            <label for="star-rating">Star Rating:</label>
                                                                            <select name="star-rating" value="<?php echo$row[''] ?>"required>
                                                                                <option value="1">1 Star</option>
                                                                                <option value="2">2 Stars</option>
                                                                                <option value="3">3 Stars</option>
                                                                                <option value="4">4 Stars</option>
                                                                                <option value="5">5 Stars</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                     <div class="form-row">
                                                                        <div class="form-group">
                                                                            <label for="feedback-desc">Feedback:</label>
                                                                    <textarea id="feedback-desc" name="feedback-desc" placeholder="Enter feedback client" value="<?php echo$row[''] ?>"required></textarea>
                                                                       </div>
                                                                   </div>
                                                                </div>

</div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <span onclick="openPopup('updatePopup')" style="color:green" class="las la-edit"></span>
                                            <div id="updatePopup" class="popup">
                                                <div class="popup-content">
                                                    <!-- Close button -->
                                                    <span class="close" onclick="closePopup('updatePopup')">&times;</span>
                                                    <!-- Your form HTML content -->
                                                    <h2>Update Feedback</h2>
                                                    <form action="" method="post">
                                                        <div class="img">
                                                            <label for="image-url">Image URL:</label>
                                                            <input type="text" name="image-url" placeholder="Enter image URL" value="<?php echo$row[''] ?>"required>
                                                        </div>
                                                        <div class="text p-4">
                                                            <div class="form-row">
                                                                <div class="form-group">
                                                                    <label for="client-name">Client Name:</label>
                                                                    <input type="text" name="client-name" placeholder="Enter client name" value="<?php echo$row[''] ?>"required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="potion">Potion:</label>
                                                                    <input type="text" id="potion" name="potion" placeholder="Enter client potion" value="<?php echo$row[''] ?>"required>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group">
                                                                    <label for="star-rating">Star Rating:</label>
                                                                    <select name="star-rating" value="<?php echo$row[''] ?>"required>
                                                                        <option value="1">1 Star</option>
                                                                        <option value="2">2 Stars</option>
                                                                        <option value="3">3 Stars</option>
                                                                        <option value="4">4 Stars</option>
                                                                        <option value="5">5 Stars</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="feedback-desc">Feedback:</label>
                                                                    <textarea id="feedback-desc" name="feedback-desc" placeholder="Enter feedback client" value="<?php echo$row[''] ?>"required></textarea>
                                                               </div>

</div>
                                                        </div>
                                                        <input type="submit" value="Submit">
                                                    </form>
                                                </div>
                                            </div>
                                            <a href="delete-about.php">
                                                <span style="color: red" class="las la-trash"></span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
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