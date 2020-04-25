<?php


	// Define variables for common directory
	define("PRIVATE_PATH",dirname(__FILE__));
	define("PROJECT_PATH",dirname(PRIVATE_PATH));
	define("PUBLIC_PATH",PROJECT_PATH. 'public');
	define("SHARED_PATH", PRIVATE_PATH. '/shared');

	session_start();

	
	require_once('function.php');
?>