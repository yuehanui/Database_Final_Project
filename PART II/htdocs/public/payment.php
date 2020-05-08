<?php require_once('../private/initialize.php') ?>

<!-- If user hasn't logged in, redirect to index.php-->
<?php if(!check_cookie()){
	redirect_to("index.php");}?>

<!-- Define Title -->
<?php $c_type = h($_POST["c_type"]);
	switch ($c_type){
		case "A":
			$page_title = 'Auto Insurance Payments';
			break;
		case "H":
			$page_title = 'Home Insurance Payments'; 
			break;
		}
?>

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
	$parsed_data=[];

	// query the payment infomation
	if ($c_type == 'A'){
		$query = "SELECT a.a_inv_id, a_payment_id,DATE_FORMAT(a_pay_date,'%Y-%m-%d') as a_pay_date, a_pay_method,a_pay_amount FROM a_payment a JOIN a_invoice b ON a.a_inv_id=b.a_inv_id where b.c_id = $c_id";
		
	} else if ($c_type == 'H'){
		$query = "SELECT a.h_inv_id, h_payment_id,DATE_FORMAT(h_pay_date,'%Y-%m-%d') as h_pay_date, h_pay_method,h_pay_amount FROM h_payment a JOIN h_invoice b ON a.h_inv_id=b.h_inv_id where b.c_id = $c_id";

	} else {
		exit('Error 15');
	}
	$result = mysqli_query($connection,$query);
	while($line = mysqli_fetch_assoc($result)){
		array_push($parsed_data,parse_data($line));
	}
	// print the data
	$print_list = ['Invoice ID','Payment ID','Date','Pay Method', 'Amount($)'];
	mysqli_free_result($result);
	//close the connection
	mysqli_close($connection);
	print_table($print_list, $parsed_data);

?>

<!-- if it is customer account , show button to pay-->
<?php

if ($_SESSION[$_COOKIE['username']][1] == "C"){
echo ('<br><div class="text-center">
<form action="pay.php" method="post">
      <input type="hidden" name="c_id" value="'.$c_id.'">
      <input type="hidden" name="c_type" value="'.$c_type.'">
  <button type="submit" class="btn btn-outline-success">Pay Now</button>
</form>
</div>');
}

?>




<!-- Common footer for all pages -->
<?php include(SHARED_PATH . '/footer.php') ?>