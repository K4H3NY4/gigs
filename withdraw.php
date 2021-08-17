<?php 

 include('config/db.php');
 
 session_start();
if(!isset($_SESSION["email"])){
header("Location: login.php");
exit(); 
}else if(isset($_SESSION["email"])){
    $email= $_SESSION['email'];
    $id = $_SESSION['id'];
	//$accountType =$_SESSION['accountType'];
};

 
 if(isset($_POST['addTask'])){

	//$transaction_id = mysqli_real_escape_string ($db, $_POST['transaction_id']);
	$amount = mysqli_real_escape_string ($db, $_POST['amount']);
    $phone_number = mysqli_real_escape_string ($db, $_POST['phone_number']);

	$user_id = mysqli_real_escape_string($db,$id);



	
	function ref ($chars) {
	$data = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	return substr(str_shuffle($data), 0, $chars);
}
	$refid = ref(7);

    $service_charge = $amount * 0.1;
    $received = $amount - $service_charge;



	$sql = "INSERT INTO `withdraws` SET
	 `transaction_id`='$refid',
     `amount`='$amount',
     `service_charge`='$service_charge',
     `received`='$received',
     `payment_mode`='M-Pesa',
     `status`='Pending',
     `phone_number`='$phone_number',
      `user_id`='$user_id' 
	    ";
	  
	
	$db->query($sql);
	if($db->error){
	
	   echo $db->error;
	}else{
 
 
 };
}






$n= 5;
$sql1 = "SELECT count(*) FROM `withdraws`where user_id = '$id' ";
$result = mysqli_query($db,$sql1);
$array = $result ->fetch_array();
$total_row_number = $array['count(*)'];

$total_button_number = ceil($total_row_number/$n);
/*
for ($i=1;$i<=$total_button_number;$i++){
	echo '<li><a href="./tasks.php?current_page='.$i.'" class="ripple-effect">'.$i.'</a></li>';
	
}
*/

if (empty($_GET['current_page'])){
	$page = 1;
}else{
	$_GET['current_page'] = (int) $_GET['current_page'];
//	var_dump($_GET['current_page']);
	if ($_GET['current_page']> 0 && $_GET['current_page'] <=$total_button_number){
		$page = $_GET['current_page'];
	}else{
		$page = 1;
	}

} 

$m = ($page-1) * $n;



$queryWithdraws = "SELECT * FROM `withdraws`  where  user_id = '$id' ORDER by  id DESC LIMIT $m, $n";
$resultWithdraws = mysqli_query($db,$queryWithdraws);
$withdraws =  mysqli_fetch_all($resultWithdraws, MYSQLI_ASSOC);



include('header.php'); 
 ?>

<div class="clearfix"></div>
<!-- Header Container / End -->


<!-- Dashboard Container -->
<div class="dashboard-container">

	<!-- Dashboard Sidebar
	================================================== -->
<?php include('sidebar.php');?>
	<!-- Dashboard Sidebar / End -->


	<!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Withdraw Funds</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="dashboard-post-a-task.html#">Home</a></li>
						<li><a href="dashboard-post-a-task.html#">Dashboard</a></li>
						<li>Withdraw</li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			<form method="post" enctype="multipart/form-data" >
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-feather-folder-plus"></i>Withdraw funds</h3>
						</div>

						<div class="content with-padding padding-bottom-10">
							<div class="row">


								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Amount</h5>
										<input type="text" class="with-border" name="amount"  required placeholder="e.g. 500">
									</div>
								</div>

                                
								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Phone Number</h5>
										<input type="text" class="with-border" name="phone_number"  required placeholder="e.g. +254700419377">
									</div>
								</div>


                                <div class="col-xl-2">
								
					<button type="submit" name="addTask" class="button ripple-effect big margin-top-40"><i class="icon-feather-plus"></i>Request Withdraw</button>
								</div>

							
							
							

						

							

							</div>
						</div>
					</div>
				</div>

			</div>
			<!-- Row / End -->
</form>

<br><br>

<div class="row">

<!-- Dashboard Box -->
<div class="col-xl-12">
    <div class="dashboard-box margin-top-0">

        <!-- Headline -->
        <div class="headline">
            <h3><i class="icon-feather-folder-plus"></i>Withdraw History</h3>
        </div>

      
    </div>


    <table class="basic-table">

<tbody><tr>
    <th>Date</th>
    <th>Transaction ID</th>
    <th>Amount</th>
    <th>Service Charge</th>
    <th>Received</th>
    <th>Payment Mode</th>
    <th>Status</th>
</tr>

<?php	foreach ($withdraws as $withdraw): ?>
							
                            <tr>
    <td data-label="Column 1"><?php echo $withdraw['created_at']; ?></td>
    <td data-label="Column 2"><?php echo $withdraw['transaction_id']; ?></td>
    <td data-label="Column 3"><?php echo $withdraw['amount']; ?></td>
    <td data-label="Column 3"><?php echo $withdraw['service_charge']; ?></td>
    <td data-label="Column 3"><?php echo $withdraw['received']; ?></td>
     <td data-label="Column 3"><?php echo $withdraw['payment_mode']; ?></td>
     <td data-label="Column 3"><?php echo $withdraw['status']; ?></td>

    


</tr>
							<?php endforeach ?>  


</tbody>

		
</table>
	<!-- Pagination -->
    <div class="clearfix"></div>
			<div class="pagination-container margin-top-20 margin-bottom-20">
				<nav class="pagination">
					<ul>
						<li class="pagination-arrow"><a href="#" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-left"></i></a></li>
						<?php 
							for ($i=1;$i<=$total_button_number;$i++){
								echo '<li><a href="./withdraw.php?current_page='.$i.'" class="ripple-effect">'.$i.'</a></li>';
							}
						?>
			
						<li class="pagination-arrow"><a href="#" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
					</ul>
				</nav>
			</div>



</div>



</div>










			<?php  include('dashboard-footer.php');?>