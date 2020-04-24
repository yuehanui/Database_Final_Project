<?php require_once('../private/initialize.php') ?>

<!-- Define Title -->
<?php $page_title = 'Creating account'; ?>
<?php 


	if(request_is_post()) {
		$username = $_POST['username'];
		$pswd = $_POST['pswd'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$gender = $_POST['gender'];
		$martial = $_POST['martial'];
		$street_ad = $_POST['street_ad'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zipcode = $_POST['zipcode'];

	} else {
		redirect_to("index.php");
	}

?>
<?php include(SHARED_PATH . '/header.php') ?>
<?php include(SHARED_PATH . '/footer.php') ?>