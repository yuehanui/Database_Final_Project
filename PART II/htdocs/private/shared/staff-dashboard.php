<!-- This file contains the dashboard conents for staff -->


<?php 
	// use staff credentials to login to the database
	$username = $_COOKIE['username'];
	$pswd = $_SESSION[$username][2];
	$connection = staff_login($username, $pswd,'WDS_schema');

	// retrieve all customers' infomation
	$select_list = 'c_id, c_fname, c_lname, gender, martial_sta, c_street_ad, c_city, c_state, c_zipcode,c_type';
	$query = "SELECT $select_list FROM customer ";
	$result = mysqli_query($connection,$query);

	$parsed_data = [];
	while($line = mysqli_fetch_assoc($result)){
		$c_id = $line['c_id'];
		array_push($parsed_data, parse_data($line)+delete_button('customer','c_id',$c_id));
	}
	
	mysqli_free_result($result);
	//close the connection
	mysqli_close($connection);

	$header_list = ['Customer ID','First Name', 'Last Name','Gender','Martial Status', 'Street Address', 'City','State','Zip Code','Subcriptions','Delete'];
	print_table($header_list, $parsed_data);

?>