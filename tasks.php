<?php include('header-nos.php'); 
include('config/db.php');
include('time.php');

$current_time = time();

$time_30 =strtotime($current_time);
$day2 =$current_time - 2600640;

//var_dump($current_time);
//var_dump($day2);
$day30 = date ('Y-m-d', $day2);
//var_dump($day30);
//echo strtotime("-30 day");

//2600640;

$queryCategory = "SELECT * FROM `categories` ORDER by  category ASC";
$resultCategory = mysqli_query($db,$queryCategory);
$category =  mysqli_fetch_all($resultCategory, MYSQLI_ASSOC);

$n= 12;
$sql1 = "SELECT count(*) FROM `tasks` ";
$result = mysqli_query($db,$sql1);
$array = $result ->fetch_array();
$total_row_number = $array['count(*)'];

$total_button_number = ceil($total_row_number/$n);
/*
for ($i=1;$i<=$total_button_number;$i++){
	echo '<li><a href="./tasks.php?current_page='.$i.'" class="ripple-effect">'.$i.'</a></li>';
	
}
*/

if (empty($_GET['current_page'])){
	$page = 1;
}else{
	$_GET['current_page'] = (int) $_GET['current_page'];
//	var_dump($_GET['current_page']);
	if ($_GET['current_page']> 0 && $_GET['current_page'] <=$total_button_number){
		$page = $_GET['current_page'];
	}else{
		$page = 1;
	}

} 

$m = ($page-1) * $n;




if(isset($_POST['filter'])){

		$searchid =  mysqli_real_escape_string ($db, $_POST['category']);
		$keywords =  mysqli_real_escape_string ($db, $_POST['keywords']);
	

		if( $searchid > 0){
			$queryTasks = "SELECT * FROM `tasks`  WHERE created_at > NOW() - INTERVAL 30 DAY AND  category = '$searchid'  ORDER by  created_at   DESC LIMIT $m, $n";
			$resultTasks = mysqli_query($db,$queryTasks);
			$tasks =  mysqli_fetch_all($resultTasks, MYSQLI_ASSOC);

		}else if($searchid == 0){
			$queryTasks = "SELECT * FROM `tasks` WHERE created_at > NOW() - INTERVAL 30 DAY    ORDER by  created_at DESC  LIMIT $m, $n";
			$resultTasks = mysqli_query($db,$queryTasks);
			$tasks =  mysqli_fetch_all($resultTasks, MYSQLI_ASSOC);

		}
		
 

 
}else{
	$queryTasks = "SELECT * FROM `tasks` WHERE created_at > NOW() - INTERVAL 30 DAY ORDER BY created_at DESC  LIMIT $m, $n";
	$resultTasks = mysqli_query($db,$queryTasks);
	$tasks =  mysqli_fetch_all($resultTasks, MYSQLI_ASSOC);
	

}
 
 

?>



<div class="clearfix"></div>
<!-- Header Container / End -->

<!-- Page Content
================================================== -->
<div class="full-page-container">

	<div class="full-page-sidebar">
	<form action="" method="POST">
		<div class="full-page-sidebar-inner" data-simplebar>
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
					<select class="selectpicker default" name="category"  data-selected-text-format="count" data-size="7" title="All Categories" >					<option value="0">All Categories</option>
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
						<input type="text" class="keyword-input" name="keywords" placeholder="e.g. task title"/>
							<button class="keyword-input-button ripple-effect"><i class="icon-material-outline-add"></i></button>
						</div>
						<div class="keywords-list"><!-- keywords go here --></div>
						<div class="clearfix"></div>
					</div>
				</div>

				<!-- Budget -->
				<div class="sidebar-widget">
					<h3>Budget</h3>
					<div class="margin-top-55"></div>

					<!-- Range Slider -->
					<input class="range-slider" type="text" value="" data-slider-currency="Ksh" data-slider-min="10" data-slider-max="2500" data-slider-step="25" data-slider-value="[50,2500]"/>
				</div>

			

			
				<div class="clearfix"></div>

				<div class="margin-bottom-40"></div>

			</div>
			<!-- Sidebar Container / End -->

			<!-- Search Button -->
			<div class="sidebar-search-button-container">
			<button class="button button-sliding-icon ripple-effect" type="submit" name="filter"> Filter </button>
			</div>
			<!-- Search Button / End-->

		</div>

		
	
				</form>
	</div>
	<!-- Full Page Sidebar / End -->
	
	<!-- Full Page Content -->
	<div class="full-page-content-container" data-simplebar>
		<div class="full-page-content-inner">

			<h3 class="page-title">Search Results</h3>

			<div class="notify-box margin-top-15">
				<div class="switch-container">
					<label class="switch"><input type="checkbox"><span class="switch-button"></span><span class="switch-text">Turn on email alerts for this search</span></label>
				</div>

				<div class="sort-by">
					<span>Sort by:</span>
					<select class="selectpicker hide-tick">
						<option>Relevance</option>
						<option>Newest</option>
						<option>Oldest</option>
						<option>Random</option>
					</select>
				</div>
			</div>

			<!-- Tasks Container -->
			<div class="tasks-list-container tasks-grid-layout margin-top-35">
				
			
				 
				<?php foreach ($tasks as $task): ?>

				<!-- Task -->
				<a href="task.php?ref=<?php echo $task['ref']; ?>" class="task-listing">


					<!-- Job Listing Details -->
					<div class="task-listing-details">

						<!-- Details -->
						<div class="task-listing-description">
						<h3 class="task-listing-title text-capitalize"><?php echo  $task['title']; ?></h3>
							<ul class="task-icons">
							<li class=""><i class="icon-material-outline-location-on"></i><?php echo  $task['location']; ?></li>
							<li class="" align="right"><i class="icon-material-outline-access-time "></i>  <?php
								$time_ago =strtotime($task['created_at']);
								echo ' ';
								echo timeAgo($time_ago);
							
							?></li>
							</ul>
						</div>

					</div>

					<div class="task-listing-bid">
						<div class="task-listing-bid-inner">
							<div class="task-offers">
							<strong>Ksh <?php echo  $task['minBudget']; ?> - Ksh <?php echo  $task['maxBudget']; ?></strong>
							<span>Project Budget</span>
							</div>
							<span class="button button-sliding-icon ripple-effect">Bid Now <i class="icon-material-outline-arrow-right-alt"></i></span>
						</div>
					</div>
				</a>
				<?php endforeach ?>   

				

				

			



			
			</div>
			<!-- Tasks Container / End -->

			<!-- Pagination -->
			<div class="clearfix"></div>
			<div class="pagination-container margin-top-20 margin-bottom-20">
				<nav class="pagination">
					<ul>
						<li class="pagination-arrow"><a href="#" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-left"></i></a></li>
						<?php 
							for ($i=1;$i<=$total_button_number;$i++){
								echo '<li><a href="./tasks.php?current_page='.$i.'" class="ripple-effect">'.$i.'</a></li>';
							}
						?>
			
						<li class="pagination-arrow"><a href="#" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
					</ul>
				</nav>
			</div>
			<div class="clearfix"></div>
			<!-- Pagination / End -->

			<!-- Footer -->
			<div class="small-footer margin-top-15">
				<div class="small-footer-copyrights">
					© 2021 <strong>Hireo</strong>. All Rights Reserved.
				</div>
				<ul class="footer-social-links">
					<li>
						<a href="tasks-grid-layout-full-page.html#" title="Facebook" data-tippy-placement="top">
							<i class="icon-brand-facebook-f"></i>
						</a>
					</li>
					<li>
						<a href="tasks-grid-layout-full-page.html#" title="Twitter" data-tippy-placement="top">
							<i class="icon-brand-twitter"></i>
						</a>
					</li>
					<li>
						<a href="tasks-grid-layout-full-page.html#" title="Google Plus" data-tippy-placement="top">
							<i class="icon-brand-google-plus-g"></i>
						</a>
					</li>
					<li>
						<a href="tasks-grid-layout-full-page.html#" title="LinkedIn" data-tippy-placement="top">
							<i class="icon-brand-linkedin-in"></i>
						</a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<!-- Footer / End -->

		</div>
	</div>
	<!-- Full Page Content / End -->

</div>


</div>
<!-- Wrapper / End -->

<!-- Scripts
================================================== -->
<script src="js/jquery-3.4.1.min.js"></script>
<script src="http://www.vasterad.com/themes/hireo/js/jquery-migrate-3.1.0.min.js"></script>
<script src="js/mmenu.min.js"></script>
<script src="js/tippy.all.min.js"></script>
<script src="js/simplebar.min.js"></script>
<script src="js/bootstrap-slider.min.js"></script>
<script src="js/bootstrap-select.min.js"></script>
<script src="js/snackbar.js"></script>
<script src="js/clipboard.min.js"></script>
<script src="js/counterup.min.js"></script>
<script src="js/magnific-popup.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/custom.js"></script>

<!-- Snackbar // documentation: https://www.polonel.com/snackbar/ -->
<script>
// Snackbar for user status switcher
$('#snackbar-user-status label').click(function() { 
	Snackbar.show({
		text: 'Your status has been changed!',
		pos: 'bottom-center',
		showAction: false,
		actionText: "Dismiss",
		duration: 3000,
		textColor: '#fff',
		backgroundColor: '#383838'
	}); 
}); 
</script>

<!-- Google Autocomplete -->
<script>
	function initAutocomplete() {
		 var options = {
		  types: ['(cities)'],
		  // componentRestrictions: {country: "us"}
		 };

		 var input = document.getElementById('autocomplete-input');
		 var autocomplete = new google.maps.places.Autocomplete(input, options);
	}
</script>

<!-- Google API & Maps -->
<!-- Geting an API Key: https://developers.google.com/maps/documentation/javascript/get-api-key -->


</body>
</html>