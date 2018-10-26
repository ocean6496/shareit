<?php 
	ob_start(); 
	require_once $_SERVER['DOCUMENT_ROOT'].'/functions/DBConnectionUtil.php';
	$id_cat = $_GET['id'];

	$queryDelCat = "DELETE FROM cat_list WHERE id = '{$id_cat}'";
	$resultDelCat = $mysqli -> query($queryDelCat);
	if ($resultDelCat) {
		header('location:/admin/category/index.php?msg=Xóa thành công!');
	} else {
		header('location:/admin/category/index.php?msg=Xóa không thành công!');
	}

	ob_end_flush();
?>