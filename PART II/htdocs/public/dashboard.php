<?php require_once('../private/initialize.php') ?>

<!-- If user hasn't logged in, redirect to index.php-->
<?php if(!check_cookie()){
	redirect_to("index.php");}?>

<!-- Define Title -->
<?php $page_title = 'Dashboard'; ?>

<!-- Common header for all pages -->
<?php include(SHARED_PATH . '/header.php') ?>

<?php
	$username = $_COOKIE['username'];
	$type = $_SESSION[$username][1];
	if ($type == "S"){
		include(SHARED_PATH . '/staff-dashboard.php');
	} elseif (($type == "C")){
		include(SHARED_PATH . '/customer-dashboard.php');
	} else {
		echo ("Stysem Error 1;");
	}
?>
<!-- Common footer for all pages -->
<?php include(SHARED_PATH . '/footer.php') ?>




