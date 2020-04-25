<!-- This file process user input and create account for registers -->

<?php require_once('../private/initialize.php') ?>

<?php 
	if(check_cookie()){
		redirect_to("index.php");
}?>

<!-- Define Title -->
<?php $page_title = 'Loging in'; ?>

<!-- Common header for all pages -->
<?php include(SHARED_PATH . '/header.php') ?>
<div class="text-center">

<?php
	//request must be POST, preventing direct access via url
	if(request_is_post()) {
		$username = $_POST['username'];
		$pswd = $_POST['pswd'];

		$pswd_query = "SELECT PASSWORD FROM customer WHERE USERNAME= '$username'";
		$connection = admin_login('WDS_schema');
		$pswd_result = mysqli_query($connection, $pswd_query);
		if (mysqli_num_rows($pswd_result)>0){
			$pswdhash = mysqli_fetch_row($pswd_result)[0];
			if (password_verify($pswd, $pswdhash)){
				echo ("Loging in...");
				set_cookies($username, $pswdhash);
				redirect_to("index.php");


			} else {
				echo("Username not found or password doesn't match");
				header( "Refresh:2; url=customerlogin.php", true, 303);
			}
		} else {
			echo("Username not found or password doesn't match");
			header( "Refresh:2; url=customerlogin.php", true, 303);
		}
	} else {
	// not allowing direct access via url
		redirect_to("index.php");
	}

?>

</div>

<!-- Common footer for all pages -->
<?php include(SHARED_PATH . '/footer.php') ?>