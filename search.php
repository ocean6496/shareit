
<?php 
	$nameSearch = $_POST['aname']; 
	require_once $_SERVER['DOCUMENT_ROOT'].'/functions/DBConnectionUtil.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/functions/ConstantUtil.php';
?>
<div class="fix content">
					
					<div class="fix main_content floatleft">
						<?php  
							$queryCount = "SELECT COUNT(*) AS soLuong FROM news WHERE name LIKE '%{$nameSearch}%' ";
							$resultCount = $mysqli -> query($queryCount);
							$arCount = mysqli_fetch_assoc($resultCount);
						?>
						<h2 id="menu">Có <?php echo $arCount['soLuong']; ?> kết quả tìm kiếm với từ khóa:<i style="color: black;"><?php echo $nameSearch; ?></i></h2>
						<div class="fix single_content_wrapper">
						<?php  
							$queryNews = "SELECT news.*,user.username AS user,cat_list.name AS catName FROM news LEFT JOIN user ON news.created_by = user.id INNER JOIN cat_list ON news.cat_id = cat_list.id WHERE news.active = '1' AND news.name LIKE '%{$nameSearch}%' ORDER BY id DESC ";
							$resultNews = $mysqli -> query($queryNews);
							while ($arNews = mysqli_fetch_assoc($resultNews)) {
								$id_news = $arNews['id'];
								$id_cat = $arNews['cat_id'];
								$name = $arNews['name'];
								$username = $arNews['user'];
								$catName = $arNews['catName'];
								$preview = $arNews['preview'];
								$date_creat = $arNews['date_creat'];
								$picture = $arNews['picture'];
								$view = $arNews['view'];
							
						?>
						<div class="fix single_content floatleft">
							
							<div class="fix single_content_info">
								<a href="/detail.php?id=<?php echo $id_news; ?>"><img src="/files/images/<?php echo $picture; ?>" alt=""/></a>
								<h1><a href="/detail.php?id=<?php echo $id_news; ?>" style="color: #525252;"><?php echo $name; ?></a></h1>
								<p class="author">By <span style="color: green;font-weight: bold;"><?php echo $username; ?></span>  |  <i style="font-weight: bold;color: red;"><?php echo $catName; ?></i></p>
								<p><?php echo $preview ?></p>
								<div class="fix post-meta">
									<p><?php echo $date_creat; ?>  |  <span style="color: #FC8010;"><?php echo $view; ?></span> Views</p>
								</div>
							</div>	
						</div>
						<?php  
							}
						?>
						</div>
						
                    </div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/right_bar.php'; ?>