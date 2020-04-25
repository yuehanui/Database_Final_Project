

<?php require_once('../private/initialize.php') ?>

<!-- Define Title -->
<?php $page_title = 'Loging out...'; ?>

<!-- Common header for all pages -->
<?php include(SHARED_PATH . '/header.php') ?>

<?php 
	if(check_cookie()){
		unset_cookies();
		redirect_to("index.php");
	} else {
		redirect_to("index.php");
	}
?>
	
<!-- Common footer for all pages -->
<?php include(SHARED_PATH . '/footer.php') ?>
