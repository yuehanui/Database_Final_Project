<?php require_once('../private/initialize.php') ?>

<!-- If user hasn't logged in, redirect to index.php-->
<?php if(!check_cookie()){
	redirect_to("index.php");}?>

<!-- Define Title -->
<?php $page_title = 'Quote'; ?>

<!-- Common header for all pages -->
<?php include(SHARED_PATH . '/header.php') ?>
<div class="row" >
    <div class="col-sm-4" ></div>
    <div class="col-sm-4 text-center">
    	<br>
    	<p>Based on your information, the premium would be</p> 
    	<h4>$3,200</h4>
    	<p>due in 6 months from the beginning of the insurance</p>
    	<br>
    	<form action="/submit" method="POST" class="needs-validation" name="form" novalidate>
		    
		      <?php
		     	foreach ($_POST as $key => $value){
		     		echo ('<input type = "hidden" name="'.h($key).'" value="'.h($value).'">');
		     	}  
		      ?>
      		 
		    <div class="text-center">
		    	<button type="submit" class="btn btn-primary" onclick="javascript: form.action='purchasing.php'">Accept</button>
		    	<button type="submit" class="btn btn-danger" onclick="javascript: form.action='dashboard.php'">Reject</button>
		    </div>
		</form>


	</div>
	<div class="col-sm-4 "></div>
</div>
	