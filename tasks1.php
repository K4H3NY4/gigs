<?php include('header-nos.php'); 
include('config/db.php');



$queryCategory = "SELECT * FROM `categories` ORDER by  category ASC";
$resultCategory = mysqli_query($db,$queryCategory);
$category =  mysqli_fetch_all($resultCategory, MYSQLI_ASSOC);

$n= 10;
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
			$queryTasks = "SELECT * FROM `tasks` where  category = '$searchid'  ORDER by  dateCreated  DESC LIMIT $m, $n";
			$resultTasks = mysqli_query($db,$queryTasks);
			$tasks =  mysqli_fetch_all($resultTasks, MYSQLI_ASSOC);

		}else if($searchid == 0){
			$queryTasks = "SELECT * FROM `tasks`   ORDER by  dateCreated  DESC  LIMIT $m, $n";
			$resultTasks = mysqli_query($db,$queryTasks);
			$tasks =  mysqli_fetch_all($resultTasks, MYSQLI_ASSOC);

		}
		
 

 
}else{
	$queryTasks = "SELECT * FROM `tasks` ORDER by  dateCreated  DESC  LIMIT $m, $n";
	$resultTasks = mysqli_query($db,$queryTasks);
	$tasks =  mysqli_fetch_all($resultTasks, MYSQLI_ASSOC);

}
 
 

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
				
			<form action="" method="POST">

				<!-- Category -->
				<div class="sidebar-widget">
					<h3>Category</h3>
					<select class="selectpicker default" name="category"  data-selected-text-format="count" data-size="7" title="All Categories" >
					<option value="0">All Categories</option>
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
							
						</div>
						<div class="keywords-list"><!-- keywords go here --></div>
						<div class="clearfix"></div>
					</div>
				</div>

				<!-- Budget -->
				<div class="sidebar-widget" style="display: none;">
					<h3>Fixed Price</h3>
					<div class="margin-top-55"></div>

					<!-- Range Slider -->
					<input class="range-slider" type="text" value="" data-slider-currency="Ksh" data-slider-min="10" data-slider-max="2500" data-slider-step="25" data-slider-value="[50,2500]"/>
				</div>


				<button class="button button-sliding-icon ripple-effect" type="submit" name="filter"> Filter </button>
	
				</form>
				<div class="clearfix"></div>

			</div>
		</div>
		<div class="col-xl-9 col-lg-8 content-left-offset">

			<h3 class="page-title">Search Results</h3>

			
			<!-- Tasks Container -->
			<div class="tasks-list-container margin-top-35">
				
									
					
			<?php foreach ($tasks as $task): ?>
				<!-- Task -->
				<a href="task.php?ref=<?php echo $task['ref']; ?>" class="task-listing">

					<!-- Job Listing Details -->
					<div class="task-listing-details">

						<!-- Details -->
						<div class="task-listing-description">
							<h3 class="task-listing-title text-capitalize"><?php echo  $task['title']; ?></h3>
							<ul class="task-icons">
								<li><i class="icon-material-outline-location-on"></i><?php echo  $task['location']; ?></li>
								<li><i class="icon-material-outline-access-time"></i>  <?php echo  $task['created_at']; ?></li>
							</ul>
							<p class="task-listing-text"><?php echo  $task['description']; ?></p>
							<div class="task-tags text-capitalize">
							<?php $skills = explode(",",$task['skills']);
	foreach ($skills as $skill): ?>
	<span><?php echo $skill; ?></span><?php endforeach ?>  
							</div>
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

				

			

				
				<!-- Pagination -->
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-md-12">
						<!-- Pagination -->
						<div class="pagination-container margin-top-30 margin-bottom-60">
							<nav class="pagination">
								<ul>
									<li class="pagination-arrow"><a href="tasks-list-layout-2.html#" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-left"></i></a></li>

									<?php 

for ($i=1;$i<=$total_button_number;$i++){
	echo '<li><a href="./tasks.php?current_page='.$i.'" class="ripple-effect">'.$i.'</a></li>';
	
}
?>
							
									<li class="pagination-arrow"><a href="tasks-list-layout-2.html#" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
				<!-- Pagination / End -->

			</div>
			<!-- Tasks Container / End -->

		</div>
	</div>
</div>


<!-- Footer
================================================== -->
<?php include('footer.php'); ?>