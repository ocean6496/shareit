<?php 
	if (!isset($_SESSION['userInfo'])) {
		header('location:/admin/auth/login.php');
	}
?>