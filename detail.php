<?php  
	require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/header.php';
?>

			<div class="fix wrap content_wrapper" id="content_wrapper">
				<div class="fix content">
					<div class="fix main_content floatleft">
						<div class="single_page_content fix">
							<?php  
								$id = $_GET['id'];

								$queryNews = "SELECT * FROM news WHERE id = '$id' ";
								$resultNews = $mysqli -> query($queryNews);
								if ($arNews = mysqli_fetch_assoc($resultNews)) {
                                    $id_news = $arNews['id'];
									$cat_id = $arNews['cat_id'];
									$name = $arNews['name'];
                                    $created_by = $arNews['created_by'];
									$detail = $arNews['detail'];
									$date_creat = $arNews['date_creat'];
									$view = $arNews['view'];
									$picture = $arNews['picture'];

								}

                                $view_text = $view+1;
                                $queryAddView = "UPDATE news SET view = '$view_text' WHERE id = '$id' ";
                                $resulAddView = $mysqli -> query($queryAddView);
							?>
                            <script type="text/javascript">
                                document.title = '<?php echo $name; ?>';
                            </script>
							<h1><?php echo $name; ?></h1>
							<div class="single_post_meta fix">
								<p><?php echo $date_creat; ?>  |  <?php echo $view; ?> Views</p>
							</div>
							<img src="/files/images/<?php echo $picture; ?>" class="single_feature_img" alt=""/>
							<p><?php echo $detail; ?></p>
							
							<br/>
							
							<br/>
							
							<blockquote>Tin được đăng bởi <i>Admin</i></blockquote>
							
							

							<div class="response show-cmt" style="margin-left:10%;overflow: auto;height:400px !important  ">
                            <h4>Bình luận</h4>
                            
                            <?php  
                                $queryComment = "SELECT comment.*,user.username AS username FROM comment INNER JOIN user ON comment.user_id = user.id WHERE news_id = '$id' AND parent_id = '0' AND comment.active = '1' ";
                                $resultComment = $mysqli -> query($queryComment);
                                while ($arComment = mysqli_fetch_assoc($resultComment)) {
                                    $id_comment = $arComment['id'];
                                    $id_news = $arComment['news_id'];
                                    $content = $arComment['content'];
                                    $username = $arComment['username'];
                                    $date_create = $arComment['date_create'];
                                
                            ?>
                            <div class="media response-info ">
                                <div class="media-left response-text-left">
                                    <a href="http://shareit.vinaenter.edu.vn/10-dieu-khong-duoc-lam-trong-php-7-74.html#">
                                        <img class="media-object" src="/templates/public/images/icon1.png" style="width: 60px !important" alt="">
                                    </a>
                                    <h5><a href="http://shareit.vinaenter.edu.vn/10-dieu-khong-duoc-lam-trong-php-7-74.html#"><?php echo $username; ?></a></h5>
                                </div>
                                <div class="media-body response-text-right">
                                    <p><?php echo $content; ?></p>
                                    <ul>
                                        <li><?php echo $date_create; ?></li>
                                        <li><a href="javascript:void(0)" style="color:#1ABC9C;font-weight: bold; " class="reply-25" onclick="pshow(<?php echo $id_news; ?>,<?php echo $id_comment; ?>)">Trả lời</a></li>
                                    </ul>
                                    <div class="media response-info p-show" style="padding-left: : 10px;">
                                        <div id="show-<?php echo $id_comment; ?>"></div>
                                    </div>
                                    <?php  
                                        $queryCommentSub = "SELECT comment.*,user.username AS username FROM comment LEFT JOIN user ON comment.user_id = user.id  WHERE parent_id = '$id_comment' AND comment.active = '1' ";
                                        $resultCommentSub = $mysqli -> query($queryCommentSub);
                                        while ($arCommentSub = mysqli_fetch_assoc($resultCommentSub)) {
                                            $usernameSub = $arCommentSub['username'];
                                            $contentSub = $arCommentSub['content'];
                                            $date_create_sub = $arCommentSub['date_create'];
                                        
                                    ?>
                                    <div class="media response-info" style="margin-top: 10px;">
                                        <div class="media-left response-text-left">
                                            <a href="http://shareit.vinaenter.edu.vn/10-dieu-khong-duoc-lam-trong-php-7-74.html#">
                                                <img style="width: 50px !important" class="media-object" src="/templates/public/images/icon1.png" alt="">
                                            </a>
                                            <h5><a href="http://shareit.vinaenter.edu.vn/10-dieu-khong-duoc-lam-trong-php-7-74.html#"><?php echo $usernameSub ?></a></h5>
                                        </div>
                                        <div class="media-body response-text-right">
                                            <p><?php echo $contentSub; ?></p>
                                            <ul>
                                                <li><?php echo $date_create_sub; ?></li>

                                            </ul>
                                        </div>
                                        <div class="clearfix"> </div>
                                    </div>
                                    <?php  
                                        }
                                    ?>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <?php  
                                }
                            ?>
                        </div>
                        <script type="text/javascript">
                            function pshow(id,bid){
                                 $.ajax({
                                    url: "/templates/public/ajax/showReply.php", 
                                    type: 'POST',
                                    dataType: 'html',
                                    data: {
                                        id:id,
                                        bid:bid,
                                       _token: '4dPywYttKmAcfAGLdNitYRTaoVUCPEx0cfu52JLx',
                                    },
                                   success: function(data){
                                        $('#show-'+bid).html(data);
                                        $('.reply-'+bid).html('');
                                        
                                    },
                                    error: function (){
                                        alert('Có lỗi xảy ra');
                                    }
                                });
                            }
                        </script>
                        <div class="coment-form" style="margin-left:10% ">
                            <h4>Tham gia bình luận</h4>
                            <?php 
                                if (isset($_POST['submit'])) {
                                    $email = $_POST['email'];
                                    $content = $_POST['messages'];

                                    $query = "SELECT * FROM user WHERE email = '$email' ";
                                    $result = $mysqli -> query($query);
                                    if ($arUser = mysqli_fetch_assoc($result)) {
                                        $user_id = $arUser['id'];
                                        $username = $arUser['username'];
                                    }

                                    $queryAddComment = "INSERT INTO comment(id,content,user_id,news_id,name,email) VALUES('','$content','$user_id','$id','$username','$email')";
                                    $resultAddComment = $mysqli -> query($queryAddComment);
                                    if ($resultAddComment) {
                                        echo "<script>alert('Thêm bình luận thành công!Quản trị viên đang xem xét bình luận của bạn!');</script>";
                                    } else {
                                        echo "<script>alert('Thêm không thành công!');</script>";
                                    }
                                }
                            ?>
                            <form action=""  method="POST" id="frmAdd">
                                <input type="hidden" name="_token" value="H8zCG1qX8I1H5LpSIQXZNuREvcyZHGDoRNTYkDYt">
                                <input type="email" name="email" required="" id="email" value="" placeholder="Nhập email">
                                <textarea type="text" name="messages" required="" id="messages" placeholder="Nhập bình luận" value=""></textarea>
                                <input type="submit" value="Gửi" name="submit">
                            </form>
                            <script type="text/javascript">
                                        $(document).ready(function () {
                                            $('#frmAdd').validate({
                                                rules: {
                                                    "messages": {
                                                        required: true,
                                                    },
                                                    "email": {
                                                        required: true,
                                                        email: true,
                                                    },
                                                },
                                                messages: {
                                                  "messages": {
                                                    required: "Vui lòng nhập bình luận!",
                                                  },
                                                  "email": {
                                                    required: "Vui lòng nhập email!",
                                                    email: "Vui lòng nhập đúng định dạng Email!",
                                                  },
                                                },
                                            });
                                        }); 
                                    </script>
                        </div>

							
							<div class="related_post fix">
								<h2>Tin cùng danh mục</h2>
								<div class="fix related_post_container">
									<?php  
										$queryNewsCat = "SELECT * FROM news WHERE id != '$id' AND cat_id = '$cat_id' ORDER BY id DESC LIMIT 0,3";
										$resultNewsCat = $mysqli -> query($queryNewsCat);
										while ($arNews = mysqli_fetch_assoc($resultNewsCat)) {
											$id_news = $arNews['id'];
											$name = $arNews['name'];
											$detail = $arNews['detail'];
											$date_creat = $arNews['date_creat'];
											$view = $arNews['view'];
											$picture = $arNews['picture'];
                                            $urlSeo = '/chi-tiet/'.utf8ToLatin($name).'-'.$id_news.'.html';

									?>
									<div class="fix single_related_post floatleft">
										<a href="<?php echo $urlSeo; ?>"><img src="/files/images/<?php echo $picture; ?>" style="height: 120px;"/></a>
										<a href="<?php echo $urlSeo; ?>"><h2><?php echo $name; ?></h2></a>
										<p><?php echo $date_creat; ?> | <i style="color: #FC8010;font-weight: bold;"><?php echo $view ?></i> Views</p>
									</div>
									<?php  
										}
									?>
								</div>
							</div>
						</div>
						

					</div>
					
<?php  
	require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/right_bar.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/footer.php';
?>