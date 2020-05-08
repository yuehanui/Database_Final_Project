<?php require_once('../private/initialize.php') ?>

<!-- If user hasn't logged in, redirect to index.php-->
<?php if(!check_cookie()){
	redirect_to("index.php");}?>

<!-- Define Title -->
<?php $page_title = 'Assets'; ?>

<!-- Common header for all pages -->
<?php include(SHARED_PATH . '/header.php') ?>

<?php 


	//request must be POST, preventing direct access via url
	if(!request_is_post()) {
		redirect_to("index.php");
	}
	//$connect to the database
	$connection = admin_login('WDS_schema');

	$c_id = $_POST["c_id"];
	$c_type = $_POST["c_type"];
	$parsed_data=[];
	if ($c_type == 'A'){

		$print_list = ['Customer ID','Vehicle ID','VIN','Make', 'Model', 'Year', 'Vehicle Status', 'Drivers'];
		$query = "SELECT c_id,vehicle_id,vin, make, model, year, v_status FROM vehicle where c_id = $c_id";
		$result = mysqli_query($connection,$query);
		while($line = mysqli_fetch_assoc($result)){
			array_push($parsed_data,parse_data($line)+driver_button($line['vehicle_id']));
		}

	} else if ($c_type == 'H'){
		$print_list = ['Customer ID','Purchase Date','Value($)', 'Area(Sq.Ft.)', 'Home Type', 'Auto Fire Notification','Security System', 'Swimming Pool','Basement'];
		$query = "SELECT c_id,DATE_FORMAT(pur_date,'%Y-%m-%d') as pur_date,pur_value,homearea,hometype,auto_fire,sec_sys,swim_pool,basement FROM home where c_id = $c_id";
		$result = mysqli_query($connection,$query);
		while($line = mysqli_fetch_assoc($result)){
			array_push($parsed_data,parse_data($line));
		}

	} else {
		exit('Error 15');
	}
	mysqli_free_result($result);
	//close the connection
	mysqli_close($connection);
	print_table($print_list, $parsed_data);
?>




<!-- Common footer for all pages -->
<?php include(SHARED_PATH . '/footer.php') ?>