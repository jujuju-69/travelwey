<?php
$title = 'Destination';
include 'header.php';
include 'db.php';

// Get the selected state from the URL
$state = isset($_GET['state']) ? $_GET['state'] : null;

// Query data destinasi dari database
if ($state) {
    // Filter destinations by state
    $stmt = $conn->prepare("SELECT * FROM destinations WHERE location = ?");
    $stmt->bind_param("s", $state);
    $stmt->execute();
    $result = $stmt->get_result();
    $destinations = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    // Show all destinations if no state is selected
    $query = $conn->query("SELECT * FROM destinations");
    $destinations = $query->fetch_all(MYSQLI_ASSOC);
}
?>

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_1.jpg');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
         <p class="breadcrumbs">
            <span class="mr-2"><a href="index.php">Home test<i class="fa fa-chevron-right"></i></a></span> 
            <span>Tour <i class="fa fa-chevron-right"></i></span>
         </p>
         <h1 class="mb-0 bread">
            <?php echo $state ? "Tour in " . htmlspecialchars($state) : "Tour"; ?>
         </h1>
     </div>
    </div>
  </div>
</section>

<section class="ftco-section ftco-no-pb">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="search-wrap-1 ftco-animate">
          <?php include 'search-tour.php'; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="section-page1" class="ftco-section">
  <div class="container">
    <div class="row">
      <?php if (!empty($destinations)): ?>
        <?php foreach ($destinations as $destination): ?>
          <div class="col-md-4 ftco-animate">
            <div class="project-wrap">
              <a href="destination-details.php?id=<?php echo $destination['id']; ?>" class="img" style="background-image: url('<?php echo htmlspecialchars($destination['image']); ?>');"></a>
              <div class="text p-4">
                <span class="days">Come Join Us</span>
                <h3><a href="destination-details.php?id=<?php echo $destination['id']; ?>"><?php echo htmlspecialchars($destination['name']); ?></a></h3>
                <p class="location"><span class="fa fa-map-marker"></span> <?php echo htmlspecialchars($destination['location']); ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-md-12">
          <p class="text-center">
            <?php echo $state ? "No destinations found for \"" . htmlspecialchars($state) . "\"." : "No destinations available at the moment. Please check back later!"; ?>
          </p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<section id="section-page2" class="ftco-section" style="display: none;">
  <div class="container">
    <div class="row">
      <!-- Placeholder for additional content (if required) -->
      <div class="col-md-4 ftco-animate">
        <div class="project-wrap">
          <a href="destination-details.php" class="img" style="background-image: url(images/destination-2.jpg);"></a>
          <div class="text p-4">
            <span class="days">10 Days Tour</span>
            <h3><a href="destination-details.php">Banaue Rice Terraces</a></h3>
            <p class="location"><span class="fa fa-map-marker"></span> Banaue, Ifugao, Philippines</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section">
  <div class="container">
    <div class="row mt-5">
      <div class="col text-center">
        <div class="block-27">
          <ul>
            <li><a href="javascript:void(0);" onclick="navigatePage(-1)">&lt;</a></li>
            <li><a href="javascript:void(0);" onclick="showPage('page1')">1</a></li>
            <li><a href="javascript:void(0);" onclick="showPage('page2')">2</a></li>
            <li><a href="javascript:void(0);" onclick="navigatePage(1)">&gt;</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Include Chatbot -->
<?php 
include 'chatbot.php';
include 'footer.php';
?>

<script>
  var currentPage = 1; // Track current page
  const totalPages = 2; // Total number of pages

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
    const newPage = currentPage + direction;
    if (newPage >= 1 && newPage <= totalPages) {
      showPage('page' + newPage);
    }
  }
</script>
