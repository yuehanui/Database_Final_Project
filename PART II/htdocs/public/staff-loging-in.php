<!-- This file check credential for staff account -->

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

		$connection = @mysqli_connect('localhost',$username, $pswd, 'WDS_schema');
		if ($connection){
			set_cookies($username, $pswd,"S");
			echo ("Successfully logged in");
			redirect_in_time("index.php", 1);

		} else {
			echo ("Username doesn't exist or password doesn't match");
			redirect_in_time("stafflogin.php", 2);
		}
		
	} else {
	// not allowing direct access via url
		redirect_to("index.php");
	}

?>
</div>


<!-- Common footer for all pages -->
<?php include(SHARED_PATH . '/footer.php') ?>