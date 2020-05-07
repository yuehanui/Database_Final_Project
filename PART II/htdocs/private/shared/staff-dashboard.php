<!-- This file contains the dashboard conents for staff -->


<?php 
	// use staff credentials to login to the database
	$username = $_COOKIE['username'];
	$pswd = $_SESSION[$username][2];
	$connection = staff_login($username, $pswd,'WDS_schema');

	// retrieve all customer's infomation
	$select_list = ['c_id', 'c_fname', 'c_lname', 'gender', 'martial_sta', 'c_street_ad', 'c_city', 'c_state', 'c_zipcode','c_type'];

	$select_list_str = select_list_to_str($select_list);

	$query = "SELECT $select_list_str FROM customer ";
	$print_list = select_list_to_print($select_list);
	$result = mysqli_query($connection,$query);

	$parsed_data = [];
	while($line = mysqli_fetch_assoc($result)){
		array_push($parsed_data, parse_data($line));
	}
	print_table($print_list, $parsed_data);

?>