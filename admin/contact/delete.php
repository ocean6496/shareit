<?php
	ob_start();  
	require_once $_SERVER['DOCUMENT_ROOT'].'/functions/DBConnectionUtil.php';

	$id_contact = $_GET['id'];

	$queryDelContact = "DELETE FROM contact WHERE id = '{$id_contact}' ";
	$resultDelContact = $mysqli -> query($queryDelContact);
	if ($resultDelContact) {
		header('location:/admin/contact/index.php?msg=Xóa thành công!');
	} else {
		header('location:/admin/contact/index.php?msg=Xóa không thành công!');
	}

	ob_end_flush();
?>