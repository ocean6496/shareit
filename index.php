<?php  
	require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/header.php';
?>

			<div class="fix wrap content_wrapper" id="content_wrapper">
				<div class="fix content">
					<?php  
                        //tong so tin
                        $queryTST = "SELECT COUNT(*) AS soluong FROM news WHERE active = '1' ";
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
						<h2 id="menu">Trang chủ</h2>
						<div class="fix single_content_wrapper">
						<?php  
							$queryNews = "SELECT news.*,user.username AS user,cat_list.name AS catName FROM news LEFT JOIN user ON news.created_by = user.id INNER JOIN cat_list ON news.cat_id = cat_list.id WHERE news.active = '1' ORDER BY id DESC  LIMIT {$offset},{$row_count}";
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
								$urlSeo = '/chi-tiet/'.utf8ToLatin($name).'-'.$id_news.'.html';
							
						?>
						<div class="fix single_content floatleft">
							
							<div class="fix single_content_info">
								<a href="<?php echo $urlSeo; ?>"><img src="/files/images/<?php echo $picture; ?>" alt=""/></a>
								<h1><a href="<?php echo $urlSeo; ?>" style="color: #525252;"><?php echo $name; ?></a></h1>
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
						
						<!-- <div class="pagination fix">
							<a href="">1</a>
							<a href="">1</a>
							<a href="">1</a>
							<a href="">1</a>
							<a href="">1</a>
							<a href="">1</a>
						</div> -->
						<div class="pagination fix">
							<?php  
                                if ($current_page == 1) {
                            ?>        
                                    <a href="javascript:void(0)">«</a>
                                <?php    
                                    } 
                                    else {
                                ?>
                                    <a href="index.php?page=<?php echo $current_page-1; ?>" rel="previous">«</a>
                            <?php
                                }
                            ?>

	                        <?php  
	                            for ($i=1; $i <= 5; $i++) { 
	                                if ($current_page == $i) {
	                        ?>
	                                    <a href="javascript:void(0)" id="activePage"><?php echo "$i"; ?></a>
	                            <?php  
	                                } else {
	                            ?>
	                        <a href="index.php?page=<?php echo $i; ?>"><?php echo "$i"; ?></a>
	                        <?php  
	                                }
	                            }
	                        ?>
	                        
	                        <?php  
                                if ($current_page == $tongSoTrang) {
                            ?>        
                                    <a href="javascript:void(0)">»</a>
                                <?php    
                                    } 
                                    else {
                                ?>
                                    <a href="index.php?page=<?php echo $current_page+1; ?>" rel="next">Trang tiếp...</a>
                            <?php
                                }
                            ?>
                    	</div>
                                
					</div>

<?php  
	include $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/right_bar.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/footer.php';
?>
		