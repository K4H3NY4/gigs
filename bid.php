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




$taskbids = mysqli_real_escape_string($db, $_GET['id']);
$query = 'SELECT * FROM taskbids WHERE  id = '.$taskbids;
$result = mysqli_query($db,$query);
$taskbid = mysqli_fetch_assoc($result);




//$taskID = mysqli_real_escape_string($db, $_GET['id']);
$query = 'SELECT * FROM tasks WHERE  id = '.$taskbid['taskID'];
$result = mysqli_query($db,$query);
$task = mysqli_fetch_assoc($result);

if($task['user_id'] != $id){
	header("Location: 404.php");
	//echo $id;
}else{}


/*
$queryBids = "SELECT * FROM `taskbids` WHERE  taskID = '$taskID' ORDER BY created_at Desc ";
$resultBids = mysqli_query($db,$queryBids);
$bids =  mysqli_fetch_all($resultBids, MYSQLI_ASSOC);

*/


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
				<h3>Manage Bidders</h3>
				<span class="margin-top-7">Bids for <a href="task.php?ref=<?php echo $task['ref']; ?>"><?php echo $task['title']; ?></a></span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="dashboard-manage-bidders.html#">Home</a></li>
						<li><a href="dashboard-manage-bidders.html#">Dashboard</a></li>
						<li>Manage Bidders</li>
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
							
						
						</div>

						<div class="content">
							<ul class="dashboard-box-list">
							<?php	
			
			$userid = $taskbid["bidderID"];
		   $queryBid = "SELECT * FROM users WHERE  id = '$userid' ";
		   $resultBid = mysqli_query($db,$queryBid);
		   $userBid = mysqli_fetch_assoc($resultBid);
		   
		   ?>
								<li>
									<!-- Overview -->
									<div class="freelancer-overview manage-candidates">
										<div class="freelancer-overview-inner">

											<!-- Avatar -->
											<div class="freelancer-avatar">
												<div class="verified-badge"></div>
												<a href="profile.php?id=<?php echo $userBid['id']; ?>"><img src="<?php echo $userBid['photo'];?>" alt=""></a>
											</div>

											<!-- Name -->
											<div class="freelancer-name">
												<h4><a href="profile.php?id=<?php echo $userBid['id']; ?>" class="text-capitalize"><?php echo $userBid['firstName']." ".$userBid['lastName'];?></a></h4>

												<!-- Details -->
												<span class="freelancer-detail-item"><a href="mailto:<?php echo $userBid['email']; ?>"><i class="icon-feather-mail"></i> <?php echo $userBid['email'];?></a></span>
<br>
												<!-- Details -->
												<small class="freelancer-detail-item"><i class="icon-feather-mail"></i> <?php echo $taskbid['created_at'];?></small>

									
												<!-- Bid Details -->
									
												<ul class="dashboard-task-info bid-info">
			

													<li><strong>Ksh <?php echo $taskbid['minRate'];?></strong><span>Min Rate</span></li>
													<li><strong><?php echo $taskbid['duration'];?> Days</strong><span>Delivery Time</span></li>
													<li>			<span class="col-12">
														<?php 
														
														$status = 'accept';
														
														if($status == 'Pending'){
															echo ('
															<form method="get" action="">
															<strong>Status</strong>
																		<button class="small  button ripple-effect">Accept</button>
				<button class="small  button dark ripple-effect" style="background-color: #ff0202;
		box-shadow: 0 3px 8px rgb(0 0 0 / 10%);">Reject</button>
				</form>
	
															
															
															
															');

														}else if ($status == 'accept'){
															echo('
															
															<form method="get" action="">
															<strong>Accepted</strong>
																		<button class="small  button ripple-effect" style="				background-color:#4caf50;
																		">Pay Now</button>
				<button class="small  button dark ripple-effect" style="
				background-color: #ff0202;
		box-shadow: 0 3px 8px rgb(0 0 0 / 10%);
		">Cancel</button>
				</form>
	
															
															');



														}else if ($status == 'reject') {

														echo ('

																												<strong>Rejected</strong>
																		
															<button class="small  button dark ripple-effect disabled" style="
															background-color: #795548;
															box-shadow: 0 3px 8px rgb(0 0 0 / 10%);
															">This bid was rejected</button>
														
																');

													 }; ?>
											
</span>
</li>
												</ul>

												<!-- Buttons 
												<div class="buttons-to-right always-visible margin-top-25 margin-bottom-0">

											
													<button   id="qoutation<?php echo $bid['id']; ?>" class="popup-with-zoom-anim button ripple-effect">View Qoutation</button>
												
													<a href="dashboard-manage-bidders.html#" class="button gray ripple-effect ico" title="Remove Bid" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
												</div>
												-->
												<br>
											
											</div>
										</div>
									</div>
								</li>

						
							</ul>
						</div>
						<iframe src="<?php echo $taskbid['qoute']; ?>" width="100%" height="700px" frameborder="0"></iframe>
					</div>
					
				</div>

			</div>
			<!-- Row / End -->
			<?php  include('dashboard-footer.php');?>