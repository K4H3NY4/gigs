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


$taskID = mysqli_real_escape_string($db, $_GET['ref']);
$query = "SELECT * FROM tasks WHERE  ref = '$taskID' ";
$result = mysqli_query($db,$query);
$task = mysqli_fetch_assoc($result);
$taskids = $task['id'];

if($task['user_id'] != $id){
	header("Location: 404.php");
}else{}


$queryBids = "SELECT * FROM `taskbids` WHERE  taskID = '$taskids' ORDER BY created_at Desc";
$resultBids = mysqli_query($db,$queryBids);
$bids =  mysqli_fetch_all($resultBids, MYSQLI_ASSOC);


$bidsCount = "SELECT COUNT(taskID) FROM taskbids where taskID = '$taskids'";
$resultCount = mysqli_query($db,$bidsCount);
$count= mysqli_fetch_all($resultCount, MYSQLI_ASSOC);

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
				<span class="margin-top-7">Bids for <a href="task.php?id=<?php echo $task['id']; ?>"><?php echo $task['title']; ?></a></span>

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
							<h3><i class="icon-material-outline-supervisor-account"></i>
							<?php foreach ( $count as $count) : echo  $count["COUNT(taskID)"];   
							endforeach  ;?> Bids</h3>
							<div class="sort-by">
								<select class="selectpicker hide-tick">
									<option>Highest First</option>
									<option>Lowest First</option>
									<option>Fastest First</option>
								</select>
							</div>
						</div>

						<div class="content">
							<ul class="dashboard-box-list">
							<?php	foreach ($bids as $bid):
			
		    				$userid = $bid["bidderID"];
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
												<small class="freelancer-detail-item"><i class="icon-feather-mail"></i> <?php echo $bid['created_at'];?></small>



												<!-- Bid Details -->
												<ul class="dashboard-task-info bid-info">
													<li><strong>Ksh <?php echo $bid['minRate'];?></strong><span>Min Rate</span></li>
													<li><strong><?php echo $bid['duration'];?> Days</strong><span>Delivery Time</span></li>
													<li><strong>Status</strong><span>Pending</span></li>
												</ul>

												<!-- Buttons -->
												<div class="buttons-to-right always-visible margin-top-25 margin-bottom-0">
												
												
													<a href="bid.php?id=<?php echo $bid['id']; ?>">
														<button  class=" button ripple-effect">View Qoutation</button></a>
												</div>
												<br>
											
											</div>
										</div>
									</div>
								</li>

								<?php endforeach ?>  
								

							</ul>
						</div>
					</div>
				</div>

			</div>
			<!-- Row / End -->
			<?php  include('dashboard-footer.php');?>