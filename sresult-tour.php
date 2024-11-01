<?php
$title = 'Search Result';
include 'header.php'; // Include your header file

// Include database connection file
include 'db.php'; // Adjust path as necessary

// Initialize variables
$name = isset($_GET['name']) ? mysqli_real_escape_string($conn, $_GET['name']) : '';
$location = isset($_GET['location']) ? mysqli_real_escape_string($conn, $_GET['location']) : '';

// Construct SQL query with search criteria
$query = "SELECT * FROM destinations WHERE 1=1";

if (!empty($name)) {
    $query .= " AND name LIKE '%$name%'";
}

if (!empty($location)) {
    $query .= " AND location LIKE '%$location%'";
}


$result = mysqli_query($conn, $query);

?>

<section class="hero-wrap half-height" style="background-image: url('images/bg_5.jpg');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text half-height align-items-center" data-scrollax-parent="true">
      <div class="col-md-7 ftco-animate">
        <h1 class="mb-3">Search Result</h1>
      </div>
    </div>
  </div>
</section>

<style>
  .half-height {
    height: 50vh; /* Half of the viewport height */
  }
</style>

<section id="section-page1" class="ftco-section">
  <div class="container">
    <div class="row">
      <?php
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<div class="col-md-4 ftco-animate">';
          echo '<div class="project-wrap">';
          echo '<a href="destination-details.php?id=' . $row['id'] . '" class="img" style="background-image: url(' . $row['image'] . ');">';
          echo '</a>';
          echo '<div class="text p-4">';
          echo '<h3><a href="destination-details.php?id=' . $row['id'] . '">' . $row['name'] . '</a></h3>';
          echo '<p class="location"><span class="fa fa-map-marker"></span> ' . $row['location'] . '</p>';
          // Additional fields can be displayed similarly
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }
      } else {
        echo '<div class="col-md-12">';
        echo '<p>No results found.</p>';
        echo '</div>';
      }
      ?>
    </div>
  </div>
</section>

<?php
// Free result set
mysqli_free_result($result);

// Close database connection
mysqli_close($conn);

// Include your footer file
include 'footer.php';
?>