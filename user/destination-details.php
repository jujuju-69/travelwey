<?php
$title = 'Destination Details';  // set destination/tour title
include 'header.php';
include 'db.php';
$id = $_GET['id'];


// Fetch destination details
$query = $conn->prepare("SELECT * FROM destinations WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$destination = $query->get_result()->fetch_assoc();

// Fetch hotels based on destination name for more specific results
$destination_name = $destination['name'];
$hotelsQuery = $conn->prepare("SELECT * FROM hotels WHERE destination_name = ?");
$hotelsQuery->bind_param("s", $destination_name);
$hotelsQuery->execute();
$hotels = $hotelsQuery->get_result()->fetch_all(MYSQLI_ASSOC);

?>
<body>
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_1.jpg');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
         <h1 class="mb-0 bread"><?php echo $destination['location']; ?></h1>
      </div>
    </div>
 </div>
</section>

<!-- DETAILS -->
<section class="ftco-section ftco-no-pt ftco-no-pb">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 ftco-animate py-md-5 mt-md-5">
        <div class="header">
            <h1><?php echo $destination['name']; ?> </h1>
      </div>
          
        <img src="<?php echo $destination['image']; ?>" alt="<?php echo $destination['name']; ?>" class="img-fluid1">

        <div>
             <h2>Description</h2>
             <div class="description">
            <p><?php echo $destination['description']; ?></p>
            </div>
        </div>
		
        <div>
            <h2>Pros and Cons</h2>
            <div class="included-excluded">
                <div class="included">
                    <ul>
                        <li><i class="fa fa-check"></i><?php echo $package['included']; ?></li>
                    </ul>
                </div> 
                <div class="excluded">
                    <ul>
                        <li><i class="bi bi-x-square-fill"></i><?php echo $package['excluded']; ?></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="itinerary">
            <h2>Suggestion Trip</h2>
            <div class="accordion">
                <div class="accordion-item">
                    <button class="btn btn-primary accordion-button">Day 1: Tea and Highland Exploration .<i class="bi bi-chevron-down"></i></button>
                    <div class="accordion-content">
                        <p><?php echo $destination['itinerary']; ?></p>
                    </div>
                </div>
                <div class="accordion-item">
                    <button class="btn btn-primary accordion-button">Day 2: Farms, Flowers, and History .
                    <i class="bi bi-chevron-down"></i></button>
                    <div class="accordion-content">
                        <p>Begin your adventure with thrilling activities.</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <button class="btn btn-primary accordion-button">Day 3: Nature and Departure<i class="bi bi-chevron-down"></i></button>
                    <div class="accordion-content">
                        <p>Delve into the rich history of the area.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="attractions">  
    <div class="attraction-cards">  
        <div class="card">  
            <img src="images/sungaipalas.png" alt="SungaiPalas">  
            <div class="card-content">  
                <h3>BOH’s Sungei Palas Tea Garden</h3>  
                <p>BOH’s Sungei Palas Tea Garden  is excited to introduce a range of packages designed to offer our visitors unforgettable experiences....</p>  
            </div>  
        </div>  
        <div class="card">  
            <img src="images/cameronflorapark.jpg" alt="CameronFloraPark">  
            <div class="card-content">  
                <h3>Cameron Highlands Flora Park</h3>  
                <p>Looking for a unique one-of-a-kind insta-worthy spot for your next post? Fret not! Cameron Highlands Flora Park has got you covered!...</p>  
            </div>  
        </div>  

        <div class="card">  
            <img src="images/cameronlavender.jpg" alt="CameronLavender">  
            <div class="card-content">  
                <h3>Lavender Garden (Cameron Lavender)</h3>  
                <p>Cameron Lavender Garden is a lavender-themed shopping and agricultural complex situated between Tringkap and Kuala Terla, about 4km north of Kea Farm in Brinchang along the main road....</p>  
            </div>  
        </div>  
        <!-- Add more cards as needed -->  
    </div>  
    
</div>

        <div class="highlights">
            <h2>Highlights of the Tour</h2>
            <ul>
                <li><i class="bi bi-bookmark-star-fill"></i> <?php echo $destination['highlights']; ?></li>
            </ul>
        </div>

        <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                
                <!-- pull >4 data from databse, select destination and calc total of tour existed from tour table -->
            </div>
        </div>
    </div>
    <div class="container-1">
        <div class="carousel-1">
            <img class="item" src="images/cactusvalley.png" alt="CactusValley">
            <img class="item" src="images/keafarmMart.png" alt="KeaFarmMart">
            <img class="item" src="images/cameronfloraparkkk.png" alt="CameronFloraPark">
            <img class="item" src="images/mossyforest2.png" alt="MossyForest">
            <img class="item" src="images/bohteagarden.png" alt="BohTeaGarden">
            <img class="item" src="images/glampingstellar.png" alt="BohTeaGarden">
        </div>
    </div>

        <!-- Famous place -->
        <section class="ftco-section">
  <div class="container">
    <div class="row d-flex">
      <div class="col-md-4 d-flex ftco-animate">
       <div class="blog-entry justify-content-end">
        <a href="blog-single.php" class="block-20" style="background-image: url('images/lordcafe.png');">
        </a>
        <div class="text">
         <div class="d-flex align-items-center mb-4 topp">
          <div class="one">
           <span class="day">1</span>
         </div>
         <div class="two">
           
           <span class="mos"> English snack bar</span>
         </div>
       </div>
       <h3 class="heading"><a href="#">The Lord's Cafe</a></h3>
       <p>The Lord's Cafe is famous for their freshly made scones, which are light and airy.</p>
       <p><a href="#" class="btn btn-primary">Read more</a></p>
     </div>
   </div>
 </div>
 <div class="col-md-4 d-flex ftco-animate">
   <div class="blog-entry justify-content-end">
    <a href="" class="block-20" style="background-image: url('images/unclechow.jpg');">
    </a>
    <div class="text">
     <div class="d-flex align-items-center mb-4 topp">
      <div class="one">
       <span class="day">2</span>
     </div>
     <div class="two">
     
       <span class="mos">Malaysian-style coffee shop</span>
     </div>
   </div>
   <h3 class="heading"><a href="#">Uncle Chow Kopitiam Cameron Highlands</a></h3>
   <p>The coffee shop has a modern and comfortable interior with many food options to offer.</p>
   <p><a href="#" class="btn btn-primary">Read more</a></p>
 </div>
</div>
</div>
<div class="col-md-4 d-flex ftco-animate">
 <div class="blog-entry">
  <a href="blog-single.php" class="block-20" style="background-image: url('images/bungasuria.jpg');">
  </a>
  <div class="text">
   <div class="d-flex align-items-center mb-4 topp">
    <div class="one">
     <span class="day">3</span>
   </div>
   <div class="two">
     <span class="mos">Malaysian & Indian Cuisine</span>
   </div>
 </div>
 <h3 class="heading"><a href="#">Restaurant Bunga Suria</a></h3>
 <p>Best authentic indian and malaysian cuisine at Cameron Highlands.</p>
 <p><a href="#" class="btn btn-primary">Read more</a></p>
</div>
</div>
</div>
<div class="col-md-4 d-flex ftco-animate">
 <div class="blog-entry">
  <a href="blog-single.php" class="block-20" style="background-image: url('images/bakeCafe.jpg');">
  </a>
  <div class="text">
   <div class="d-flex align-items-center mb-4 topp">
    <div class="one">
     <span class="day">4</span>
   </div>
   <div class="two">

     <span class="mos">Pizza, Cafe, Asian, Grill, Diner, Malaysian</span>
   </div>
 </div>
 <h3 class="heading"><a href="#">Bake an Cafe</a></h3>
 <p>Local cuisine with a western touch. Meals based on your Budget.We uses the freshest and Halal Quality ingredients. Our customers health and safety is our top most priority.</p>
 <p><a href="#" class="btn btn-primary">Read more</a></p>
</div>
</div>
</div>
<div class="col-md-4 d-flex ftco-animate">
 <div class="blog-entry">
  <a href="blog-single.php" class="block-20" style="background-image: url('images/kambingbakargunting.jpg');">
  </a>
  <div class="text">
   <div class="d-flex align-items-center mb-4 topp">
    <div class="one">
     <span class="day">5</span>
   </div>
   <div class="two">

     <span class="mos">Asian, Malaysian</span>
   </div>
 </div>
 <h3 class="heading"><a href="#">Kambing Bakar Gunting</a></h3>
 <p>Our Restaurant offers a unique blend of local cuisine enhanced with a touch of western culinary art.</p>
 <p><a href="https://www.tripadvisor.com.my/Restaurant_Review-g1497917-d23142727-Reviews-Kambing_Bakar_Gunting-Tanah_Rata_Cameron_Highlands_Pahang.html" class="btn btn-primary">Read more</a></p>
</div>
</div>
</div>
<div class="col-md-4 d-flex ftco-animate">
 <div class="blog-entry">
  <a href="blog-single.php" class="block-20" style="background-image: url('images/hometaste.jpg');">
  </a>
  <div class="text">
   <div class="d-flex align-items-center mb-4 topp">
    <div class="one">
     <span class="day">6</span>
   </div>
   <div class="two">
    
     <span class="mos">Chinese Asian Malaysian</span>
   </div>
 </div>
 <h3 class="heading"><a href="#">Home Taste Restoran</a></h3>
 <p>Old style traditional NO MSG HOME COOK FINE DINING chinese restaurant in Cameron highland.</p>
 <p><a href="https://www.tripadvisor.com.my/Restaurant_Review-g298293-d26860318-Reviews-Home_Taste_Restoran-Brinchang_Cameron_Highlands_Pahang.html" class="btn btn-primary">Read more</a></p>
</div>
</div>
</div>
</div>

</section>
  
        

        <div class="location">
            
            <h2>Location Map</h2>
            <div class="map-container mt-3">
            <?php
            // Fetch the location address from the database result
            $address = $destination['address'];
            
            // Encode the address for use in the URL
            $encodedAddress = urlencode($address);

            // URL for the Google Maps Embed
            $mapUrl = "https://www.google.com/maps?q=$encodedAddress&output=embed";
            ?>

            <!-- Embed the Google Map in an iframe -->
            <iframe
                id="map"
                frameborder="0"
                style="border:0"
                src="<?php echo $mapUrl; ?>"
                allowfullscreen>
            </iframe>
            </div>
        </div>

       <!-- Display Hotels -->
<div class="hotels">
    <h2>Hotels in <?php echo htmlspecialchars($destination['name']); ?></h2>
    <?php if (count($hotels) > 0): ?>
        <div class="row">
            <?php foreach ($hotels as $hotel): ?>
                <div class="col-md-4 ftco-animate">
                    <div class="project-wrap">
                        <a href="hotel-details.php?id=<?php echo $hotel['id']; ?>" class="img" style="background-image: url('<?php echo $hotel['image']; ?>');">
                        </a>
                        <div class="text p-4">
                            <h3><a href="hotel-details.php?id=<?php echo $hotel['id']; ?>"><?php echo htmlspecialchars($hotel['name']); ?></a></h3>
                            <p><?php echo $hotel['rating']; ?> Stars</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No hotels available in this location.</p>
    <?php endif; ?>
</div>

    
   
</section>

<!-- ACTIVITY -->
<section class="ftco-section img" style="background-image: url(images/bg_3.jpg);">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <h2 class="mb-4">Popular <span style="font-weight:bold; color:#f15d30;">Activities</span> To Do</h2> 
                <!-- pull >4 data from databse, select destination and calc total of tour existed from tour table -->
            </div>
        </div>
    </div>
    <div class="container-1">
        <div class="carousel-1">
            <img class="item" src="https://images.pexels.com/photos/21927155/pexels-photo-21927155/free-photo-of-madera-amanecer-paisaje-agua.jpeg" alt="">
            <img class="item" src="https://images.pexels.com/photos/22027165/pexels-photo-22027165/free-photo-of-nieve-nevar-paisaje-puesta-de-sol.jpeg" alt="">
            <img class="item" src="https://images.pexels.com/photos/22377281/pexels-photo-22377281/free-photo-of-madera-paisaje-agua-verano.jpeg" alt="">
            <img class="item" src="https://images.pexels.com/photos/22447657/pexels-photo-22447657/free-photo-of-madera-paisaje-agua-verano.jpeg" alt="">
            <img class="item" src="https://images.pexels.com/photos/13673325/pexels-photo-13673325.jpeg" alt="">
        </div>
    </div>
</section>

<!-- Include Chatbot -->
<?php include 'chatbot.php';
include 'footer.php';
?>

<style>
@import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css");

.attractions {  
    text-align: center;  
    padding: 20px;  
}  

.attraction-cards {  
    display: flex;  
    justify-content: center;  
    gap: 20px;  
    flex-wrap: wrap;  
    padding: 20px;  
}  

.card {  
    background-color: #fff;  
    border-radius: 10px;  
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  
    overflow: hidden;  
    width: 300px;  /* Adjust width for a more spacious look */  
    text-align: left;  
    transition: transform 0.3s ease, box-shadow 0.3s ease;  
    margin: 10px;  
}  

.card:hover {  
    transform: translateY(-5px);   
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);   
}  

.card img {  
    width: 100%;  
    height: 180px;  /* Set a fixed height for uniformity */  
    object-fit: cover;  
}  

.card-content {  
    padding: 15px;  
} 

.card-content h3 {  
    margin: 0 0 10px;  
    font-size: 1.2em;  
    line-height: 1.2;  
    color: #2c3e50;  
}  

.card-content p {  
    margin: 0;  
    color: #555;  
    font-size: 0.9em;  
    line-height: 1.4;  
    max-height: 60px;  /* Limit height to keep cards uniform */  
    overflow: hidden;  
    text-overflow: ellipsis;  
    white-space: normal;  
}  

.view-more {  
    margin-top: 10px;  
    padding: 5px 10px;  
    background-color: #27ae60;  
    color: #fff;  
    border: none;  
    border-radius: 5px;  
    cursor: pointer;  
    display: block;  /* Make it a block element for full-width */  
    text-align: center;  
} 

.img-fluid {  
    display: block; /* Ensures the margin is applied correctly */  
    margin-bottom: 50px; /* Adds space below the image */  
}  



.map-container {  
    width: 100%; /* Use full width of parent container */  
    height: 600px; /* Increased height for better visibility */  
    margin-bottom: 20px;  
    position: relative; /* Adjust for responsive positioning if needed */  
} 

iframe#map {  
    width: 100%; /* Ensure the iframe takes the full width of the container */  
    height: 100%; /* Match the iframe height to the container */  
    border: 0; 
    padding-bottom: 100px; 
}  

.header {
    text-align: center;
    margin-bottom: 20px;
}

.header h1 {
    color: #27ae60;
    margin: 0;
    font-size: 2em;
}

.header del {
    color: #e74c3c;
}

.header p {
    color: #7f8c8d;
}

.description, .included-excluded, .highlights, .itinerary, .location {
    margin-bottom: 10px;
}

h1 {  
    color: #2c5f2d; /* Deep forest green */  
    font-size: 2.5em;  
    text-align: center;  
    margin-top: 20px;  
    font-weight: bold;  
    text-transform: uppercase;  
} 

h2 {  
    color: #2c3e50; /* Dark gray for better contrast */  
    text-align: center;  
    margin-bottom: 20px;  
} 

.included-excluded {
    display: flex;
    justify-content: center;
}

.included-excluded .included, .included-excluded .excluded {
    width: 45%;
}

.included-excluded ul {
    list-style: none;
    padding: 0;
}

.included-excluded ul li {
    color: #27ae60;
    margin-bottom: 10px;
}

.included-excluded ul li i {
    color: #27ae60;
    margin-right: 10px;
}

.included-excluded .excluded ul li {
    color: #e74c3c;
}

.included-excluded .excluded ul li i {
    color: #e74c3c;
}

.highlights ul {
    list-style: none;
    padding: 0;
}

.highlights ul li {
    color: #f39c12;
    margin-bottom: 10px;
}

.highlights ul li i {
    color: #f39c12;
    margin-right: 10px;
}

.accordion {
    margin-bottom: 20px;
}

.accordion .accordion-item {
    margin-bottom: 10px;
}

.accordion .accordion-button {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    background-color: #2980b9;
    color: white;
    border: none;
    cursor: pointer;
    width: 100%;
}

.accordion .accordion-content {
    display: none;
    padding: 10px;
    background-color: #ecf0f1;
    border: 1px solid #bdc3c7;
    
}

.map-container {
    width: 100%;
    height: 700px;
    margin-bottom: 24px;
}

.hotels {
    margin-top: 20px;
}

.project-wrap {
    background: #fff;
    border-radius: 10px;
  
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
    transition: all 0.3s ease;
}

.project-wrap:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 30px rgba(0, 0, 0, 0.2);
}

.project-wrap .img {
    position: relative;
    width: 100%;
    height: 250px;
    background-size: cover;
    background-position: center;
}

.project-wrap .price {
    position: absolute;
    bottom: 10px;
    right: 10px;
    background: #27ae60;
    color: #fff;
    padding: 5px 10px;
    border-radius: 5px;
}

.project-wrap .text {
    padding: 20px;
}

.project-wrap .text h3 {
    margin: 0;
    font-size: 1.5em;
    color: #2c3e50;
}

.project-wrap .text p {
    color: #7f8c8d;
}

body {  
    /* Removed centered flex properties as it should not apply globally */  
    margin: 0;  
    font-family: 'Arial', sans-serif;  
    background-color: #f5f5f5; /* Light neutral background */  
}  

 
.included-excluded {  
    display: flex;  
    gap: 40px; /* Space between included and excluded sections */  
}  

.included-excluded ul {  
    padding: 0;  
    list-style: none;  
}  

.included-excluded ul li {  
    margin-bottom: 10px; /* Space between list items */  
    line-height: 1.6; /* Ensures readability */  
    padding: 10px;  
    border-radius: 5px;  
}  

.included-excluded .included ul li {  
    background-color: #e6f4ea; /* Light green background */  
    color: #2e7d32; /* Dark green text */  
}  

.included-excluded .excluded ul li {  
    background-color: #fce8e6; /* Light red background */  
    color: #c62828; /* Dark red text */  
}  

.included-excluded .included ul li i,  
.included-excluded .excluded ul li i {  
    margin-right: 10px;  
}


.description {  
    font-size: 1.1em;  
    color: #555; /* Soft gray for readability */  
    line-height: 1.6;  
    margin: 20px auto;  
    max-width: 800px;  
    text-align: center;  
    font-family: 'Arial', sans-serif; /* Friendly font */  
    margin-top: 20px; /* Only needed if further separation between image and content is desired */  
}


.container {  
    max-width: 1200px; /* Define a max width */  
    margin: 0 auto; /* Center the container */  
    padding: 20px;  
}  

.row {  
    display: flex;  
    justify-content: center; /* Center content horizontally */  
    align-items: center; /* Center content vertically */  
    flex-wrap: wrap; /* Allow wrapping if needed */  
}  

.col-lg-8 {  
    flex: 0 0 100%; /* Ensure full width on smaller screens */  
    max-width: 100%;  
    text-align: center; /* Center text within columns */  
}  

.img-fluid1 {  
    max-width: 100%;  
    height: auto;  
    display: block;  
    margin: 20px auto;  
    border-radius: 10px;  
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow */  
    border: 2px solid #ddd; /* Light border */  
}

.accordion-button {  
    background-color: #34495e; /* Soft navy blue */  
    color: #ffffff; /* White text for contrast */  
    border: none;  
    padding: 10px;  
    text-align: left;  
    width: 100%;  
    cursor: pointer;  
    transition: background-color 0.3s ease;  
} 

.accordion-button:hover {  
    background-color: #2c3e50; /* Darker shade on hover */  
}  

.btn-primary {  
    background-color: #add8e6; /* Light blue */  
    color: #333; /* Dark text for contrast */  
    border: none;  
    padding: 10px 20px;  
    border-radius: 5px;  
    transition: background-color 0.3s ease;  
}  

.btn-primary:hover {  
    background-color: #87ceeb; /* Slightly darker on hover */  
}  

.view-more:hover {  
    background-color: #2ecc71;  /* Slight change of color on hover */  
}




</style>
</body>