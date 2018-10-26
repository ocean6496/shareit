<?php 
	session_start();
	ob_start(); 

	if (isset($_SESSION['userInfo'])) {
		unset($_SESSION['userInfo']);

		header('location:/admin/auth/login.php');
	}

	ob_end_flush();
?>