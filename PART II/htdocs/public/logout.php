<!-- this file is use to log user out by unset cookies -->

<?php require_once('../private/initialize.php') ?>

<!-- Define Title -->
<?php $page_title = 'Loging out...'; ?>

<!-- Common header for all pages -->
<?php include(SHARED_PATH . '/header.php') ?>
<div class="text-center">
<?php 
	if(check_cookie()){
		unset_cookies_n_session();
		echo ("Loging out...");
		redirect_in_time("index.php",1);;
	} else {
		redirect_to("index.php");
	}
?>
</div>
<!-- Common footer for all pages -->
<?php include(SHARED_PATH . '/footer.php') ?>
