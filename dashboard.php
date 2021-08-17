<?php 
require('config/db.php');



session_start();
if(!isset($_SESSION["email"])){
header("Location: login.php");
exit(); 
}else if(isset($_SESSION["email"])){
    $email= $_SESSION['email'];
    $id = $_SESSION['id'];
};


include('balance.php');

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
				<h3 ><strong>Hi there, </strong><strong class="text-capitalize"><?php echo $userHeader['firstName']; ?></strong></h3>
				<span>We are glad to see you again!</span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="dashboard.html#">Home</a></li>
						<li>Dashboard</li>
					</ul>
				</nav>
			</div>
	
			<!-- Fun Facts Container -->
			<div class="fun-facts-container">
				<div class="fun-fact" data-fun-fact-color="#36bd78">
					<div class="fun-fact-text">
						<span>Tasks Posted</span>
						<h4>22</h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-material-outline-gavel"></i></div>
				</div>
				<div class="fun-fact" data-fun-fact-color="#b81b7f">
					<div class="fun-fact-text">
						<span>Bids Made / Received</span>
						<h4>4</h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-material-outline-business-center"></i></div>
				</div>
				<div class="fun-fact" data-fun-fact-color="#efa80f">
					<div class="fun-fact-text">
						<span>Jobs Posted/ Applied</span>
						<h4>28</h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-material-outline-rate-review"></i></div>
				</div>


				<div class="fun-fact" data-fun-fact-color="#efa80f">
					<div class="fun-fact-text">
						<span>Wallet Balance</span>
						<h4><?php  echo $balance; ?></h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-material-outline-rate-review"></i></div>
				</div>

				<!-- Last one has to be hidden below 1600px, sorry :( -->
			
			</div>

			<!--deposits --->
<br><br>
			<div class="fun-facts-container">
			<div class="col-6 fun-fact">
			<span class="fun-fact-text">Deposit</span>

		
									
	
									
				<div class="col-xl-12">
				<div class="submit-field">
				<h5>Details</h5>

				<div class="row m-0 p-0">

				<input type="text" class="col-xl-6  col-lg-6 col-md-12 col-sm-12 col-12" name="title"  required placeholder="Paybill: 2 1 5 2 1 5" disabled>

				<input type="text" class=" col-xl-6 col-lg-6 col-md-12  col-12" name="title"  required placeholder="Account: 0700417377 " disabled>
				</div>
						
										<h5>M-Pesa Code</h5>
										<input type="text" class="with-border" name="title"  required placeholder="e.g. OPA45635H">
									</div>

					<button>Confirm</button>	

					</div>		

			
			</div>

			<div class="col-6 fun-fact">
			<span class="fun-fact-text">Withdraw</span>
	
			<div class="col-xl-12">
									<div class="submit-field">
										<h5>Enter Amount</h5>
										<input type="number" class="with-border" name="title"  required placeholder="e.g. 420">
									</div>

									<div class="submit-field">
										<h5>Enter Number</h5>
										<input type="phone" class="with-border" name="title"  required placeholder="e.g. +254700419377">
									</div>



					<button>Confirm</button>	

					</div>		
			
			
			</div>
			
			</div>
			
		


			<!-- Footer -->
	<?php include('dashboard-footer.php'); ?>
			<!-- Footer / End -->

		</div>
	</div>
	<!-- Dashboard Content / End -->

</div>
<!-- Dashboard Container / End -->

</div>
<!-- Wrapper / End -->



</body>
</html>