<?php require_once('../private/initialize.php') ?>

<!-- If user hasn't logged in, redirect to index.php-->
<?php if(!check_cookie()){
	redirect_to("index.php");}?>

<!-- Define Title -->
<?php $page_title = 'Pauchasing'; ?>

<!-- Common header for all pages -->
<?php include(SHARED_PATH . '/header.php') ?>

<?php 
	$connection = admin_login('WDS_schema');
	$c_id = get_c_id($_COOKIE['username'], $connection);
	$preimum = 3200;

	if ($_POST["insu_type"] == "A"){
		insert_auto_insurance($_POST,$c_id, $preimum,$connection);
		insert_vehicles_n_drivers($_POST, $c_id, $connection);
		insert_auto_invoice($_POST, $c_id, $connection, $preimum);
	} else if ($_POST["insu_type"] == "H"){
		insert_home_insurance($_POST,$c_id, $preimum,$connection);
		insert_homes($_POST, $c_id, $connection);
		insert_home_invoice($_POST, $c_id, $connection, $preimum);
	}
	//close the connection
	mysqli_close($connection);
	echo ('<div class="text-center"<h3>Successfully subcribed</h3></div>');
	redirect_in_time('dashboard.php',2);
?>
