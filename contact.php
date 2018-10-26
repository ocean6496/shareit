<?php  
	require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/header.php';
?>
			<script type="text/javascript">
				document.title = 'Liên hệ | Share IT';
			</script>
			<div class="fix wrap content_wrapper" id="content_wrapper">
				<div class="fix content">
					<div class="fix main_content floatleft">
						<div class="single_page_content fix">
							<h1 style="margin-bottom:15px;">Liên hệ</h1>
							
							<div class="google_map">
								<div class="contact_info">
									<p>Nếu có thắc mắc hoặc góp ý, vui lòng liên hệ với chúng tôi theo thông tin dưới đây.</p>
								</div>
							</div>
							<h1 style="margin-bottom:15px;">Form liên hệ</h1>
								<div class="contact_form">
									<?php  
										if (isset($_POST['submit'])) {
											$name = $_POST['name'];
											$email = $_POST['email'];
											$website = $_POST['website'];
											$content = $_POST['content'];

											require "./libraries/mailer/PHPMailerAutoload.php";
											require "./libraries/mailer/class.phpmailer.php";
											require './libraries/mailer/class.smtp.php';

											$mail = new PHPMailer(true);

										    //Send mail using gmail
										    $mail->IsSMTP(); // telling the class to use SMTP
										    $mail->CharSet  = "utf-8";
										    $mail->SMTPAuth = true; // enable SMTP authentication
										    $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
										    $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
										    $mail->Port = 465; // set the SMTP port for the GMAIL server
										    $mail->Username = "ocean06041996@gmail.com"; // GMAIL username
										    $mail->Password = "duongpro99"; // GMAIL password

										    //Typical mail data
										    $mail->AddAddress('ocean06041996@gmail.com');
										    $mail->addReplyTo('nguyenhuudaiduong14t3@gmail.com', 'DaiDuong');
										    $mail->SetFrom($email,'ocean');
										    $mail->Subject = "$name-$website";
										    $mail->Body = "$content";

										    ob_start();
										    try{
										        $mail->Send();

										        $queryContact = "INSERT INTO contact( id, name, email, website, content) VALUES( '', '{$name}', '{$email}', '{$website}', '{$content}')";
												$resultContact = $mysqli -> query($queryContact);
												if ($resultContact == true) {
													$msg = "Gửi thành công!";
												} else {
													echo "<script>alert('Gửi không thành công!');</script>";
												}
										    } catch(Exception $e){
										        //Something went bad
										        echo "Mailer Error: - " . $mail->ErrorInfo;
										    }

										}
									?>
									<form action="" method="POST" id="frmAdd">
										<p>
											<label>Họ tên(*)</label><br />
											<input type="text" class="text" name="name" />
										</p>
										<p>
											<label>Email(*)</label><br />
											<input type="text" class="email" name="email" />
										</p>
										<p>
											<label>Website</label><br />
											<input type="text" class="text" name="website" />
										</p>
										<p>
											<label>Nội dung</label><br />
											<textarea class="textarea" name="content"></textarea>
										</p>
										<p><input type="submit" name="submit" class="submit" value="Gửi"/></p>
									</form>
									<h2 style="color: red;margin-top: 20px;">
										<?php  
											if (isset($msg)) {
												echo $msg;
											}
										?>
									</h2>
									<script type="text/javascript">
	                                    $(document).ready(function () {
	                                        $('#frmAdd').validate({
	                                            rules: {
	                                                "name": {
	                                                    required: true,
	                                                },
	                                                "email": {
	                                                    required: true,
	                                                    email: true,
	                                                },
	                                            },
	                                            messages: {
	                                              "name": {
	                                                required: "Vui lòng nhập tên người dùng!",
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

							
						</div>
					</div>
					

<?php  
	require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/right_bar.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/footer.php';
?>