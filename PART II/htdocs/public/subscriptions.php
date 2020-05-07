<?php require_once('../private/initialize.php') ?>

<!-- If user hasn't logged in, redirect to index.php-->
<?php if(!check_cookie()){
	redirect_to("index.php");}?>

<!-- Define Title -->
<?php $page_title = 'Subscriptions'; ?>

<!-- Common header for all pages -->
<?php include(SHARED_PATH . '/header.php') ?>

<?php 
	//request must be POST, preventing direct access via url
	if(request_is_post()) {

		//$connect to the database
		$connection = admin_login('WDS_schema');

		$c_id = h($_POST['c_id']);
		$c_type = h($_POST['c_type']);
		$parsed_data_h = [];
		$parsed_data_a = [];
		if ($c_type == 'H' or $c_type == 'AH'){

			$select_list_str = 'DATE_FORMAT(h_start_date,"%Y-%m-%d") as h_start_date,DATE_FORMAT(h_end_date,"%Y-%m-%d") as h_end_date,concat("$", round(h_premium)) as h_premium,h_status';
			$query = "SELECT $select_list_str FROM home_insurance WHERE c_id = $c_id";
			$result = mysqli_query($connection,$query);
			while($line = mysqli_fetch_assoc($result)){
				$type = array('Insurance Type' => "Home Insurance");
				$asset = array('Assets' => print_assets($c_id,'H'));
				$invoice = array('Invoice' => print_invoice($c_id,'H'));
				array_push($parsed_data_h,($type + parse_data($line) + $asset + $invoice));

			}
			mysqli_free_result($result);

			
		} if($c_type == 'A' or $c_type == 'AH'){ 

			$select_list_str = 'DATE_FORMAT(a_start_date,"%Y-%m-%d") as a_start_date,DATE_FORMAT(a_end_date,"%Y-%m-%d") as a_end_date,concat("$", round(a_premium)) as a_premium,a_status';
			$query = "SELECT $select_list_str FROM auto_insurance WHERE c_id = $c_id";

			$result = mysqli_query($connection,$query);
			
			while($line = mysqli_fetch_assoc($result)){
				$type = array('Insurance Type' => "Auto Insurance");
				$asset = array('Assets' => print_assets($c_id,'A'));
				$invoice = array('Invoice' => print_invoice($c_id,'A'));
				array_push($parsed_data_a,($type + parse_data($line) + $asset + $invoice));
			}
			mysqli_free_result($result);

		}

		$head_list = ['Insurance type','Start Date','End Date','Premium','Status','Assets','Invoice'];
		$parsed_data = array_merge($parsed_data_h,$parsed_data_a);
			print_table($head_list, $parsed_data);



	} else {

		redirect_to("index.php");
	}



?>




<!-- Common footer for all pages -->
<?php include(SHARED_PATH . '/footer.php') ?>