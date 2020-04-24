<!-- This file contains the common header for all pages-->


<!-- Bootstrap CSS-->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<?php if (!isset($page_title)) { $page_title = 'We Do Secure'; } ?>

<!doctype html>
<html lang="en">
 <head>
 	<title>WDS - <?php echo $page_title; ?></title>

 	<meta charset="utf-8">
 </head>
 <body>
	<?php include_once('nav_guest.php')?>

	<div class="container-fluid bg-dark text-center">
	  <h1><a class="nav-link text-white" href="index.php">WDS</a></h1>
	</div>