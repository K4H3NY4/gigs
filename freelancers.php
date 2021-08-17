<?php include('header-nos.php'); 
include('config/db.php');

$queryFreelancers = "SELECT * FROM `users` WHERE accountType = 'Freelancer'";
$resultFreelancers = mysqli_query($db,$queryFreelancers);
$freelancers =  mysqli_fetch_all($resultFreelancers, MYSQLI_ASSOC);


$queryCategory = "SELECT * FROM `categories` ORDER by  category ASC";
$resultCategory = mysqli_query($db,$queryCategory);
$category =  mysqli_fetch_all($resultCategory, MYSQLI_ASSOC);




?>
<div class="clearfix"></div>
<!-- Header Container / End -->

<!-- Spacer -->
<div class="margin-top-90"></div>
<!-- Spacer / End-->

<!-- Page Content
================================================== -->
<div class="container">
	<div class="row">
		<div class="col-xl-3 col-lg-4">
			<div class="sidebar-container">
				
				<!-- Location -->
				<div class="sidebar-widget">
					<h3>Location</h3>
					<div class="input-with-icon">
						<div id="autocomplete-container">
							<input id="autocomplete-input" type="text" placeholder="Location">
						</div>
						<i class="icon-material-outline-location-on"></i>
					</div>
				</div>

				<!-- Category -->
				<div class="sidebar-widget">
					<h3>Category</h3>
					<select class="selectpicker default"  data-selected-text-format="count" data-size="10" title="All Categories" >
					<?php	foreach ($category as $category): ?>
							<option value="<?php echo $category['id']; ?>"><?php echo $category['category']; ?></option>
							<?php endforeach ?>   
					</select>
				</div>

				<!-- Keywords -->
				<div class="sidebar-widget">
					<h3>Keywords</h3>
					<div class="keywords-container">
						<div class="keyword-input-container">
							<input type="text" class="keyword-input" placeholder="e.g. task title"/>
							<button class="keyword-input-button ripple-effect"><i class="icon-material-outline-add"></i></button>
						</div>
						<div class="keywords-list"><!-- keywords go here --></div>
						<div class="clearfix"></div>
					</div>
				</div>

				<!-- Hourly Rate -->
				<div class="sidebar-widget">
					<h3>Hourly Rate</h3>
					<div class="margin-top-55"></div>

					<!-- Range Slider -->
					<input class="range-slider" type="text" value="" data-slider-currency="$" data-slider-min="10" data-slider-max="250" data-slider-step="5" data-slider-value="[10,250]"/>
				</div>

				<!-- Tags -->
				<div class="sidebar-widget">
					<h3>Skills</h3>

					<div class="tags-container">
						<div class="tag">
							<input type="checkbox" id="tag1"/>
							<label for="tag1">front-end dev</label>
						</div>
						<div class="tag">
							<input type="checkbox" id="tag2"/>
							<label for="tag2">angular</label>
						</div>
						<div class="tag">
							<input type="checkbox" id="tag3"/>
							<label for="tag3">react</label>
						</div>
						<div class="tag">
							<input type="checkbox" id="tag4"/>
							<label for="tag4">vue js</label>
						</div>
						<div class="tag">
							<input type="checkbox" id="tag5"/>
							<label for="tag5">web apps</label>
						</div>
						<div class="tag">
							<input type="checkbox" id="tag6"/>
							<label for="tag6">design</label>
						</div>
						<div class="tag">
							<input type="checkbox" id="tag7"/>
							<label for="tag7">wordpress</label>
						</div>
					</div>
					<div class="clearfix"></div>

					<!-- More Skills -->
					<div class="keywords-container margin-top-20">
						<div class="keyword-input-container">
							<input type="text" class="keyword-input" placeholder="add more skills"/>
							<button class="keyword-input-button ripple-effect"><i class="icon-material-outline-add"></i></button>
						</div>
						<div class="keywords-list"><!-- keywords go here --></div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="clearfix"></div>

			</div>
		</div>
		<div class="col-xl-9 col-lg-8 content-left-offset">

			<h3 class="page-title">Search Results</h3>

	
			<!-- Freelancers List Container -->
			<div class="freelancers-container freelancers-list-layout margin-top-35">
			<?php foreach ($freelancers as $freelancer): ?>

				<!--Freelancer -->
				<div class="freelancer">

					<!-- Overview -->
					<div class="freelancer-overview">
						<div class="freelancer-overview-inner">
							
							<!-- Bookmark Icon -->
							<span class="bookmark-icon"></span>
							
							<!-- Avatar -->
							<div class="freelancer-avatar">
								<div class="verified-badge"></div>
								<a href="single-freelancer-profile.html"><img src="<?php echo $freelancer['photo']; ?>" alt=""></a>
							</div>

							<!-- Name -->
							<div class="freelancer-name">
								<h4><a href="profile.php?id=<?php echo $freelancer['id']; ?>" class="text-capitalize"><?php echo $freelancer['firstName'] .' '. $freelancer['lastName']; ?> </a></h4>
								<span><?php echo $freelancer['tagline']; ?></span>
								<!-- Rating -->
								<div class="freelancer-rating">
									<div class="star-rating" data-rating="4.9"></div>
								</div>
							</div>
						</div>
					</div>
					
					<!-- Details -->
					<div class="freelancer-details">
						<div class="freelancer-details-list">
							<ul>
								<li>Location <strong><i class="icon-material-outline-location-on"></i> <?php echo $freelancer['nationality']; ?></strong></li>
								<li>Job Success <strong>95%</strong></li>
							</ul>
						</div>
						<a href="profile.php?id=<?php echo $freelancer['id']; ?>" class="button button-sliding-icon ripple-effect">View Profile <i class="icon-material-outline-arrow-right-alt"></i></a>
					</div>
				</div>
				<!-- Freelancer / End -->
<?php endforeach ?>   
				

				<!--Freelancer -->
				<div class="freelancer">

					<!-- Overview -->
					<div class="freelancer-overview">
						<div class="freelancer-overview-inner">
							<!-- Bookmark Icon -->
							<span class="bookmark-icon"></span>
							
							<!-- Avatar -->
							<div class="freelancer-avatar">
								<a href="single-freelancer-profile.html"><img src="images/user-avatar-placeholder.png" alt=""></a>
							</div>

							<!-- Name -->
							<div class="freelancer-name">
								<h4><a href="freelancers-list-layout-2.html#">Marcin Kowalski <img class="flag" src="images/flags/pl.svg" alt="" title="Poland" data-tippy-placement="top"></a></h4>
								<span>Front-End Developer</span>
								<!-- Rating -->
								<span class="company-not-rated margin-bottom-5">Minimum of 3 votes required</span>
							</div>
						</div>
					</div>
					
					<!-- Details -->
					<div class="freelancer-details">
						<div class="freelancer-details-list">
							<ul>
								<li>Location <strong><i class="icon-material-outline-location-on"></i> Warsaw</strong></li>
								<li>Rate <strong>$50 / hr</strong></li>
								<li>Job Success <strong>100%</strong></li>
							</ul>
						</div>
						<a href="single-freelancer-profile.html" class="button button-sliding-icon ripple-effect">View Profile <i class="icon-material-outline-arrow-right-alt"></i></a>
					</div>
				</div>
				<!-- Freelancer / End -->

			
	
			</div>
			<!-- Tasks Container / End -->


			<!-- Pagination -->
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12">
					<!-- Pagination -->
					<div class="pagination-container margin-top-40 margin-bottom-60">
						<nav class="pagination">
							<ul>
								<li class="pagination-arrow"><a href="freelancers-list-layout-2.html#" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-left"></i></a></li>
								<li><a href="freelancers-list-layout-2.html#" class="ripple-effect">1</a></li>
								<li><a href="freelancers-list-layout-2.html#" class="current-page ripple-effect">2</a></li>
								<li><a href="freelancers-list-layout-2.html#" class="ripple-effect">3</a></li>
								<li><a href="freelancers-list-layout-2.html#" class="ripple-effect">4</a></li>
								<li class="pagination-arrow"><a href="freelancers-list-layout-2.html#" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
			<!-- Pagination / End -->

		</div>
	</div>
</div>

<?php include('footer.php'); ?>