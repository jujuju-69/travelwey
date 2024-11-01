<?php
$title = 'Search Result';
include 'header.php';
?>
	
	<div class="hero-wrap half-height" style="background-image: url('images/bg_5.jpg');">
		<div class="half-height overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text half-height align-items-center" data-scrollax-parent="true">
				<div class="col-md-7 ftco-animate">
					<h1 class="mb-3">Search Result</h1>
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

<!-- RESULT ITEMS -->
<section class="ftco-section">
   <div class="container">
    <div class="row">
       <div class="col-md-4 ftco-animate">
          <div class="project-wrap">
             <a href="#" class="img" style="background-image: url(images/destination-1.jpg);">
                <span class="price">$550/person</span>
            </a>
            <div class="text p-4">
                <span class="days">8 Days Tour</span>
                <h3><a href="#">Banaue Rice Terraces</a></h3>
                <p class="location"><span class="fa fa-map-marker"></span> Banaue, Ifugao, Philippines</p>
                <ul>
                   <li><span class="flaticon-shower"></span>2</li>
                   <li><span class="flaticon-king-size"></span>3</li>
                   <li><span class="flaticon-mountains"></span>Near Mountain</li>
               </ul>
           </div>
       </div>
   </div>

</div>
<div class="row mt-5">
  <div class="col text-center">
    <div class="block-27">
      <ul>
        <li><a href="#">&lt;</a></li>
        <li class="active"><span>1</span></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#">&gt;</a></li>
    </ul>
</div>
</div>
</div>
</div>
</section>

    
<?php
include 'footer.php';
?>