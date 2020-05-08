<?php require_once('../private/initialize.php') ?>

<!-- If user hasn't logged in, redirect to index.php-->
<?php if(!check_cookie()){
	redirect_to("index.php");}?>

<!-- Define Title -->
<?php $c_type = h($_POST["c_type"]);
	switch ($c_type){
		case "A":
			$page_title = 'Pay Auto Insurance';
			break;
		case "H":
			$page_title = 'Pay Home Insurance'; 
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
	
	// query the invoice amount
	if ($c_type == 'A'){
		$query = "SELECT a_inv_amount as inv_amount,DATE_FORMAT(a_inv_due_date,'%Y-%m-%d') as due_date,a_inv_id as inv_id FROM a_invoice where c_id = $c_id";
	} else if ($c_type == 'H'){
		$query = "SELECT h_inv_amount as inv_amount,DATE_FORMAT(h_inv_due_date,'%Y-%m-%d') as due_date, h_inv_id as inv_id FROM h_invoice where c_id = $c_id";
	} else {
		exit('Error 16');
	}
	$result = mysqli_query($connection,$query);
	while($line = mysqli_fetch_assoc($result)){
		$total_amount = $line['inv_amount'];
		$due_date = $line['due_date'];
		$inv_id = $line['inv_id'];
	}
	//free the result
	mysqli_free_result($result);
	// query the payment history
	if ($c_type == 'A'){
		$query = "SELECT a_pay_amount as amount FROM a_payment a JOIN a_invoice b ON a.a_inv_id=b.a_inv_id where b.c_id = $c_id";
	} else if ($c_type == 'H'){
		$query = "SELECT h_pay_amount as amount FROM h_payment a JOIN h_invoice b ON a.h_inv_id=b.h_inv_id where b.c_id = $c_id";
	} else {
		exit('Error 17');
	}

	// calculate the toal amount that had been payed
	$payed_amount = 0;
	$result = mysqli_query($connection,$query);
	while($line = mysqli_fetch_assoc($result)){
		$payed_amount += $line['amount'];
	}
	//free the result
	mysqli_free_result($result);
	//close the connection
	mysqli_close($connection);

	//calculate the amount due
	$amount_due = $total_amount - $payed_amount;

?>
<div class="row" >
  <div class="col-sm-4" ></div>
  <div class="col-sm-4 " ><br>
  	<div class="text-center"> 
  	  <h4><?php echo ('$'. $amount_due.' is due '. $due_date)?></h4>
    </div><br>
	<form action="paying.php" method="POST" class="needs-validation" novalidate>
	    <!-- Amount -->
	    <div class="form-group">
	      <label for="amount">Amount($):</label>
	      <input type="number" class="form-control" id="amount" placeholder="maximum payment:<?php echo ('$'.$amount_due); ?>" name="amount" required min="0" max="<?php echo $amount_due ?>" >
	      </div>

	    <!-- Method -->
	    <div class="form-group">
	      <label for="method">Method:</label>
	      <select class="form-control" id="method" name="method">
	        <option value = "PayPal">PayPal</option>
				<option value = "Credit">Credit</option>
				<option value = "Debit">Debit</option>
				<option value = "Check">Check</option>
			</select>
		  </div>

		<!-- hidden inputs-->
		<input type="hidden" name="c_type" value="<?php echo $c_type; ?>">
		<input type="hidden" name="c_id" value="<?php echo $c_id; ?>">
		<input type="hidden" name="inv_id" value="<?php echo $inv_id; ?>">

	    <div class="text-center">
	    	<button type="submit" class="btn btn-primary">Submit</button>
	    </div>
	</form>
</div><div class="col-sm-4 " >
 </div>


<!-- Common footer for all pages -->
<?php include(SHARED_PATH . '/footer.php') ?>