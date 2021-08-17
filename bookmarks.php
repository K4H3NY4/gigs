<?php 
include('config/db.php');

session_start();
if(!isset($_SESSION["email"])){
header("Location: login.php");
exit(); 
}else if(isset($_SESSION["email"])){
    $email= $_SESSION['email'];
    $id = $_SESSION['id'];
	$accountType =$_SESSION['accountType'];
};

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
				<h3>Bookmarks</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="dashboard-bookmarks.html#">Home</a></li>
						<li><a href="dashboard-bookmarks.html#">Dashboard</a></li>
						<li>Bookmarks</li>
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
							<h3><i class="icon-material-outline-business-center"></i> Bookmarked Jobs</h3>
						</div>

						<div class="content">
							<ul class="dashboard-box-list">
								<li>
									<!-- Job Listing -->
									<div class="job-listing">

										<!-- Job Listing Details -->
										<div class="job-listing-details">

											<!-- Logo -->
											<a href="dashboard-bookmarks.html#" class="job-listing-company-logo">
												<img src="images/company-logo-02.png" alt="">
											</a>

											<!-- Details -->
											<div class="job-listing-description">
												<h3 class="job-listing-title"><a href="dashboard-bookmarks.html#">Barista and Cashier</a></h3>

												<!-- Job Listing Footer -->
												<div class="job-listing-footer">
													<ul>
														<li><i class="icon-material-outline-business"></i> Coffee</li>
														<li><i class="icon-material-outline-location-on"></i> San Francisco</li>
														<li><i class="icon-material-outline-business-center"></i> Full Time</li>
														<li><i class="icon-material-outline-access-time"></i> 2 days ago</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<!-- Buttons -->
									<div class="buttons-to-right">
										<a href="dashboard-bookmarks.html#" class="button red ripple-effect ico" title="Remove" data-tippy-placement="left"><i class="icon-feather-trash-2"></i></a>
									</div>
								</li>

								<li>
									<!-- Job Listing -->
									<div class="job-listing">

										<!-- Job Listing Details -->
										<div class="job-listing-details">

											<!-- Logo -->
											<a href="dashboard-bookmarks.html#" class="job-listing-company-logo">
												<img src="images/company-logo-04.png" alt="">
											</a>


											<!-- Details -->
											<div class="job-listing-description">
												<h3 class="job-listing-title"><a href="dashboard-bookmarks.html#">Administrative Assistant</a></h3>

												<!-- Job Listing Footer -->
												<div class="job-listing-footer">
													<ul>
														<li><i class="icon-material-outline-business"></i> Mates</li>
														<li><i class="icon-material-outline-location-on"></i> San Francisco</li>
														<li><i class="icon-material-outline-business-center"></i> Full Time</li>
														<li><i class="icon-material-outline-access-time"></i> 2 days ago</li>
													</ul>
												</div>
											</div>

										</div>
									</div>

									<!-- Buttons -->
									<div class="buttons-to-right">
										<a href="dashboard-bookmarks.html#" class="button red ripple-effect ico" title="Remove" data-tippy-placement="left"><i class="icon-feather-trash-2"></i></a>
									</div>
								</li>

								<li>
									<!-- Job Listing -->
									<div class="job-listing">

										<!-- Job Listing Details -->
										<div class="job-listing-details">

											<!-- Logo -->
											<a href="dashboard-bookmarks.html#" class="job-listing-company-logo">
												<img src="images/company-logo-05.png" alt="">
											</a>

											<!-- Details -->
											<div class="job-listing-description">
												<h3 class="job-listing-title"><a href="dashboard-bookmarks.html#">Construction Labourers</a></h3>

												<!-- Job Listing Footer -->
												<div class="job-listing-footer">
													<ul>
														<li><i class="icon-material-outline-business"></i> Podous</li>
														<li><i class="icon-material-outline-location-on"></i> San Francisco</li>
														<li><i class="icon-material-outline-business-center"></i> Full Time</li>
														<li><i class="icon-material-outline-access-time"></i> 2 days ago</li>
													</ul>
												</div>
											</div>
										</div>
									</div>

									<!-- Buttons -->
									<div class="buttons-to-right">
										<a href="dashboard-bookmarks.html#" class="button red ripple-effect ico" title="Remove" data-tippy-placement="left"><i class="icon-feather-trash-2"></i></a>
									</div>
								</li>

							</ul>
						</div>
					</div>
				</div>

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-face"></i> Bookmarked Freelancers</h3>
						</div>

						<div class="content">
							<ul class="dashboard-box-list">
								<li>
									<!-- Overview -->
									<div class="freelancer-overview">
										<div class="freelancer-overview-inner">

											<!-- Avatar -->
											<div class="freelancer-avatar">
												<div class="verified-badge"></div>
												<a href="dashboard-bookmarks.html#"><img src="images/user-avatar-big-02.jpg" alt=""></a>
											</div>

											<!-- Name -->
											<div class="freelancer-name">
												<h4><a href="dashboard-bookmarks.html#">David Peterson <img class="flag" src="images/flags/de.svg" alt="" title="Germany" data-tippy-placement="top"></a></h4>
												<span>iOS Expert + Node Dev</span>
												<!-- Rating -->
												<div class="freelancer-rating">
													<div class="star-rating" data-rating="4.2"></div>
												</div>
											</div>
										</div>
									</div>

									<!-- Buttons -->
									<div class="buttons-to-right">
										<a href="dashboard-bookmarks.html#" class="button red ripple-effect ico" title="Remove" data-tippy-placement="left"><i class="icon-feather-trash-2"></i></a>
									</div>
								</li>
								<li>
									<!-- Overview -->
									<div class="freelancer-overview">
										<div class="freelancer-overview-inner">
											
											<!-- Avatar -->
											<div class="freelancer-avatar">
												<a href="dashboard-bookmarks.html#"><img src="images/user-avatar-placeholder.png" alt=""></a>
											</div>

											<!-- Name -->
											<div class="freelancer-name">
												<h4><a href="dashboard-bookmarks.html#">Marcin Kowalski <img class="flag" src="images/flags/pl.svg" alt="" title="Poland" data-tippy-placement="top"></a></h4>
												<span>Front-End Developer</span>
												<!-- Rating -->
												<div class="freelancer-rating">
													<div class="star-rating" data-rating="4.7"></div>
												</div>
											</div>
										</div>
									</div>

									<!-- Buttons -->
									<div class="buttons-to-right">
										<a href="dashboard-bookmarks.html#" class="button red ripple-effect ico" title="Remove" data-tippy-placement="left"><i class="icon-feather-trash-2"></i></a>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>

			</div>
			<!-- Row / End -->
<?php  include('dashboard-footer.php'); ?>