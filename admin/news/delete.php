<?php 
	ob_start(); 
	require_once $_SERVER['DOCUMENT_ROOT'].'/functions/DBConnectionUtil.php';
	$id_news = $_GET['id'];

	$queryNews = "SELECT picture FROM news WHERE id = '$id_news' ";
	$resultNews = $mysqli -> query($queryNews);
	if ($row = mysqli_fetch_assoc($resultNews)) {
		$picture = $row['picture'];
	}
	if ($picture != '') {
		$file_path = $_SERVER['DOCUMENT_ROOT'].'/files/images/'.$picture;
		unlink($file_path);
	}

	$queryDelNews = "DELETE FROM news WHERE id = '{$id_news}'";
	$resultDelNews = $mysqli -> query($queryDelNews);
	if ($resultDelNews) {
		header('location:/admin/news/index.php?msg=Xóa thành công!');
	} else {
		header('location:/admin/news/index.php?msg=Xóa không thành công!');
	}

	ob_end_flush();
?>