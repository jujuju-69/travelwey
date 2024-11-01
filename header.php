<!DOCTYPE html>
<html lang="en">
<head>
	<?php
	// $title = 'Your Page Title'; // Define your title dynamically
	echo '<title>' . $title . '</title>';
	?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Arizonia&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="css/animate.css">
	
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">

	<link rel="stylesheet" href="css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="css/jquery.timepicker.css">

	<link rel="stylesheet" href="css/flaticon.css">
	<link rel="stylesheet" href="css/style.css">
	
</head>
<body>
	<?php
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
            <a class="dropdown-item" href="destination-perlis.php"onclick="trackClick('Perlis')">Perlis</a>
            <a class="dropdown-item" href="destination-penang.php"onclick="trackClick('Penang')">Penang</a>
			<a class="dropdown-item" href="destination-kedah.php" onclick="trackClick('Kedah')">Kedah</a>
            <a class="dropdown-item" href="destination-perak.php"onclick="trackClick('Perak')">Perak</a>
            <a class="dropdown-item" href="destination-kelantan.php"onclick="trackClick('Kelantan')">Kelantan</a>
            <a class="dropdown-item" href="destination-pahang.php"onclick="trackClick('Pahang')">Pahang</a>
            <a class="dropdown-item" href="destination-terengganu.php"onclick="trackClick('Terengganu')">Terengganu</a>
            <a class="dropdown-item" href="destination-melaka.php"onclick="trackClick('Melaka')">Melaka</a>
            <a class="dropdown-item" href="destination-sabah.php"onclick="trackClick('Sabah')">Sabah</a>
            <a class="dropdown-item" href="destination-sarawak.php"onclick="trackClick('Sarawak')">Sarawak</a>
            <a class="dropdown-item" href="destination-johor.php"onclick="trackClick('Johor')">Johor</a>
            <a class="dropdown-item" href="destination-sembilan.php"onclick="trackClick('Negeri Sembilan')">Negeri Sembilan</a>
            <a class="dropdown-item" href="destination-selangor.php"onclick="trackClick('Selangor')">Selangor</a>
            <a class="dropdown-item" href="destination-kl.php"onclick="trackClick('Wilayah Persekutuan Kuala Lumpur')">Wilayah Persekutuan Kuala Lumpur</a>
        </div>
    </li>
    <li class="nav-item <?php echo isActive('hotel.php'); ?>">
        <a href="hotel.php" class="nav-link">Hotel</a>
    </li>
    <!-- <li class="nav-item <?php echo isActive('blog.php'); ?>"><a href="blog.php" class="nav-link">Blog</a></li> -->
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
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function trackClick(destination) {
        $.ajax({
            url: 'track_click.php',
            type: 'GET',
            data: { destination: destination },
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error("Error tracking click: " + error);
            }
        });
    }
</script>
</html>
