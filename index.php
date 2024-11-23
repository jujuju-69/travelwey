<?php
$title = 'Natural WonderLust - Travel & Tour';
include 'header.php';
include 'db.php';

$query = $conn->query("SELECT * FROM destinations");
$destinations = $query->fetch_all(MYSQLI_ASSOC);
?>

<body>
	<!-- HERO -->
	<div class="hero-wrap js-fullheight" style="background-image: url('images/bg-img-4.png');">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
				<div class="col-md-7 ftco-animate">
					<span class="subheading">Welcome to Apps Saya!</span>
					<h1 class="mb-4">Discover the amazing Places of Malaysia!</h1>
					<p class="caps">Experience the Rich Culture and Vibrant Lifestyle of Malaysia. </p>
				</div>
				<a href="https://youtu.be/IialiVCd-w8?si=MKof9xUn1xOZC92A" class="icon-video popup-vimeo d-flex align-items-center justify-content-center mb-4">
					<span class="fa fa-play"></span>
				</a>
			</div>
		</div>
	</div>

	<!-- SEARCH TAB -->
	<section class="ftco-section ftco-no-pb ftco-no-pt">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="ftco-search d-flex justify-content-center">
						<div class="row">
							<div class="col-md-12 nav-link-wrap">
								<div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
									<a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Search Tour</a>

									<a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Hotel</a>

								</div>
							</div>
							<div class="col-md-12 tab-wrap">
								
								<div class="tab-content" id="v-pills-tabContent">
								<!-- TOUR TAB -->
								<div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
								<?php
								include 'search-tour.php';
								?>
								</div>
								<!-- HOTEL TAB -->
								<div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-performance-tab">
								<?php
								include 'search-hotel.php';
								?>
								</div>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	
	<!-- TOURS -->
		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center pb-4">
					<div class="col-md-12 heading-section text-center ftco-animate">
						<span class="subheading">Destination</span>
						<h2 class="mb-4">Tour Destination</h2> 
						<!-- pull 6 data from databse, select related column from tour table -->
					</div>
				</div>
				<section id="section-page1" class="ftco-section">
				<div class="container">
    <div class="row">
      <?php foreach ($destinations as $destination): ?>
        <div class="col-md-4 ftco-animate">
          <div class="project-wrap">
          <a href="destination-details.php?id=<?php echo $destination['id']; ?>" class="img" style="background-image: url('<?php echo $destination['image']; ?>');">
          
            </a>
            <div class="text p-4">
              <span class="days">Come Join Us</span>
              <h3><a href="destination-details.php?id=<?php echo $destination['id']; ?>"><?php echo $destination['name']; ?></a></h3>
              <p class="location"><span class="fa fa-map-marker"></span> <?php echo $destination['location']; ?></p>
         
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
			</div>
		</section>
	<!-- VIDEO - ABOUT -->
		<section class="ftco-section ftco-about img"style="background-image: url(images/bg_4.jpg);">
			<div class="overlay"></div>
			<div class="container py-md-5">
				<div class="row py-md-5">
					<div class="col-md d-flex align-items-center justify-content-center">
						<a href="https://www.youtube.com/watch?v=sKDQFvw-wrM" class="icon-video popup-vimeo d-flex align-items-center justify-content-center mb-4">
							<span class="fa fa-play"></span>
						</a>
					</div>
				</div>
			</div>	
		</section>
	<!-- ABOUT -->
		<section class="ftco-section ftco-about ftco-no-pt img">
			<div class="container">
				<div class="row d-flex">
					<div class="col-md-12 about-intro">
						<div class="row">
							<div class="col-md-6 d-flex align-items-stretch">
								<div class="img d-flex w-100 align-items-center justify-content-center" style="background-image:url(images/about-1.jpg);">
								</div>
							</div>
							<div class="col-md-6 pl-md-5 py-5">
								<div class="row justify-content-start pb-3">
									<div class="col-md-12 heading-section ftco-animate">
										<span class="subheading">About Us</span>
										<h2 class="mb-4">Make Your Journey Fun and Safe With Us</h2>
										<p>Welcome to TravelWey!, your trusted guide to discovering the incredible beauty and diversity of Malaysia. From the bustling cityscapes of Kuala Lumpur to the serene beaches of Langkawi, and the lush rainforests of Borneo to the majestic peaks of Mount Kinabalu, we're here to inspire your journey and make unforgettable memories.</p>
										<p><a href="about.php" class="btn btn-primary">Know More</a></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<div class="powerbi-report">
                <br>
                <h2>Tourist Arrivals in Malaysia </h2>
                <p>Explore the latest data on visitor numbers below.</p>
                <br>
                <br>
                    <iframe 
                        title="Power BI Report" 
                        width="100%" 
                        height="600" 
                        src="https://app.powerbi.com/view?r=eyJrIjoiZmExMzY4ODItOGY0Ny00OTU2LWFhMWUtNGRiMGVhYTBlNGMwIiwidCI6IjYyMjNlMWFmLWExNDYtNDI0Ny1hYmNjLWYwNGFkMjlmYTc4NSIsImMiOjEwfQ%3D%3D" 
                        
                        
                        frameborder="2" 
                        allowFullScreen="true"></iframe>

				<br>
				<br>
				<br>
				<h2>Tourist Arrivals in Malaysia based on State </h2>
                <br>
                    <iframe 
                        title="Power BI Report" 
                        width="100%" 
                        height="600" 
                        src="https://app.powerbi.com/view?r=eyJrIjoiZTRhNmVkNmItYWU2ZS00MmIyLTlhOTktNGUwODMwYWRlMmQyIiwidCI6ImNmYTQxMzJhLTEyZTAtNGVhMi05OThlLTA5ZDUzY2E2ZjkwYyIsImMiOjEwfQ%3D%3D"
						
                        
                        
                        frameborder="2" 
                        allowFullScreen="true"></iframe>
                </div>

	<!-- BANNER -->
		<section class="ftco-intro ftco-section ftco-no-pt">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-12 text-center">
						<div class="img"  style="background-image: url(images/bg_2.jpg);">
							<div class="overlay"></div>
							<h2>WE ARE TRAVELWEY THRILL TO JOURNEY WITH YOU!</h2>
							<p>We can manage your travel from choosing destination until check in desired hotel.</p>
							<p class="mb-0"><a href="contact.php" class="btn btn-primary px-4 py-3">Contact Us</a></p>
						</div>
					</div>
				</div>
			</div>
		</section>


		<style>  
 /* Power BI Report Styling */  
.powerbi-report {  
    display: flex;  
    flex-direction: column;  
    align-items: center;  
    text-align: center;  
    margin: 20px auto;  
    max-width: 80%;  
    background-color: #ffffff;  
    padding: 15px;  
    border-radius: 12px;  
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  
    border: 1px solid #e0e0e0;  
    margin-bottom: 60px; /* Increased bottom margin for more spacing */  
}  

.powerbi-report h2 {  
    color: #333;  
    font-weight: bold;  
    margin-bottom: 8px;  
}  

.powerbi-report p {  
    color: #555;  
    margin-bottom: 15px;  
}  

.powerbi-report iframe {  
    width: 100%;  
    max-width: 1200px; /* Increased max-width for a larger display */  
    height: 600px; /* Increased height for better visibility */  
    border: none;  
    border-radius: 8px;  
}  
</style> 

	  </body>
<!-- Include Chatbot -->
<?php include 'chatbot.php';
include 'footer.php';
?>