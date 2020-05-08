<!-- This file contains the dashboard conents for customer -->

<?php 

	$username = $_COOKIE['username'];
	$connection = admin_login('WDS_schema');

	//retrieve  customer's infomation
	$select_list = 'c_id, c_fname, c_lname, gender, martial_sta, c_street_ad, c_city, c_state, c_zipcode,c_type';
	$query = "SELECT $select_list FROM customer WHERE username = '$username'";

	
	$result = mysqli_query($connection,$query);

	$parsed_data = [];
	while($line = mysqli_fetch_assoc($result)){
		array_push($parsed_data, parse_data($line));
	}
	mysqli_free_result($result);
	//close the connection
	mysqli_close($connection);

	$header_list = ['Customer ID','First Name', 'Last Name','Gender','Martial Status', 'Street Address', 'City','State','Zip Code','Subcriptions'];

	print_table($header_list, $parsed_data);

?>