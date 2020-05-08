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
<?php $table = $_POST['table'];
	  $PK = $_POST['PK_value'];
	  $page_title = 'Delete '.$table .' No.'.$PK ; 
?>

<!-- Common header for all pages -->
<?php include(SHARED_PATH . '/header.php') ?>

<div class="row" >
    <div class="col-sm-3" ></div>
    <div class="col-sm-6 text-center">
    	<br>
    	<p>Are you sure you want to delete the following record</p>
    	<p><strong><?php echo ($table .' No.'.$PK)?></strong></p>

    	<p>All the corresponding records in the child table will also be deleted  </p> 
    	
    	
    	<br>
    	<form action="/submit" method="POST" class="needs-validation" name="form" novalidate>
		      <?php
		     	foreach ($_POST as $key => $value){
		     		echo ('<input type = "hidden" name="'.h($key).'" value="'.h($value).'">');
		     	}  
		      ?>
		    <div>
		    	<button type="submit" class="btn btn-primary" onclick="javascript: form.action='deleting.php'">Confirm</button>&emsp;
		    	<button type="submit" class="btn btn-danger" onclick="javascript: form.action='dashboard.php'">Cancel</button>
		    </div>
		</form>
	</div>
	<div class="col-sm-3 "></div>
</div>




<!-- Common footer for all pages -->
<?php include(SHARED_PATH . '/footer.php') ?>