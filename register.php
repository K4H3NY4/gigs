<?php  


include('config/db.php');

session_start();
session_unset();
session_destroy();

if(isset($_POST['register'])){

   $password = mysqli_real_escape_string ($db, $_POST['password']);
   $email = mysqli_real_escape_string ($db, $_POST['email']);
   $accountType = mysqli_real_escape_string ($db, $_POST['account-type-radio']);
   $confirmPassword = mysqli_real_escape_string ($db, $_POST['confirmPassword']);

   if ($password == $confirmPassword) {

	$sql = "INSERT INTO `users` SET
   `password`='".md5($password)."',
   `email`='$email' ";
  

$db->query($sql);
if($db->error){

   echo $db->error;
}else{
	/*
   $to = $email;
   $subject = "ACCOUNT CREATED";
   $message = "You have successful open an acount" ;
   
   // Always set content-type when sending HTML email
   $headers = "MIME-Version: 1.0" . "\r\n";
   $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
   
   // More headers
   $headers .= 'From: <no-reply@housing.co.ke>' . "\r\n";
   /*$headers .= 'Cc: kahenyaj@gmail.com' . "\r\n";*/
   
   /*mail($to,$subject,$message,$headers);*/
   header("Location: settings.php");
}      
   } else   {
	echo ('
			<style>
			#pswd {
				display: inline !important;
			}
			</style>
	
	');
} }

include('header-nos.php'); 
?>


<div class="clearfix"></div>
<!-- Header Container / End -->

<!-- Titlebar
================================================== -->
<div id="titlebar" class="gradient">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<h2>Register</h2>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="pages-register.html#">Home</a></li>
						<li>Register</li>
					</ul>
				</nav>

			</div>
		</div>
	</div>
</div>


<!-- Page Content
================================================== -->
<div class="container">
	<div class="row">
		<div class="col-xl-5 offset-xl-3">

			<div class="login-register-page">
				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3 style="font-size: 26px;">Let's create your account!</h3>
					<span>Already have an account? <a href="login.php">Log In!</a></span>
				</div>

				
					
				<!-- Form -->
				<form method="POST" id="register-account-form"  action="<?php $_SERVER['PHP_SELF']; ?>"  >

				<!-- Account Type -->
				<div class="account-type">
					<div>
						<input type="radio" name="account-type-radio" id="freelancer-radio" value="Freelancer" class="account-type-radio" checked/>
						<label for="freelancer-radio" class="ripple-effect-dark"><i class="icon-material-outline-account-circle"></i> Freelancer</label>
					</div>

					<div>
						<input type="radio" name="account-type-radio" id="employer-radio" value="Employer" class="account-type-radio"/>
						<label for="employer-radio" class="ripple-effect-dark"><i class="icon-material-outline-business-center"></i> Employer</label>
					</div>
				</div>
					<div class="input-with-icon-left">
						<i class="icon-material-baseline-mail-outline"></i>
						<input type="text" class="input-text with-border" name="email" id="emailaddress-register" placeholder="Email Address" required/>
					</div>

					<div class="input-with-icon-left" title="Should be at least 8 characters long" data-tippy-placement="bottom">
						<i class="icon-material-outline-lock"></i>
						<input type="password" class="input-text with-border" name="password" id="password-register" placeholder="Password" required/>
					</div>

					<div class="input-with-icon-left">
						<i class="icon-material-outline-lock"></i>
						<input type="password" class="input-text with-border" name="confirmPassword" id="password-repeat-register" placeholder="Repeat Password" required/>
					</div>
					<button class="button full-width button-sliding-icon ripple-effect margin-top-10" name="register" type="submit" >Register
					 <i class="icon-material-outline-arrow-right-alt"></i>
					 </button>
				

				</form>
				
				<!-- Button -->
				
				<!-- Social Login -->
				<div class="social-login-separator"><span>or</span></div>
				<div class="social-login-buttons">
					<button class="facebook-login ripple-effect"><i class="icon-brand-facebook-f"></i> Register via Facebook</button>
					<button class="google-login ripple-effect"><i class="icon-brand-google-plus-g"></i> Register via Google+</button>
				</div>
			</div>

		</div>
	</div>
</div>


<!-- Spacer -->
<div class="margin-top-70"></div>
<!-- Spacer / End-->


<?php  include('footer.php'); ?>