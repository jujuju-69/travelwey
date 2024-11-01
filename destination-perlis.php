<?php
$title = 'Destination';
include 'header.php';
include 'db.php';

// Modify the query to filter destinations by location 'Perlis'
$query = $conn->query("SELECT * FROM destinations WHERE location = 'Perlis'");
$destinations = $query->fetch_all(MYSQLI_ASSOC);
?>

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_1.jpg');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
         <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Tour<i class="fa fa-chevron-right"></i></span></p>
         <h1 class="mb-0 bread">Tour in Perlis</h1>
     </div>
    </div>
  </div>
</section>

<section id="section-page1" class="ftco-section">
  <div class="container">
    <div class="row">
      <?php if (count($destinations) > 0): ?>
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
      <?php else: ?>
        <div class="col-md-12 ftco-animate text-center">
          <p>No destinations found in Perlis.</p> <!-- Updated message -->
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- Include Chatbot -->
<?php include 'chatbot.php';
include 'footer.php';
?>

<script>
  var currentPage = 1; // Track current page

  function showPage(page) {
    if (page === 'page1') {
      document.getElementById('section-page1').style.display = 'block';
      document.getElementById('section-page2').style.display = 'none';
      currentPage = 1;
    } else if (page === 'page2') {
      document.getElementById('section-page1').style.display = 'none';
      document.getElementById('section-page2').style.display = 'block';
      currentPage = 2;
    }
  }

  function navigatePage(direction) {
    if (direction === -1 && currentPage > 1) {
      showPage('page' + (currentPage - 1));
    } else if (direction === 1 && currentPage < 2) {
      showPage('page' + (currentPage + 1));
    }
  }
</script>
