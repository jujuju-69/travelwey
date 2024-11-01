<?php
$title = 'Search Result';
include 'header.php';

$conn = new mysqli('localhost', 'root', '', 'wanderlust');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve search criteria from the form
$destination = isset($_GET['destination']) ? $_GET['destination'] : '';
$price_limit = isset($_GET['price_limit']) ? intval($_GET['price_limit']) : 0;

// Build the SQL query
$sql = "SELECT * FROM hotels WHERE 1=1";

if ($destination) {
    $sql .= " AND location LIKE '%" . $conn->real_escape_string($destination) . "%'";
}

if ($price_limit) {
    $sql .= " AND price <= " . $price_limit;
}

// Debugging: Output the SQL query
echo "<!-- SQL Query: $sql -->";

$result = $conn->query($sql);

// Debugging: Check if the query executed successfully
if (!$result) {
    echo "<!-- SQL Error: " . $conn->error . " -->";
}
?>

<div class="hero-wrap half-height" style="background-image: url('images/bg_5.jpg');">
    <div class="half-height overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text half-height align-items-center" data-scrollax-parent="true">
            <div class="col-md-7 ftco-animate">
                <h1 class="mb-4">Search Result</h1>
            </div>
        </div>
    </div>
</div>

<style>
    .half-height {
        height: 50vh; /* Half of the viewport height */
    }
</style>
<script>
    document.querySelector('.hero-wrap').classList.remove('js-fullheight');
</script>

<!-- SEARCH TAB FOR HOMEPAGE -->
<section class="ftco-section ftco-no-pb ftco-no-pt">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="ftco-search d-flex justify-content-center">
                    <div class="row">
                        <div class="col-md-12 tab-wrap">
                            <div class="tab-content" id="v-pills-tabContent">
                                <!-- HOTEL TAB -->
                                <div class="tab-pane fade show active" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-performance-tab">
                                    <?php include 'search-hotel.php'; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- RESULT ITEMS -->
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4 ftco-animate">
                        <div class="project-wrap hotel">
                            <a href="hotel-details.php?id=<?php echo $row['id']; ?>" class="img" style="background-image: url(<?php echo $row['image']; ?>);">
                                <span class="price">RM<?php echo $row['price']; ?></span>
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
            <?php else: ?>
                <div class="col-md-12">
                    <p>No results found for your search criteria.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
$conn->close();
include 'footer.php';
?>
