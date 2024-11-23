<?php
$title = 'Destination Details';  // Set the page title
include 'header.php'; // Include header
include 'db.php'; // Include database connection

// Check if the ID is passed via GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch destination details
    $query = $conn->prepare("SELECT * FROM destinations WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $destination = $result->fetch_assoc();
    } else {
        die("Destination not found.");
    }
} else {
    die("Invalid destination ID.");
}
?>

<body>
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_1.jpg');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
         <h1 class="mb-0 bread"><?php echo htmlspecialchars($destination['location']); ?></h1>
      </div>
    </div>
 </div>
</section>

<section class="ftco-section ftco-no-pt ftco-no-pb">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 ftco-animate py-md-5 mt-md-5">
        <h1><?php echo htmlspecialchars($destination['name']); ?></h1>
        <img src="<?php echo htmlspecialchars($destination['image']); ?>" alt="<?php echo htmlspecialchars($destination['name']); ?>" class="img-fluid">

        <h2>Description</h2>
        <p><?php echo nl2br(htmlspecialchars($destination['description'])); ?></p>

        <h2>Highlights</h2>
        <ul>
            <li><?php echo nl2br(htmlspecialchars($destination['highlights'])); ?></li>
        </ul>

        <h2>Itinerary</h2>
        <p><?php echo nl2br(htmlspecialchars($destination['itinerary'])); ?></p>

        <h2>What's Included</h2>
        <p><?php echo nl2br(htmlspecialchars($destination['included'])); ?></p>

        <h2>What's Excluded</h2>
        <p><?php echo nl2br(htmlspecialchars($destination['excluded'])); ?></p>

        <h2>Address</h2>
        <p><?php echo htmlspecialchars($destination['address']); ?></p>

        <h2>Map</h2>
        <?php
        $address = urlencode($destination['address']);
        $mapUrl = "https://www.google.com/maps?q=$address&output=embed";
        ?>
        <iframe src="<?php echo $mapUrl; ?>" frameborder="0" style="width: 100%; height: 300px;"></iframe>
      </div>
    </div>
  </div>
</section>

<?php
include 'chatbot.php';
include 'footer.php';
?>
</body>
</html>
