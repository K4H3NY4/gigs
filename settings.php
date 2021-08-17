<?php 
require('config/db.php');

session_start();
if(!isset($_SESSION["email"])){
//header("Location: login.php");
//exit(); 
}else if(isset($_SESSION["email"])){
    $email= $_SESSION['email'];
    $id = $_SESSION['id'];
};




$query = "SELECT * FROM `users` WHERE id = '$id'";
$result = mysqli_query($db,$query);
$user = mysqli_fetch_assoc($result);
mysqli_free_result($result);






if(isset($_POST['save-changes'])){



    $firstName = mysqli_real_escape_string($db, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($db, $_POST['lastName']);
    $tagline = mysqli_real_escape_string($db, $_POST['tagline']);
	$nationality = mysqli_real_escape_string($db, $_POST['nationality']);
	$bio = mysqli_real_escape_string($db, $_POST['bio']);



$cover_photo = $_FILES['uploadfile']['name'];

if($cover_photo != NULL){

$covertmpname = $_FILES['uploadfile']['tmp_name'];
$folder = 'uploads/';
$file_name_extension= explode(".",$_FILES['uploadfile']['name']);
$new_file_name = time().rand(1000,9999).".".$file_name_extension[1];
$folder="uploads/".date('Y')."/".date('m')."/".date('d');

if(!is_dir($folder)){
mkdir($folder,0777,true);
$folder = $folder."/".$new_file_name;
}else{
$folder = $folder."/".$new_file_name;
}



move_uploaded_file($covertmpname,  $folder);


      
     $query = "UPDATE `users` SET
		 `firstName` ='$firstName' ,
		 `lastName` ='$lastName',
		 `tagline` ='$tagline',
		 `nationality` = '$nationality',
		 `photo`='$folder' ,
		 `bio` = '$bio'	 
		 WHERE id = '$id' ";
}else{

	$query = "UPDATE `users` SET
		 `firstName` ='$firstName' ,
		 `lastName` ='$lastName',
		 `tagline` ='$tagline',
		 `nationality` = '$nationality',
		 `bio` = '$bio'	 
		 WHERE id = '$id' ";
}

$db->query($query);
if($db->error){
    echo $db->error;
}else{    header("Location: settings.php");
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
				<h3>Settings</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="dashboard-settings.html#">Home</a></li>
						<li><a href="dashboard-settings.html#">Dashboard</a></li>
						<li>Settings</li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			

				<!-- Dashboard Box -->
				<form action="" method="POST" enctype="multipart/form-data" >
			<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-account-circle"></i> My Account</h3>
						</div>

						<div class="content with-padding padding-bottom-0">

							<div class="row">

								<div class="col-auto">
									<div class="avatar-wrapper" data-tippy-placement="bottom" title="Change Avatar">
										<img class="profile-pic" src="
										<?php 
										if($user ['photo'] == NULL)
										echo('images/user-avatar-placeholder.png'); else{
											echo $user['photo'];
										}
										?>
										" alt="" />
										<input class="file-upload" hidden type="file" name="uploadfile" accept="image/*"/>
										<div class="upload-button" ></div>
										
									</div>
								</div>

								<div class="col">
									<div class="row">

										<div class="col-xl-4">
											<div class="submit-field">
												<h5>First Name</h5>
												<input type="text" class="with-border" name="firstName" value="<?php echo $user ["firstName"];?>">
											</div>
										</div>

										<div class="col-xl-4">
											<div class="submit-field">
												<h5>Last Name</h5>
												<input type="text" class="with-border" name="lastName" class="lastName" value="<?php echo $user ["lastName"];?>">
											</div>
										</div>


										<div class="col-xl-4">
											<div class="submit-field">
												<h5>Email</h5>
												<input type="text" class="with-border" disabled value="<?php echo $user ["email"];?>">
											</div>
										</div>

										
										<div class="col-xl-2 d-none">
											<!-- Account Type -->
											<div class="submit-field">
												<h5>Account Type</h5>
												<div class="account-type">
													<div>
														<input type="radio" name="account-type-radio" id="freelancer-radio" class="account-type-radio" checked/>
														<label for="freelancer-radio" class="ripple-effect-dark"><i class="icon-material-outline-account-circle"></i><?php echo $user ["accountType"];?></label>
													</div>


								
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
			
					<div class="dashboard-box">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-face"></i> My Profile</h3>
						</div>

						<div class="content">
							<ul class="fields-ul">
							
							<li>
								<div class="row">
									<div class="col-xl-6">
										<div class="submit-field">
											<h5>Tagline</h5>
											<input type="text" class="with-border" name="tagline" value="<?php echo $user["tagline"];?>">
										</div>
									</div>

									<div class="col-xl-6">
										<div class="submit-field">
											<h5>Nationality</h5>
											<select class="selectpicker with-border" data-size="7" title="Select your country" data-live-search="true" name="nationality">
											
												<option value="Burundi">Burundi</option>
												<option value="Kenya" selected>Kenya</option>
												<option value="Tanzania">Tanzania</option>
												<option value="Rwanda">Rwanda</option>									
												<option value="Djibouti">Djibouti</option>									<option value="Uganda">Uganda</option>
												<option value="Somalia">Somalia</option>
												<option value="South Sudan">South Sudan</option>
								
											
											</select>
										</div>
									</div>

									<div class="col-xl-12">
										<div class="submit-field">
											<h5>Introduce Yourself</h5>
											<textarea cols="30" rows="5" class="with-border" name="bio"><?php echo $user ["bio"];?></textarea>
															<div class="col-xl-12">
					<button type="submit" name="save-changes" class="button ripple-effect big margin-top-30">Save Changes</button>
				</div>
										</div>

										
									</div>

					

								</div>
							</li>
						</ul>
						</div>
					</div>
					
				</div>
				
				
				</form>
	

				<!-- Dashboard Box -->
				<form action="" method="POST">
				<div class="col-xl-12">
					<div id="test1" class="dashboard-box">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-lock"></i> Password & Security</h3>
						</div>

						<div class="content with-padding">
							<div class="row">
								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Current Password</h5>
										<input type="password" class="with-border">
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>New Password</h5>
										<input type="password" class="with-border">
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Repeat New Password</h5>
										<input type="password" class="with-border">
									</div>
								</div>

								<div class="col-xl-12">
									<div class="checkbox">
										<input type="checkbox" id="two-step" checked>
										<label for="two-step"><span class="checkbox-icon"></span> Enable Two-Step Verification via Email</label>
									</div>
									<div class="col-xl-12">
					<button  class="button ripple-effect big margin-top-30">Reset Password</button>
				</div>

								</div>
							</div>
						</div>
					</div>
				</div>

				</form>
	
				
				<!-- Button -->
				<?php include('dashboard-footer.php'); ?>
			</div>


			<!-- Row / End -->
