<?php  
	require_once $_SERVER['DOCUMENT_ROOT'].'/functions/DBConnectionUtil.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/functions/ConstantUtil.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/functions/Utf8ToLatinUtil.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<!--
---- Clean html template by http://WpFreeware.com
---- This is the main file (index.html).
---- You are allowed to change anything you like. Find out more Awesome Templates @ wpfreeware.com

-->	

	<head>
		<title>Share IT</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Font Awesome -->
		<link rel="SHORTCUT ICON" href="https://shareit.vinaenter.edu.vn/public/templates/admin/img/icon.png">
		<link rel="stylesheet" href="/templates/public/css/font-awesome.min.css">
		<link rel="stylesheet" href="/templates/public/font/font.css">
		<link href="/templates/public/css/style.css" rel="stylesheet" media="screen">	
		<link href="/templates/public/css/responsive.css" rel="stylesheet" media="screen">	

		<script type="text/javascript" src="/libraries/jquery-3.3.1.min.js"></script>	
		<script type="text/javascript" src="/libraries/jquery.validate.min.js"></script>
		<!-- <script type="text/javascript" src="/templates/public/js/script.js"></script> -->
		<!-- <script type="text/javascript" src="/templates/public/js/coin-slider.min.js"></script> -->	
	</head>
	

	<body>
		<div class="fix header_area">
			<div class="fix wrap header">
				<div class="logo floatleft">
					<a href="https://vinaenter.edu.vn" target="_blank" style="float: left;"><img src="/templates/public/images/logo1.png"></a>
					<h1>SHARE IT</h1>
				</div>
				<div class="manu floatright">
					<ul id="nav-top">
						<li><a href="/">Trang chủ</a></li>
						<li><a href="/lien-he">Liên hệ</a></li>
						<li><a href="/admin/auth/login.php" target="_blank">Đăng nhập</a></li>
					</ul>
				</div>
			</div>
		</div>
		
		<!--Clean template by WpFreeware.com-->
		
		
		<div class="fix content_area">
				
				<div class="fix top_add_bar">
					<div class="addbar_leaderborard">
						<div class="slider">
							<div id="coin-slider">
								<a href="#"><img src="/templates/public/images/basari.jpg"  width="" height="" alt="" style="border-radius: 5px;" /></a>
								<!-- <a href="#"><img src="/templates/public/images/images.jpg"  width="" height="" alt=""/></a>
								<a href="#"><img src="/templates/public/images/Desert.jpg"  width="" height="" alt=""/></a> -->
								<!-- <img src="/templates/public/images/images.jpg" /> -->
								
							</div>
						</div>
					</div>
				</div>
				
				<div class="manu_area">
					<div class="mainmenu menu-wrap wrap">
						<ul id="nav-bottom">
							<?php  
								$queryCat = "SELECT * FROM cat_list WHERE parent_id = 0 ORDER BY id ASC";
								$resultCat = $mysqli -> query($queryCat);
								while ($arCat = mysqli_fetch_assoc($resultCat)) {
									$id_cat = $arCat['id'];
									$name = $arCat['name'];
									$parent_id = $arCat['parent_id'];
									$urlSeo = '/danh-muc/'.utf8ToLatin($name).'-'.$id_cat.'.html';
								
							?>
							<li><a href="<?php echo $urlSeo; ?>"><?php echo $name; ?></a>
								<ul>
									 <?php  
                                        $query = "SELECT * FROM cat_list WHERE  parent_id = '$id_cat' ORDER BY id DESC";
                                        $result = $mysqli ->query($query);
                                        while ($ar = mysqli_fetch_assoc($result)) {
                                            $id_cat_con = $ar['id'];
                                            $nameCon = $ar['name'];
                                        $urlSeo = '/danh-muc/'.utf8ToLatin($nameCon).'-'.$id_cat_con.'.html';
                                    ?>
									<li><a href="<?php echo $urlSeo; ?>"><?php echo $nameCon; ?></a></li>
									<?php  
										}
									?>
								</ul>
							</li>
							<?php  
								}
							?>
						</ul>
					</div>
				</div>