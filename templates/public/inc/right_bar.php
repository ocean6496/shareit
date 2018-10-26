<?php  
	require_once $_SERVER['DOCUMENT_ROOT'].'/functions/DBConnectionUtil.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/functions/Utf8ToLatinUtil.php';
?>

<div class="fix sidebar floatright">
						<div class="fix single_sidebar">
							<div class="popular_post fix">
								<h2>Tin xem nhiều</h2>
								<?php  
									$queryNews = "SELECT * FROM news ORDER BY view DESC LIMIT 0,5";
									$resultNews = $mysqli -> query($queryNews);
									while ($arNews = mysqli_fetch_assoc($resultNews)) {
										$id_news = $arNews['id'];
										$name = $arNews['name'];
										$date_creat = $arNews['date_creat'];
										$picture = $arNews['picture'];
										$urlSeo = '/chi-tiet/'.utf8ToLatin($name).'-'.$id_news.'.html';
									
								?>
								<div class="fix single_popular">
									<a href="<?php echo $urlSeo; ?>"><img src="/files/images/<?php echo $picture; ?>" class="floatleft"/></a>
									<a href="<?php echo $urlSeo; ?>"><h2><?php echo $name; ?></h2></a>
									<p><i><?php echo $date_creat; ?></i></p>
								</div>
								<?php  
									}
								?>
							</div>
						</div>
						<div class="fix single_sidebar">
							<h2>Tìm kiếm</h2>
							<form action="javascript:void(0)" method="POST">
								
								<input class="search" type="text" id="search" placeholder="Nhập tin muốn tìm kiếm" style="margin-left: 9px; border-radius: 3px;" />
							</form>
						</div>
						<script type="text/javascript">
							$('#search').keypress(function(e) {
							    if(e.which == 13) {
							        getInfo();
							    }
							});

			                function getInfo() {
			                    var name = $('#search').val();
			                    $.ajax({
			                        url: '/search.php',
			                        type: 'POST',
			                        cache: false,
			                        data: {aname: name},
			                        success: function(data){
			                            $('#content_wrapper').html(data);
			                        },
			                        error: function (){
			                            alert('Có lỗi xảy ra');
			                        }
			                    });

			                    return false;
			                }
			            </script>
						<div class="fix single_sidebar">
							<div id="ok"></div>
							<h2>LIÊN KẾT VINAENTER</h2>
							<p>	
								<a href="https://vinaenter.edu.vn/lap-trinh-php-tu-a-z.html" target="_blank"><img src="/templates/public/images/php.png"></a>
								<a href="https://vinaenter.edu.vn/lap-trinh-java-tu-a-z.html" target="_blank"><img src="/templates/public/images/ltjava.jpg"></a>
							</p>
						</div>
					</div>
				</div>	
			</div>