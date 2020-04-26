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
		$username = $_COOKIE['username'];
		$connection = admin_login('WDS_schema');

		$parsed_data_h = [];
		$parsed_data_a = [];
		if ($_POST['c_type'] == 'H' or $_POST['c_type'] == 'AH'){
			$select_list = ['h_start_date','h_end_date','h_premium','h_status'];
			$select_list_str =select_list_to_str($select_list);
			$query = "SELECT $select_list_str FROM home_insurance a JOIN customer b ON a.c_id = b.c_id WHERE b.username = '$username'";

			$result = mysqli_query($connection,$query);
			
			
			while($line = mysqli_fetch_assoc($result)){
				array_push($parsed_data_h, array_merge(array('Insurance Type' => "Home Insurance"), parse_data($line)));
			}
			
		} if($_POST['c_type'] == 'A' or $_POST['c_type'] == 'AH'){ $select_list = ['a_start_date','a_end_date','a_premium','a_status'];
			$select_list_str =select_list_to_str($select_list);
			$query = "SELECT $select_list_str FROM auto_insurance a JOIN customer b ON a.c_id = b.c_id WHERE b.username = '$username'";

			$result = mysqli_query($connection,$query);
			
			while($line = mysqli_fetch_assoc($result)){
				array_push($parsed_data_a, array_merge(array('Insurance Type' => "Auto Insurance"), parse_data($line)));
			}

		}
		$parsed_data = array_merge($parsed_data_h,$parsed_data_a);
		$print_list =array_merge(['Insurance type'], select_list_to_print($select_list));
			print_table($print_list, $parsed_data);



	} else {

		redirect_to("index.php");
	}



?>




<!-- Common footer for all pages -->
<?php include(SHARED_PATH . '/footer.php') ?>