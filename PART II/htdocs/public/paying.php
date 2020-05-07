<?php require_once('../private/initialize.php') ?>

<!-- If user hasn't logged in, redirect to index.php-->
<?php if(!check_cookie()){
	redirect_to("index.php");}?>

<!-- Define Title -->
<?php $page_title = 'Paying...'; ?>
	

<!-- Common header for all pages -->
<?php include(SHARED_PATH . '/header.php') ?>

<?php 


	//request must be POST, preventing direct access via url
	if(!request_is_post()) {
		redirect_to("index.php");
	}
	//$connect to the database
	$connection = admin_login('WDS_schema');

	$c_id = h($_POST["c_id"]);
	$c_type = h($_POST["c_type"]);
	$inv_id = h($_POST["inv_id"]);
	$amount = h($_POST["amount"]);
	$method = h($_POST["method"]);
	
	// insert payment
	if ($c_type == 'A'){
		$a_payment_id = find_next_PK('a_payment_id', 'a_payment',$connection) or $a_payment_id = 1000000;
		$insert_payment = "INSERT INTO a_payment(a_inv_id,a_payment_id,a_pay_date,a_pay_method,a_pay_amount) VALUES ($inv_id, $a_payment_id,CURDATE(),'$method', $amount)";

	} else if ($c_type == 'H'){
		$h_payment_id = find_next_PK('h_payment_id', 'h_payment',$connection) or $h_payment_id = 1000000;
		$insert_payment = "INSERT INTO h_payment(h_inv_id,h_payment_id,h_pay_date,h_pay_method,h_pay_amount) VALUES ($inv_id, $h_payment_id, CURDATE(),'$method',$amount)";
	} else {
		exit('Error 19');
	}
	mysqli_query($connection,$insert_payment);

	echo('<div class="text-center">Successfully payed</div>');
	redirect_in_time("dashboard.php", 2);



?>



<!-- Common footer for all pages -->
<?php include(SHARED_PATH . '/footer.php') ?>