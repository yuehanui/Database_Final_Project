<?php require_once('../private/initialize.php') ?>

<!-- If user hasn't logged in, redirect to index.php-->
<?php if(!check_cookie()){
	redirect_to("index.php");}?>

<!-- Define Title -->
<?php $page_title = 'Drivers'; ?>

<!-- Common header for all pages -->
<?php include(SHARED_PATH . '/header.php') ?>

<?php 


	//request must be POST, preventing direct access via url
	if(!request_is_post()) {
		redirect_to("index.php");
	}
	//$connect to the database
	$connection = admin_login('WDS_schema');

	$vehicle_id = $_POST["v_id"];
	$head_list =['Driver\'s License No.','First Name','Last Name','Birthdate'];
	$query = 'SELECT license_no, driver_fname,driver_lname,driver_bdate FROM driver a JOIN vehicle_driver b ON a.driver_id=b.driver_id WHERE b.vehicle_id = '.$vehicle_id;
	$result = mysqli_query($connection,$query);
	$parsed_data = [];
	while($line = mysqli_fetch_assoc($result)){
		array_push($parsed_data,parse_data($line));
	}
	mysqli_free_result($result);
	print_table($head_list, $parsed_data);
?>




<!-- Common footer for all pages -->
<?php include(SHARED_PATH . '/footer.php') ?>