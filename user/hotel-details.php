<?php
$title = 'Hotel Details';
include 'header.php';

// Establish database connection
$conn = new mysqli('localhost', 'root', '', 'wanderlust');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get hotel ID from URL
$hotel_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch hotel details
$hotel_result = $conn->query("SELECT * FROM hotels WHERE id = $hotel_id");

// Check if query executed successfully
if ($hotel_result === false) {
    // Handle SQL error
    echo "Error: " . $conn->error;
} else {
    // Check if hotel found
    if ($hotel_result->num_rows > 0) {
        $hotel = $hotel_result->fetch_assoc();
    } else {
        echo "Hotel not found.";
        exit;
    }
}
?>

<!-- HERO -->
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_1.jpg');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
       <h1 class="mb-0 bread"><?php echo $hotel['name']; ?></h1> <!-- set hotel name -->
     </div>
   </div>
 </div>
</section>

<section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center pb-4">
      <div class="col-md-12 heading-section text-center ftco-animate">
        <span class="subheading">Our Rooms</span>
        <h2 class="mb-4">Explore Our Rooms</h2> 
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row g-4">
      <?php
      // Fetch all room details for the hotel
      $rooms_result = $conn->query("SELECT * FROM hoteldetails WHERE hotel_id = $hotel_id");

      if ($rooms_result->num_rows > 0) {
          while ($room = $rooms_result->fetch_assoc()): ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
              <div class="room-item shadow rounded overflow-hidden">
                <div class="position-relative">
                  <img class="img-fluid" src="<?php echo $room['image']; ?>" alt="">
                  <small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4"><?php echo $room['price_per_night']; ?>/Night</small>
                </div>
                <div class="p-4 mt-2">
                  <div class="justify-content-between mb-3">
                    <h5 class="mb-0"><?php echo $room['room_name']; ?></h5>
                    <div class="ps-2">
                      <small class="fa fa-star text-primary"></small>
                      <small class="fa fa-star text-primary"></small>
                      <small class="fa fa-star text-primary"></small>
                      <small class="fa fa-star text-primary"></small>
                      <small class="fa fa-star text-primary"></small>
                    </div>
                  </div>
                  <div class="mb-3">
                    <small class="border-end me-2 pe-3"><i class="fa fa-bed text-primary me-2"></i><?php echo $room['amenities_bed']; ?> Bed</small>
                    <small class="border-end me-2 pe-3"><i class="fa fa-bath text-primary me-2"></i><?php echo $room['amenities_bath']; ?> Bath</small>
                    <small><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
                  </div>
                  <p class="text-body mb-3"><?php echo $room['description']; ?></p>
                  <div class="justify-content-between">
                  <a class="btn btn-sm btn-primary rounded py-2 px-4" 
   href="booking.php?room_id=<?php echo $room['id']; ?>&room_name=<?php echo urlencode($room['room_name']); ?>&price_per_night=<?php echo $room['price_per_night']; ?>&image=<?php echo urlencode($room['image']); ?>">
   Book Now
</a>
                  </div>
                </div>
              </div>
            </div>
          <?php endwhile;
      } else {
          echo "No rooms found for this hotel.";
      }
      ?>
    </div>
  </div>
</section>

<script>
    function alertUserLogin() {
        alert("You need to login to proceed.");
        // You can redirect to the login page or perform any other action here
    }
</script>
<?php include 'footer.php'; ?>
