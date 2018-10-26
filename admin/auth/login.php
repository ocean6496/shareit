<?php  
    ob_start();
    session_start();
?>
<?php  
    ob_start();
    require_once $_SERVER['DOCUMENT_ROOT'].'/functions/DBConnectionUtil.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <link rel="SHORTCUT ICON" href="https://shareit.vinaenter.edu.vn/public/templates/admin/img/icon.png">
    <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Hind:300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/templates/admin/css/styleLogin.css">

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="/libraries/jquery.validate.min.js"></script>
</head>

<body>
    <div style="text-align: center;margin-top: 125px;">
        <?php  
            if (isset($_GET['msg'])) {
                echo "<h2 style='color:red';margin:30px auto;>{$_GET['msg']}</h2>";
            }
        ?>
    </div>
    <div id="login-button">
        <img src="https://dqcgrsy5v35b9.cloudfront.net/cruiseplanner/assets/img/icons/login-w-icon.png">
        </img>
    </div>
    <div id="container">
        <h1>Đăng nhập</h1>
        <span class="close-btn">
    <img src="https://cdn4.iconfinder.com/data/icons/miu/22/circle_close_delete_-128.png"></img>
  </span>
        <?php  
          if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            $query = "SELECT * FROM user WHERE username = '$username' && password = '$password' ";
            $result = $mysqli -> query($query);
            $arUser = mysqli_fetch_assoc($result);

            if (count($arUser) != 0) {
              $_SESSION['userInfo'] = $arUser;
                if(!empty($_POST["remember"])) {
                    setcookie ("member_login",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
                    setcookie ("member_password",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
                } else {
                    if(isset($_COOKIE["member_login"])) {
                        setcookie ("member_login","");
                    }
                    if(isset($_COOKIE["member_password"])) {
                        setcookie ("member_password","");
                    }
                }
              header('location:/admin/index.php');
            } else {
                header('location:/admin/auth/login.php?msg=Username or Password is not correct!');
            }
          }
        ?>
        <form action="" method="POST" id="frmLogin">
            <input type="text" name="username" placeholder="Tài khoản" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>">
            <input type="password" name="password" placeholder="Mật khẩu" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>">
            <input type="submit" name="submit" value="Đăng nhập" id="login">
            <div id="remember-container">
                <input type="checkbox" id="remember" class="checkbox" name="remember"  />
                <span id="remember">Duy trì đăng nhập</span>
                <span id="forgotten">Quên mật khẩu</span>
            </div>
        </form>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#frmLogin').validate({
                    rules: {
                        "username": {
                            required: true,
                        },
                        "password": {
                            required: true,
                        },
                    },
                    messages: {
                      "username": {
                        required: "Vui lòng nhập tên người dùng!",
                      },
                      "password": {
                        required: "Vui lòng nhập mật khẩu!",
                      },
                    },
                });
            }); 
        </script>
    </div>

    <!-- Forgotten Password Container -->
    <div id="forgotten-container">
        <h1>Quên mật khẩu</h1>
        <span class="close-btn">
    <img src="https://cdn4.iconfinder.com/data/icons/miu/22/circle_close_delete_-128.png"></img>
  </span>
        <?php  
            if (isset($_POST['submitFG'])) {
                $email = $_POST['email'];

                $queryUser = "SELECT COUNT(*) AS soluong FROM user WHERE email = '$email' ";
                $resultUser = $mysqli -> query($queryUser);
                $ar = mysqli_fetch_assoc($resultUser);

                if ($ar['soluong'] != 0) {

                    require $_SERVER['DOCUMENT_ROOT'].'/libraries/mailer/PHPMailerAutoload.php';
                    require $_SERVER['DOCUMENT_ROOT'].'/libraries/mailer/class.phpmailer.php';
                    require $_SERVER['DOCUMENT_ROOT'].'/libraries/mailer/class.smtp.php';

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
                    $mail->Subject = "Get link to reset Password!";
                    $mail->Body = "http://shareit.com/admin/auth/resetPass.php?email={$email}";

                    ob_start();
                    try{
                        $mail->Send();
                        header('location:/admin/auth/login.php?msg=Đã gửi yêu cầu tới gmail của ban,vui lòng kiểm tra gmail để đặt lại mật khẩu!');
                    } catch(Exception $e){
                        //Something went bad
                        echo "Mailer Error: - " . $mail->ErrorInfo;
                    }

                } else {
                    // echo "<script>alert('ok');</script>";
                    header('location:/admin/auth/login.php?msg=Gmail của bạn chưa được đăng ký trong tài khoản Website!');
                }
            }
        ?>
        <form action="" method="POST" id="frmConfirm">
            <input type="email" name="email" placeholder="E-mail">
            <input type="submit" name="submitFG" class="orange-btn" value="Xác nhận">
        </form>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#frmConfirm').validate({
                    rules: {
                        "email": {
                            required: true,
                            email: true,
                        },
                    },
                    messages: {
                      "email": {
                        required: "Vui lòng nhập Email!",
                        email: "Nhập đúng định dạng email!",
                      },
                    },
                });
            }); 
        </script>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/TweenMax.min.js'></script>
    <script src="/templates/admin/js/index.js"></script>

    <style type="text/css">
        .error {
            color: #f99606;
            margin-left: 15px;
            font-weight: bold;
        }
    </style>
</body>

</html>
<?php  
    ob_end_flush();
?>