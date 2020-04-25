<!-- This file check credential for client account -->

<?php require_once('../private/initialize.php') ?>

<!-- If user has already logged in, redirect to index.php-->
<?php if(check_cookie()){redirect_to("index.php");}?>

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
				set_cookies($username, $pswdhash, "C");
				header( "Refresh:1; url=index.php", true, 303);
			} else {
				echo("Username not found or password doesn't match");
				redirect_in_time("customerlogin.php", 2);
			
			}
		} else {
			echo("Username not found or password doesn't match");
			redirect_in_time("customerlogin.php", 2);
		}
	} else {
	// not allowing direct access via url
		redirect_to("index.php");
	}

?>

</div>

<!-- Common footer for all pages -->
<?php include(SHARED_PATH . '/footer.php') ?>