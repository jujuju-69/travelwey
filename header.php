<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo isset($title) ? $title : 'TravelWey | Discover Your Journey'; ?></title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Arizonia&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-YjiJ7WA3UoNqLkTDaZUJ3WBLtJKHavonGzz2OGQ9KRH+QaL9TfpiIl4e9DUaEnId" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- Fallback for CSS -->
    <noscript>
        <link rel="stylesheet" href="css/fallback.css">
    </noscript>
</head>
<body>
    <?php
    // Function to highlight the active menu item
    function isActive($page) {
        $current_file = basename($_SERVER['PHP_SELF']);
        return $current_file == $page ? 'active' : '';
    }
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php">TravelWey<span>Fun Travel</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item <?php echo isActive('about.php'); ?>">
                        <a href="about.php" class="nav-link">About</a>
                    </li>
                    <li class="nav-item dropdown <?php echo isActive('destination.php'); ?>">
                        <a class="nav-link dropdown-toggle" href="#" id="statesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Destination</a>
                        <div class="dropdown-menu" aria-labelledby="statesDropdown">
                            <a class="dropdown-item" href="destination.php">All States</a>
                            <?php
                            $states = ['Perlis', 'Penang', 'Kedah', 'Perak', 'Kelantan', 'Pahang', 'Terengganu', 'Melaka', 'Sabah', 'Sarawak', 'Johor', 'Negeri Sembilan', 'Selangor', 'Wilayah Persekutuan Kuala Lumpur'];
                            foreach ($states as $state) {
                                echo '<a class="dropdown-item" href="destination.php?state=' . urlencode($state) . '">' . $state . '</a>';
                            }
                            ?>

                        </div>
                    </li>
                    <li class="nav-item <?php echo isActive('hotel.php'); ?>">
                        <a href="hotel.php" class="nav-link">Hotel</a>
                    </li>
                    <li class="nav-item <?php echo isActive('contact.php'); ?>">
                        <a href="contact.php" class="nav-link">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: white !important;" href="admin/login-user.php" class="btn btn-primary nav-link"><i class="fa fa-sign-in"></i>&nbsp;Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function trackClick(destination) {
            if (!destination) {
                console.error('Invalid destination');
                return;
            }
            $.ajax({
                url: 'track_click.php',
                type: 'GET',
                data: { destination: destination },
                success: function(response) {
                    console.log('Tracked: ' + destination);
                },
                error: function(xhr, status, error) {
                    console.error("Error tracking click: " + error);
                }
            });
        }
    </script>
</body>
</html>
