<!-- This file is use to confirm deleting a record for staff-->

<?php require_once('../private/initialize.php') ?>

<!-- If user hasn't logged in, redirect to index.php-->
<?php if(!check_cookie()){
	redirect_to("index.php");}?>

<!-- Only staff are allows to delete record, if account type is not 'S'(staff), redirect to index.php-->
<?php if(check_account_type() != "S"){
	redirect_to("index.php");}?>


<!-- request must be POST, preventing direct access via url -->
<?php if(!request_is_post()) {
		redirect_to("index.php");}
?>

<!-- Define Title -->
<?php 
	  $page_title = 'Deleting...'; 
?>


<!-- Common header for all pages -->
<?php include(SHARED_PATH . '/header.php') ?>



<?php 
	//connect to the dabatase
	$connection = admin_login('WDS_schema');
	$table=h($_POST['table']);
	$PK_name=h($_POST['PK_name']);
	$PK_value=h($_POST['PK_value']);

	//delte the record
	$delete = 'DELETE FROM '.$table.' WHERE '.$PK_name.' = '. $PK_value;
	mysqli_query($connection,$delete);

	//if delted auto_insurace or home_insurance, change c_type in customer table
	if($table=='auto_insurance' or $table=='home_insurance'){
		//get the current c_type value
		$type_query = 'SELECT c_type FROM customer WHERE c_id='.$PK_value;
		echo $type_query;
		$result = mysqli_query($connection,$type_query);
		$curr_c_type = mysqli_fetch_assoc($result)['c_type'];
		echo ($curr_c_type);
		mysqli_free_result($result);
		// if deleteing auto insurance
		if($table=='auto_insurance'){
			if ($curr_c_type == "A"){
				$update_c_type = 'UPDATE customer SET c_type =NULL WHERE c_id='.$PK_value;
			} else {
				$update_c_type = 'UPDATE customer SET c_type ="H" WHERE c_id='.$PK_value;
			}
		} 
		// if deleteing home insurance
		else {
			if ($curr_c_type == "H"){
				$update_c_type = 'UPDATE customer SET c_type =NULL WHERE c_id='.$PK_value;
			} else {
				$update_c_type = 'UPDATE customer SET c_type ="A" WHERE c_id='.$PK_value;
			}
		}
		mysqli_query($connection,$update_c_type);
	}
	if ($table=='home_insurance')

	
	echo('<div class="text-center"><p>Successfully deleted '.$table.' No. '.$PK_value.'</p></div>');

	//close the connection
	mysqli_close($connection);
?>


<!-- Common footer for all pages -->
<?php include(SHARED_PATH . '/footer.php') ?>