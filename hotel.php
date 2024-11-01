<?php
$title = 'Hotel';
include 'header.php';
include 'db.php';
?>

<?php
    $conn = new mysqli('localhost', 'root', '', 'wanderlust');

    $result = $conn->query("SELECT * FROM hotels");
?>



<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_1.jpg');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
      <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Hotel <i class="fa fa-chevron-right"></i></span></p>
        <h1 class="mb-0 bread">Hotel</h1>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section ftco-no-pb">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="search-wrap-1 ftco-animate">
          <?php include 'search-hotel.php'; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="section-page1" class="ftco-section">
  <div class="container">
    <div class="row">
	<?php while ($row = $result->fetch_assoc()): ?>
      <div class="col-md-4 ftco-animate">
        <div class="project-wrap hotel">
          <a href="hotel-details.php?id=<?php echo $row['id']; ?>"  class="img" style="background-image: url(<?php echo $row['image']; ?>);">
            <span class="price">RM<?php echo $row['price']; ?>/per night</span>
          </a>
          <div class="text p-4">
            <p class="star mb-2">
              <span class="fa fa-star"> <?php echo $row['rating']; ?>/5</span>
            </p>
            <h3><a href="hotel-details.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></h3>
            <p class="location">  
             <span class="fa fa-map-marker" aria-hidden="true"></span>   
             <?php echo $row['destination_name']; ?>,
            <?php echo $row['location']; ?>
            </p>  
          
          </div>
        </div>
      </div>
	  <?php endwhile; ?>
      <!-- Select 6 data per page -->
    </div>
  </div>
</section>

<!-- Include Chatbot -->
<?php include 'chatbot.php';
include 'footer.php';
?>
