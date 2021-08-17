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

	$title = mysqli_real_escape_string ($db, $_POST['title']);
	$category = mysqli_real_escape_string ($db, $_POST['category']);
	$location = mysqli_real_escape_string ($db, $_POST['location']);
	$minBudget = mysqli_real_escape_string ($db, $_POST['minBudget']);
	$maxBudget = mysqli_real_escape_string ($db, $_POST['maxBudget']);
	$description = mysqli_real_escape_string ($db, $_POST['description']);
	$skills = mysqli_real_escape_string ($db, $_POST['skills']);
	$user_id = mysqli_real_escape_string($db,$id);

	
	function ref ($chars) {
	$data = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	return substr(str_shuffle($data), 0, $chars);
}
	$refid = ref(7);

$cover_photo = $_FILES['brief']['name'];
$covertmpname = $_FILES['brief']['tmp_name'];
$folder = 'uploads/';
$file_name_extension= explode(".",$_FILES['brief']['name']);
$new_file_name = date('Y').date('m').date('d').time().rand(1000,9999).".".$file_name_extension[1];
$folder="uploads/"."briefs";

if(!is_dir($folder)){
mkdir($folder,0777,true);
$folder = $folder."/".$new_file_name;
}else{
$folder = $folder."/".$new_file_name;
}



move_uploaded_file($covertmpname,  $folder);

$brief =mysqli_real_escape_string($db,$folder);



	$sql = "INSERT INTO `tasks` SET
	`title` = '$title',
	 `category`='$category',
     `location`='$location',
     `minBudget`='$minBudget',
     `maxBudget`='$maxBudget',
      `description`='$description',
     `skills`='$skills',
	 `brief`='$brief',
	 `ref`='$refid',
      `user_id`='$user_id' 
	    ";
	  
	
	$db->query($sql);
	if($db->error){
	
	   echo $db->error;
	}else{
 
 
 };
}

$queryCategory = "SELECT * FROM `categories` ORDER by  category ASC";
$resultCategory = mysqli_query($db,$queryCategory);
$category =  mysqli_fetch_all($resultCategory, MYSQLI_ASSOC);

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
				<h3>Post a Task</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="dashboard-post-a-task.html#">Home</a></li>
						<li><a href="dashboard-post-a-task.html#">Dashboard</a></li>
						<li>Post a Task</li>
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
							<h3><i class="icon-feather-folder-plus"></i> Task Submission Form</h3>
						</div>

						<div class="content with-padding padding-bottom-10">
							<div class="row">

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Project Name</h5>
										<input type="text" class="with-border" name="title"  required placeholder="e.g. build me a website">
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Category</h5>
										<select class="selectpicker with-border"  name="category" data-size="7" required title="Select Category">
										<option value="0">All Categories</option>
					<?php	foreach ($category as $category): ?>
							<option value="<?php echo $category['id']; ?>"><?php echo $category['category']; ?></option>
							<?php endforeach ?>   
										</select>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Location  <i class="help-icon" data-tippy-placement="right" title="Leave blank if it's an online job"></i></h5>
										<div class="input-with-icon">
											<div id="autocomplete-container">
												<input id="autocomplete-input" name="location" class="with-border" required type="text" placeholder="Anywhere">
											</div>
											<i class="icon-material-outline-location-on"></i>
										</div>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<h5>What is your estimated budget?</h5>
										<div class="row">
											<div class="col-xl-6">
												<div class="input-with-icon">
													<input class="with-border" type="text" required name="minBudget" placeholder="Minimum">
													<i class="currency">KSH</i>
												</div>
											</div>
											<div class="col-xl-6">
												<div class="input-with-icon">
													<input class="with-border" type="text" required name="maxBudget" placeholder="Maximum">
													<i class="currency">KSH</i>
												</div>
											</div>
										</div>
									
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<h5>What skills are required? <i class="help-icon" data-tippy-placement="right" title="Up to 5 skills that best describe your project"></i></h5>
										<div class="keywords-container">
											<div class="keyword-input-container">
												<input type="text" name="skills" class="keyword-input with-border" required placeholder="Add Skills"/>
												<button class="keyword-input-button ripple-effect"><i class="icon-material-outline-add"></i></button>
											</div>
											<div class="keywords-list"><!-- keywords go here --></div>
											<div class="clearfix"></div>
										</div>

									</div>
								</div>

								<div class="col-xl-12">
									<div class="submit-field">
										<h5>Describe Your Project</h5>
										<textarea cols="30" rows="5" name="description" required class="with-border"></textarea>
										<div class="uploadButton margin-top-30">
											<input class="uploadButton-input" name="brief" type="file" required accept=" application/pdf" id="upload" multiple/>
											<label class="uploadButton-button ripple-effect" for="upload">Upload Files</label>
											<span class="uploadButton-file-name">Images or documents that might be helpful in describing your project</span>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-12">
					<button type="submit" name="addTask" class="button ripple-effect big margin-top-30"><i class="icon-feather-plus"></i> Post a Task</button>
				</div>

			</div>
			<!-- Row / End -->
</form>
			<?php  include('dashboard-footer.php');?>