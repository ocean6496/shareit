<?php
	ob_start();  
	require_once $_SERVER['DOCUMENT_ROOT'].'/functions/DBConnectionUtil.php';

	$id_user = $_GET['id'];

	$queryDelUser = "DELETE FROM user WHERE id = '{$id_user}' ";
	$resultDelUser = $mysqli -> query($queryDelUser);
	if ($resultDelUser) {
		header('location:/admin/user/index.php?msg=Xóa thành công!');
	} else {
		header('location:/admin/user/index.php?msg=Xóa không thành công!');
	}

	ob_end_flush();
?>