<?php 
include('config/db.php');



session_start();
if(!isset($_SESSION["email"])){
header("Location: index.php");
exit();
}else { 

    $email = $_SESSION['email'];
    $id = $_SESSION['id'];

};



$queryBids = "SELECT * FROM tasks INNER JOIN taskbids ON tasks.id = taskbids.taskID  where bidderid = $id";
$resultBids = mysqli_query($db,$queryBids);
$bids =  mysqli_fetch_all($resultBids, MYSQLI_ASSOC);



if(isset($_POST['delete'])){
$delete = mysqli_real_escape_string($db, $_POST['delete']);
$query= "DELETE FROM `taskbids` WHERE `id` = $delete";


$db->query($query);
if($db->error){
    echo $db->error;
}else{    }
}



include('header.php'); 
?>

<div class="clearfix"></div>
<!-- Header Container / End -->


<!-- Dashboard Container -->
<div class="dashboard-container">

<!-- Dashboard Sidebar
	================================================== -->
	<?php include('sidebar.php'); ?>

	<!-- Dashboard Sidebar / End -->

	<!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Sent Bids</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="dashboard-my-active-bids.html#">Home</a></li>
						<li><a href="dashboard-my-active-bids.html#">Dashboard</a></li>
						<li>Sent Bids</li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-gavel"></i> Bids List</h3>
						</div>

						<div class="content">
							<ul class="dashboard-box-list">
							<?php	foreach ($bids as $bid): 
							
 								$taskID = $bid["taskID"];
								$queryBid = "SELECT * FROM tasks WHERE  id = '$taskID'  ";
								$resultBid = mysqli_query($db,$queryBid);
								$task = mysqli_fetch_assoc($resultBid);
								
								?>	
								<li>
									<!-- Job Listing -->
									<div class="job-listing width-adjustment">

										<!-- Job Listing Details -->
										<div class="job-listing-details">

											<!-- Details -->
											<div class="job-listing-description">
												<h3 class="job-listing-title"><a style="text-transform: uppercase;" href="task.php?ref=<?php echo $task['ref']; ?>"><?php echo $task['title'];?></a></h3>
											</div>
										</div>
									</div>
									
									<!-- Task Details -->
									<ul class="dashboard-task-info">
										<li><strong>Ksh <?php echo $bid['minRate'];?></strong><span>Min Rate</span></li>
										<li><strong><?php echo $bid['duration'];?> Days</strong><span>Delivery Time</span></li>
									</ul>

									<!-- Buttons -->
									<div class="buttons-to-right always-visible">
									<form action="" method="POST">
									
										<button name="delete" class="button red ripple-effect " title="Delete Bid" data-tippy-placement="top" value="<?php echo $bid['id'];?> ">DELETE</button>
										</form>
									</div>
								</li>
								<?php endforeach ?>  
							

							</ul>
						</div>
					</div>
				</div>

			</div>
			<!-- Row / End -->
<?php include('dashboard-footer.php'); ?>