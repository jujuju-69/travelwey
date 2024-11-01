<?php
$title = 'Search Result';
include 'header.php';
include 'db.php'; 

// Initialize variables for the search criteria
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

// Execute the query
$result = mysqli_query($conn, $query);
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
                                <!-- TOUR TAB -->
                                <div class="tab-pane fade show active" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-performance-tab">
                                    <?php include 'search-tour.php'; ?>
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
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="col-md-4 ftco-animate">
                        <div class="project-wrap hotel">
                            <a href="destination-details.php?id=<?php echo $row['id']; ?>" class="img" style="background-image: url(<?php echo $row['image']; ?>);">
                                <!--<span class="price">RM<?php echo $row['price']; ?></span> -->
                            </a>
                            <div class="text p-4">
                                <!--<p class="star mb-2">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </p> -->
                                <h3><a href="destination-details.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></h3>
                                <p class="location"><span class="fa fa-map-marker"></span> <?php echo $row['location']; ?></p>
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
