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






$n= 10;
$sql1 = "SELECT count(*) FROM `transfers`where to_user = '$email' ";
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



$queryDeposits = "SELECT * FROM `transfers`  where  to_user = '$email' ORDER by  id DESC LIMIT $m, $n";
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
				<h3>Received Funds</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="dashboard-post-a-task.html#">Home</a></li>
						<li><a href="dashboard-post-a-task.html#">Dashboard</a></li>
						<li>Received Funds</li>
					</ul>
				</nav>
			</div>
	

<br><br>

<div class="row">

<!-- Dashboard Box -->
<div class="col-xl-12">
    <div class="dashboard-box margin-top-0">

        <!-- Headline -->
        <div class="headline">
            <h3><i class="icon-feather-folder-plus"></i>Received Funds History</h3>
        </div>

      
    </div>


    <table class="basic-table">

<tbody><tr>
    <th>Date</th>
    <th>Ref </th>
    <th>Title</th>
    <th>Amount</th>
    <th>Status</th>
</tr>

<?php	foreach ($deposits as $deposit): ?>
							
                            <tr>
    <td data-label="Created at"><?php echo $deposit['created_at']; ?></td>
    <td data-label="Ref"><?php echo $deposit['ref']; ?></td>
    <td data-label="Title"><?php echo $deposit['title']; ?></td>
    <td data-label="Amount"><?php echo $deposit['amount']; ?></td>
    <td data-label="Status"><?php echo $deposit['status']; ?></td>


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
								echo '<li><a href="./received.php?current_page='.$i.'" class="ripple-effect">'.$i.'</a></li>';
							}
						?>
			
						<li class="pagination-arrow"><a href="#" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
					</ul>
				</nav>
			</div>



</div>



</div>










			<?php  include('dashboard-footer.php');?>