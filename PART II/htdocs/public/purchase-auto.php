<?php require_once('../private/initialize.php') ?>

<!-- If user hasn't logged in, redirect to index.php-->
<?php if(!check_cookie()){
	redirect_to("index.php");}?>




<!-- Define Title -->
<?php $page_title = 'Pauchase Auto Insurance'; ?>

<!-- Common header for all pages -->
<?php include(SHARED_PATH . '/header.php') ?>

<!-- If user already purchase auto insurance, redirect to dashboard.php-->
<?php 
	$connection = admin_login('WDS_schema');
	$c_id = get_c_id($_COOKIE['username'],$connection);
	$c_type = check_customer_type($c_id, $connection);
	if ($c_type == 'A' or $c_type == 'AH'){
		echo ('<br><div class="text-center"><h4>You already purchased auto insurance.</h4></div>');
		redirect_in_time('dashboard.php',2);
		exit();
	}
?>


<div class="row" >
    <div class="col-sm-4" ></div>
    <div class="col-sm-4 ">

	     <?php 
	     	print_auto_form($_POST); 
	     ?>

	</div>
	<div class="col-sm-4 "></div>
</div>



<!-- Common footer for all pages -->
<?php include(SHARED_PATH . '/footer.php') ?>