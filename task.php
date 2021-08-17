<?php  

include('config/db.php');

session_start();

if(!isset($_SESSION["email"])){
	$accountType = NULL;
	}else if(isset($_SESSION["email"])){
		$email= $_SESSION['email'];
		$id = $_SESSION['id'];
		$accountType =$_SESSION['accountType'];
	};
	
	if(isset($_POST['login'])){
		header('Location: login.php');
		}else{}
		


$taskID = mysqli_real_escape_string($db, $_GET['ref']);
$query = "SELECT * FROM tasks WHERE  ref = '$taskID'";
$result = mysqli_query($db,$query);
$task = mysqli_fetch_assoc($result);
$task_id = $task['id'];

if($task == NULL){
	header('Location: 404.php');

}else{}


if(isset($_POST['bid-task'] ) ){


	$minRate = mysqli_real_escape_string ($db, $_POST['minRate']);
	$duration = mysqli_real_escape_string ($db, $_POST['duration']);
	$user = mysqli_real_escape_string($db,$id);

$cover_photo = $_FILES['qoute']['name'];
$covertmpname = $_FILES['qoute']['tmp_name'];
$folder = 'uploads/';
$file_name_extension= explode(".",$_FILES['qoute']['name']);

		if ($file_name_extension[1] == 'pdf') {
			$new_file_name = date('Y').date('m').date('d').time().rand(1000,9999).".".$file_name_extension[1];
			$folder="uploads/"."qoutes";

			if(!is_dir($folder)){
			mkdir($folder,0777,true);
			$folder = $folder."/".$new_file_name;
			}else{
			$folder = $folder."/".$new_file_name;
			}

			move_uploaded_file($covertmpname,  $folder);
			$qoute =mysqli_real_escape_string($db,$folder);

		}else{
			exit();
		}


		

	$sql = "INSERT INTO `taskbids` SET
	
     `minRate`='$minRate',
     `duration`='$duration',
      `bidderID`='$user',
     `taskID`='$task_id',
	 `qoute`='$qoute' 
	    ";
	  
	
	$db->query($sql);
	if($db->error){
	
	   echo $db->error;
	}else{
 
 
 };
 
}




$queryBids = "SELECT * FROM `taskbids` WHERE  taskID = $task_id  ORDER BY created_at DESC";
$resultBids = mysqli_query($db,$queryBids);
$bids =  mysqli_fetch_all($resultBids, MYSQLI_ASSOC);



$query = "SELECT * FROM `users` WHERE id = ".$task['user_id'];
$result = mysqli_query($db,$query);
$user = mysqli_fetch_assoc($result);
mysqli_free_result($result);


include('header-nos.php');  
?>
<div class="clearfix"></div>
<!-- Header Container / End -->



<!-- Titlebar
================================================== -->
<div class="single-page-header" data-background-image="images/single-task.jpg">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="single-page-header-inner">
					<div class="left-side">
						<div class="header-image"><a href="single-company-profile.html"><img src="images/browse-companies-02.png" alt=""></a></div>
						<div class="header-details">
							<h3 class="text-capitalize" style="text-transform: uppercase;"><?php echo $task['title']; ?></h3>
							<h5 class="text-capitalize">Added By: <?php echo $user['firstName'].' '.$user['lastName']; ?></h5>
							<ul>
								<li><a href="single-company-profile.html"> <?php 
								
								
								$dates =explode(" ", $task['created_at']); 
								echo $dates[0];
								
								?></a></li>
							
								<li><img class="flag" src="images/flags/de.svg" alt=""> Kenya</li>
							</ul>
						</div>
					</div>
					<div class="right-side">
						<div class="salary-box">
							<div class="salary-type">Project Budget</div>
							<div class="salary-amount">Ksh <?php echo $task['minBudget']; ?> - Ksh <?php echo $task['maxBudget']; ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Page Content
================================================== -->
<div class="container">
	<div class="row">
		
		<!-- Content -->
		<div class="col-xl-8 col-lg-8 content-right-offset">
			
			<!-- Description -->
			<div class="single-page-section">
				<h3 class="margin-bottom-25">Project Description</h3>
				<p><?php echo $task['description']; ?></p>
			</div>

			<!-- Atachments -->
			<div class="single-page-section">
				<h3>Attachments</h3>
				<div class="attachments-container">
				<iframe src="<?php echo $task['brief']; ?>" width="100%" height="500px" frameborder="1"></iframe>
				</div>
			</div>

			<!-- Skills -->
			<div class="single-page-section">
				<h3>Skills Required</h3>
				<div class="task-tags text-capitalize">
				<?php $skills = explode(",",$task['skills']);
	foreach ($skills as $skill): ?>
	<span><?php echo $skill; ?></span><?php endforeach ?>   
					
				</div>
			</div>
			<div class="clearfix"></div>
			
			<!-- Freelancers Bidding -->
			<div class="boxed-list margin-bottom-60">
				<div class="boxed-list-headline">
					<h3><i class="icon-material-outline-group"></i> Freelancers Bidding</h3>
				</div>
				<ul class="boxed-list-ul">
				<?php	foreach ($bids as $bid):
			
 $userid = $bid["bidderID"];
$queryBid = "SELECT * FROM users WHERE  id = '$userid' ";
$resultBid = mysqli_query($db,$queryBid);
$userBid = mysqli_fetch_assoc($resultBid);

?>
					<li>
						<div class="bid">
							<!-- Avatar -->
							<div class="bids-avatar">
								<div class="freelancer-avatar">
									<div class="verified-1badge"></div>
									<a href=""><img src="<?php echo $userBid['photo'];?>" alt=""></a>
								</div>
							</div>
							
							<!-- Content -->
							<div class="bids-content">
								<!-- Name -->
								<div class="freelancer-name">
									<h4 class="text-capitalize"><a href=""><?php echo $userBid['firstName']." ".$userBid['lastName'];?> </a></h4>
									<p class="text-capitalize"><?php echo $userBid['tagline'];?></p>
								</div>
							</div>
							
							<!-- Bid -->
							<div class="bids-bid">
								<div class="bid-rate">
									<div class="rate">Ksh <?php echo $bid['minRate'];?></div>
									<span>in <?php echo $bid['duration'];?> days</span>
								</div>
							</div>
						</div>
					</li>
					<?php endforeach ?>  
				
				</ul>
			</div>

		</div>
		

		<!-- Sidebar -->
		<div class="col-xl-4 col-lg-4">
			<div class="sidebar-container">

				<div class="sidebar-widget">
				<form method="POST" enctype="multipart/form-data">
					<div class="bidding-widget">
						<div class="bidding-headline"><h3>Bid on this job!</h3></div>
						<div class="bidding-inner">

							<!-- Headline -->
							<span class="bidding-detail">Set your <strong>minimum rate</strong></span>

							<!-- Price Slider -->
							<div class="bidding-value">Ksh <span id="biddingVal"></span></div>
							<input class="bidding-slider" type="text" value="" name="minRate" data-slider-handle="custom" data-slider-currency="$" data-slider-min="<?php echo $task['minBudget']; ?>" data-slider-max="<?php echo $task['maxBudget']; ?>" data-slider-value="auto" data-slider-step="50" data-slider-tooltip="hide" />
							
							<!-- Headline -->
							<span class="bidding-detail margin-top-30">Set your <strong>delivery time</strong></span>

							<!-- Fields -->
							<div class="bidding-fields">
								<div class="bidding-field">
									<!-- Quantity Buttons -->
									<div class="qtyButtons">
										<div class="qtyDec"></div>
										<input type="number" name="duration" value="1">
										<div class="qtyInc"></div>
									</div>
								</div>
								<div class="bidding-field">
									<select class="selectpicker disabled default">
										<option selected>Days</option>
										
									</select>
								</div>
							</div>

							<span class="bidding-detail margin-top-30">Upload your <strong>qoutation</strong></span>
										
									
							<!-- Button -->
							<?php if(isset($_SESSION["email"]))
							echo('

							<div class="uploadButton margin-top-10">
							<input class="uploadButton-input" name="qoute" type="file" accept="pdf" id="upload" required />
							<label class="uploadButton-button ripple-effect" for="upload">Upload Qoute</label>
							<span class="uploadButton-file-name">PDF Files Only</span>
						</div>

							<button id="snackbar-place-bid" name="bid-task" class="button ripple-effect move-on-hover full-width margin-top-30"><span>Place a Bid</span></button>
							
							
							');
							
							else {
								echo('

								<div class="uploadButton margin-top-10">
											<input class="uploadButton-input" name="qoute" type="file" accept="pdf" id="upload"  />
											<label class="uploadButton-button ripple-effect" for="upload">Upload Qoute</label>
											<span class="uploadButton-file-name">PDF Files Only</span>
										</div>
								<button id="" name="login" class="button ripple-effect move-on-hover full-width margin-top-30 disabled disable "><span>Login or Register to bid</span></button>
								<div class="bidding-signup">Don\'t have an account? <a href="register.php" class="">Register</a></div>

								');
							}
							?>

						</div>
						</form>
					</div>
				</div>

				<!-- Sidebar Widget -->
				<div class="sidebar-widget">
					<h3>Bookmark or Share</h3>

					<!-- Bookmark Button -->
					<button class="bookmark-button margin-bottom-25">
						<span class="bookmark-icon"></span>
						<span class="bookmark-text">Bookmark</span>
						<span class="bookmarked-text">Bookmarked</span>
					</button>

					<!-- Copy URL -->
					<div class="copy-url">
						<input id="copy-url" type="text" value="" class="with-border">
						<button class="copy-url-button ripple-effect" data-clipboard-target="#copy-url" title="Copy to Clipboard" data-tippy-placement="top"><i class="icon-material-outline-file-copy"></i></button>
					</div>

					<!-- Share Buttons -->
					<div class="share-buttons margin-top-25">
						<div class="share-buttons-trigger"><i class="icon-feather-share-2"></i></div>
						<div class="share-buttons-content">
							<span>Interesting? <strong>Share It!</strong></span>
							<ul class="share-buttons-icons">
								<li><a href="single-task-page.html#" data-button-color="#3b5998" title="Share on Facebook" data-tippy-placement="top"><i class="icon-brand-facebook-f"></i></a></li>
								<li><a href="single-task-page.html#" data-button-color="#1da1f2" title="Share on Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
								<li><a href="single-task-page.html#" data-button-color="#dd4b39" title="Share on Google Plus" data-tippy-placement="top"><i class="icon-brand-google-plus-g"></i></a></li>
								<li><a href="single-task-page.html#" data-button-color="#0077b5" title="Share on LinkedIn" data-tippy-placement="top"><i class="icon-brand-linkedin-in"></i></a></li>
							</ul>
						</div>
					</div>
				</div>

			</div>
		</div>

	</div>
</div>


<!-- Spacer -->
<div class="margin-top-15"></div>
<!-- Spacer / End-->

<!-- Footer
================================================== -->
<?php include('footer.php'); ?>