<?php  
	require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/header.php';
?>

			<div class="fix wrap content_wrapper" id="content_wrapper">
				<div class="fix content">
					<?php
						$id_Cat = $_GET['id'];
						$queryCat = "SELECT * FROM cat_list WHERE id = '$id_Cat'";
						$resultCat = $mysqli -> query($queryCat);
						$arCat = mysqli_fetch_assoc($resultCat);
						$parent_id = $arCat['parent_id'];
						if ($parent_id != 0) {
							$queryCatParent = "SELECT name FROM cat_list WHERE id = '$parent_id'";
							$resultCatParent = $mysqli -> query($queryCatParent);
							$arCatParent = mysqli_fetch_assoc($resultCatParent);
							$parentName = $arCatParent['name'];
						}

                        //tong so tin
                        $queryTST = "SELECT COUNT(*) AS soluong FROM news WHERE cat_id = '$id_Cat' ";
                        $resultTST = $mysqli -> query($queryTST);
                        $arTmp = mysqli_fetch_assoc($resultTST);
                        $tongSoTruyen = $arTmp['soluong'];
                        //so tin tren 1 trang
                        $row_count = ROW_COUNT;
                        //tong so trang 
                        $tongSoTrang = ceil($tongSoTruyen/$row_count);
                        //trang hien tai
                        $current_page = 1;
                        if (isset($_GET['page'])) {
                            $current_page = $_GET['page'];
                        }
                        //offset
                        $offset = ($current_page - 1)*$row_count;
                    ?>
					<div class="fix main_content floatleft">
						<h2 id="menu"><?php if (isset($parentName)) { echo $parentName.' >> '; } ?><?php echo $arCat['name']; ?></h2>
						<div class="fix single_content_wrapper">
						<?php  
							$queryNews = "SELECT news.*,user.username AS user,cat_list.name AS catName FROM news LEFT JOIN user ON news.created_by = user.id INNER JOIN cat_list ON news.cat_id = cat_list.id WHERE news.active = '1' AND news.cat_id = '$id_Cat'  ORDER BY id DESC  LIMIT {$offset},{$row_count}";
							$resultNews = $mysqli -> query($queryNews);
							while ($arNews = mysqli_fetch_assoc($resultNews)) {
								$id_news = $arNews['id'];
								$name = $arNews['name'];
								$username = $arNews['user'];
								$catName = $arNews['catName'];
								$preview = $arNews['preview'];
								$date_creat = $arNews['date_creat'];
								$picture = $arNews['picture'];
								$view = $arNews['view'];
								$urlSeo = '/chi-tiet/'.utf8ToLatin($name).'-'.$id_news.'.html';
							
						?>
						<script type="text/javascript">
							document.title = '<?php echo $catName; ?> | Share IT';
						</script>
						<div class="fix single_content floatleft">
							
							<div class="fix single_content_info">
								<a href="<?php echo $urlSeo; ?>"><img src="/files/images/<?php echo $picture; ?>" alt=""/></a>
								<h1><a href="<?php echo $urlSeo; ?>" style="color: #525252;"><?php echo $name; ?></a></h1>
								<p class="author">By <span style="color: green;font-weight: bold;"><?php echo $username; ?></span>  |  <?php echo $catName; ?></p>
								<p><?php echo $preview ?></p>
								<div class="fix post-meta">
									<p><?php echo $date_creat; ?>  |  <i style="color: #FC8010;"><?php echo $view; ?></i> Views</p>
								</div>
							</div>	
						</div>
						<?php  
							}
						?>
						
						</div>

						<div class="pagination fix">
	                        <?php  
	                            for ($i=1; $i <= $tongSoTrang; $i++) { 
	                            	$urlSeoPage = '/danh-muc/'.utf8ToLatin($arCat['name']).'-'.$id_Cat.'/page-'.$i.'.html'; 
	                                if ($current_page == $i) {
	                        ?>
	                                    <a href="#" id="activePage"><?php echo "$i"; ?></a>
	                            <?php  
	                                } else {
	                            ?>
	                        <a href="<?php echo $urlSeoPage; ?>"><?php echo "$i"; ?></a>
	                        <?php  
	                                }
	                            }
	                        ?>
                    	</div>
                                
					</div>

<?php  
	require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/right_bar.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/footer.php';
?>
		