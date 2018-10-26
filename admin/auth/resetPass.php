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
    <title>Đặt lại mật khẩu</title>
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
    <div id="container-fix" style="width: 500px;margin: 90px auto;">
        <h1>Đặt lại mật khẩu</h1>
        <?php  
          if (isset($_POST['submit'])) {
            $email = $_GET['email'];
            $newspass = md5($_POST['newspass']);
            $passConfirm = md5($_POST['passConfirm']);

            $query = "UPDATE user SET password = '$newspass' WHERE email = '{$email}' ";
            $result = $mysqli -> query($query);

            if ($result) {
                header('location:/admin/auth/login.php');
            } else {
                header('location:/admin/auth/login.php?msg=Username or Password is not correct!');
            }
          }
        ?>
        <form action="" method="POST" id="frmReset">
            <input type="password" name="newspass" id="newspass" placeholder="Mật khẩu mới">
            <input type="password" name="passConfirm" placeholder="Nhập lại mật khẩu">
            <input type="submit" name="submit" value="Hoàn tất" id="login">
        </form>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#frmReset').validate({
                    rules: {
                        "newspass": {
                            required: true,
                        },
                        "passConfirm": {
                            required: true,
                            equalTo: '#newspass',
                        },
                    },
                    messages: {
                      "newspass": {
                        required: "Vui lòng nhập mật khẩu mới!",
                      },
                      "passConfirm": {
                        required: "Vui lòng nhập lại mật khẩu!",
                        equalTo: "Mật khẩu không khớp!",
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
            color: #921407;
            margin-left: 15px;
            font-weight: bold;
        }
    </style>
</body>

</html>
<?php  
    ob_end_flush();
?>