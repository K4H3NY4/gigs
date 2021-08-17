<?php 

include('config/db.php');



session_start();
if(!isset($_SESSION["email"])){
header("Location: index.php");
exit(); 
}else if(isset($_SESSION["email"])){
    $email= $_SESSION['email'];
    $id = $_SESSION['id'];
};


$queryTasks = "SELECT * FROM `tasks` WHERE  user_id = '$id' ORDER BY created_at Desc ";
$resultTasks = mysqli_query($db,$queryTasks);
$tasks =  mysqli_fetch_all($resultTasks, MYSQLI_ASSOC);



if(isset($_POST['delete-task'])){

	$delete = mysqli_real_escape_string($db, $_POST['delete']);
$query= "DELETE FROM `tasks` WHERE `tasks`.`id` = $delete";


$db->query($query);
if($db->error){
    echo $db->error;
}else{    
}
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
				<h3>Manage Tasks</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="dashboard-manage-tasks.html#">Home</a></li>
						<li><a href="dashboard-manage-tasks.html#">Dashboard</a></li>
						<li>Manage Tasks</li>
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
							<h3><i class="icon-material-outline-assignment"></i> My Tasks</h3>
						</div>

						<div class="content">
							<ul class="dashboard-box-list">
							<?php foreach ($tasks as $task): ?>
								<li>
								<?php
								$taskid = $task["id"];

								$queryBid = "SELECT * FROM taskbids WHERE  taskID = '$taskid' ";
								$resultBid = mysqli_query($db,$queryBid);
								$userBid =  mysqli_fetch_all($resultBid, MYSQLI_ASSOC);

								$bidsCount = "SELECT COUNT(taskID) FROM taskbids where taskID = '$taskid'";
								$resultCount = mysqli_query($db,$bidsCount);
								$count= mysqli_fetch_all($resultCount, MYSQLI_ASSOC);

								$bidsAvg = "SELECT AVG(minRate) FROM taskbids where taskID = '$taskid'";
								$resultAvg = mysqli_query($db,$bidsAvg);
								$avg= mysqli_fetch_all($resultAvg, MYSQLI_ASSOC);

						
								?>
									<!-- Job Listing -->
									<div class="job-listing width-adjustment">

										<!-- Job Listing Details -->
										<div class="job-listing-details">

											<!-- Details -->
											<div class="job-listing-description">
												<h3 class="job-listing-title"><a href="manage-bids.php?ref=<?php echo $task['ref']; ?>" class="" style="text-transform: uppercase;"><?php  echo $task['title']; ?></a> <span class="dashboard-status-button yellow text-capitalize"></span></h3>

												<!-- Job Listing Footer -->
												<div class="job-listing-footer">
													<ul>
														<li><i class="icon-material-outline-access-time"></i><?php  echo $task['created_at']; ?></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									
									<!-- Task Details -->
									<ul class="dashboard-task-info">
										<li><strong>
										<?php foreach ( $count as $count) : echo  $count["COUNT(taskID)"];   endforeach  ;?>
  </strong><span>Bids</span></li>
										<li><strong>Ksh 
										<?php foreach ( $avg as $avg) : echo  $avg["AVG(minRate)"];   endforeach  ;?>
										</strong><span>Avg. Bid</span></li>
										<li><strong>Ksh <?php  echo $task['minBudget']; ?> - Ksh <?php  echo $task['maxBudget']; ?></strong><span>Project Budget</span></li>
									</ul>

									<!-- Buttons -->
										<div class="buttons-to-right always-visible">
										<form action="" method="POST">							

										<a href="manage-bids.php?ref=<?php echo $task['ref']; ?>" class="button ripple-effect" >
										<i class="icon-material-outline-supervisor-account"></i>
										 Manage Bidders <span class="button-info"> <?php echo  $count["COUNT(taskID)"]; ?></span></a>
										<button class="button gray ripple-effect " title="Delete" data-tippy-placement="top" name="delete-task" value="<?php echo $task['id']; ?>" type="submit" style="    position: absolute;
    margin-left: 15px;">Delete Task</button>
										<input type="hidden" value="<?php echo $task['id']; ?>" name="delete">
										
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