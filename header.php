<?php

 $headerId = $_SESSION['id'];

$queryHeader = "SELECT * FROM `users` WHERE email = '$email'";
$resultHeader = mysqli_query($db,$queryHeader);
$userHeader = mysqli_fetch_assoc($resultHeader);
mysqli_free_result($resultHeader);


?>

<!doctype html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<title>Hireo</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/colors/blue.css">

<style>
.text-capitalize{
     text-transform: capitalize !important;
}

</style>

</head>
<body>

<!-- Wrapper -->
<div id="wrapper">

<!-- Header Container
================================================== -->
<header id="header-container" class="fullwidth">

	<!-- Header -->
	<div id="header">
		<div class="container">
			
			<!-- Left Side Content -->
			<div class="left-side">
				
				<!-- Logo -->
				<div id="logo">
					<a href="./"><img src="images/logo.png" alt=""></a>
				</div>

				<!-- Main Navigation -->
				<nav id="navigation">
					<ul id="responsive">

						<li><a href="/gigs" >Home</a></li>

						<li><a href="tasks.php">Find Work</a></li>



					</ul>
				</nav>
				<div class="clearfix"></div>
				<!-- Main Navigation / End -->
				
			</div>
			<!-- Left Side Content / End -->


			<!-- Right Side Content / End -->
			<div class="right-side">

		
				<!-- User Menu -->
				<div class="header-widget">

					<!-- Messages -->
					<div class="header-notifications user-menu">
						<div class="header-notifications-trigger">
							<a href="pages-404.html#"><div class="user-avatar status-online"><img src="<?php echo $userHeader['photo'];?>" alt=""></div></a>
						</div>

						<!-- Dropdown -->
						<div class="header-notifications-dropdown">

							<!-- User Status -->
							<div class="user-status">

								<!-- User Name / Avatar -->
								<div class="user-details">
									<div class="user-avatar status-online"><img src="<?php echo $userHeader['photo'];?>" alt=""></div>
									<div class="user-name text-capitalize">
										<?php 
										echo $userHeader['firstName'] .' '. $userHeader['lastName'].'
										<span></span>' ?> 
									</div>
								</div>
								
								
						</div>
						
						<ul class="user-menu-small-nav">
							<li><a href="dashboard.php"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
							<li><a href="settings.php"><i class="icon-material-outline-settings"></i> Settings</a></li>
							<li><a href="logout.php"><i class="icon-material-outline-power-settings-new"></i> Logout</a></li>
						</ul>

						</div>
					</div>

				</div>
				<!-- User Menu / End -->

				<!-- Mobile Navigation Button -->
				<span class="mmenu-trigger">
					<button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
				</span>

			</div>
			<!-- Right Side Content / End -->

		</div>
	</div>
	<!-- Header / End -->

</header>