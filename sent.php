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

	$amount = mysqli_real_escape_string ($db, $_POST['amount']);
    $to_user = mysqli_real_escape_string ($db, $_POST['to_user']);
    $title = mysqli_real_escape_string ($db, $_POST['title']);
    $description = mysqli_real_escape_string ($db, $_POST['description']);

	
	function ref ($chars) {
	$data = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	return substr(str_shuffle($data), 0, $chars);
}
	$refid = ref(7);



	$sql = "INSERT INTO `transfers` SET
     `amount`='$amount',
     `status`='Pending',
     `to_user`='$to_user',
	 `title`='$title',
     `ref`='$refid',
     `description`='$description',
      `from_user`='$email' 
	    ";
	  
	
	$db->query($sql);
	if($db->error){
	
	   echo $db->error;
	}else{
 
 
 };
}






$n= 5;
$sql1 = "SELECT count(*) FROM `transfers`where from_user = '$email' ";
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



$queryDeposits = "SELECT * FROM `transfers`  where  from_user = '$email' ORDER by  id DESC LIMIT $m, $n";
$resultDeposits = mysqli_query($db,$queryDeposits);
$deposits =  mysqli_fetch_all($resultDeposits, MYSQLI_ASSOC);



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
				<h3>Sent Funds</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="dashboard-post-a-task.html#">Home</a></li>
						<li><a href="dashboard-post-a-task.html#">Dashboard</a></li>
						<li>Sent Funds</li>
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
							<h3><i class="icon-feather-folder-plus"></i>Send funds</h3>
						</div>

						<div class="content with-padding padding-bottom-10">
							<div class="row">

                            
								<div class="col-xl-6">
									<div class="submit-field">
                                    <h5>Title</h5>
										<input type="text" class="with-border" name="title"  required placeholder="Title " >
									</div>
								</div>

                            	<div class="col-xl-6">
									<div class="submit-field">
										<h5>Amount</h5>
										<input type="number" class="with-border" name="amount"  required placeholder="e.g. OPJ4563464">
									</div>
								</div>

                                
								<div class="col-xl-6">
									<div class="submit-field">
										<h5>Recipent's Email </h5>
										<input type="email" class="with-border" name="to_user"  required placeholder="e.g. OPJ4563464">
									</div>
								</div>


                                <div class="col-xl-6">
									<div class="submit-field">
                                    <h5>Description</h5>
										<input type="text" class="with-border" name="description"  required placeholder="Description" >
									</div>
								</div>

							


                                <div class="col-xl-2">
								
					<button type="submit" name="addTask" class="button ripple-effect big margin-top-0"><i class="icon-feather-plus"></i>Confirm Deposit</button>
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
            <h3><i class="icon-feather-folder-plus"></i>Sent Funds History</h3>
        </div>

      
    </div>


    <table class="basic-table">

<tbody><tr>
    <th>Date</th>
    <th>Ref </th>
    <th>Title</th>
    <th>Amount</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php	foreach ($deposits as $deposit): ?>
							
                            <tr>
    <td data-label="Column 1"><?php echo $deposit['created_at']; ?></td>
    <td data-label="Column 2"><?php echo $deposit['ref']; ?></td>
    <td data-label="Column 3"><?php echo $deposit['title']; ?></td>
    <td data-label="Column 3"><?php echo $deposit['amount']; ?></td>
    <td data-label="Column 3"><?php echo $deposit['status']; ?></td>
    <td>Update</td>


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
								echo '<li><a href="./sent.php?current_page='.$i.'" class="ripple-effect">'.$i.'</a></li>';
							}
						?>
			
						<li class="pagination-arrow"><a href="#" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
					</ul>
				</nav>
			</div>



</div>



</div>










			<?php  include('dashboard-footer.php');?>