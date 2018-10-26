<?php  
    require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php';
?>

<script type="text/javascript">
    document.title = 'ShareIT | Edit User';
</script>
<div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Quản lý người dùng</h4>
            </div>

        </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="panel panel-info">
                        <div class="panel-heading">
                          Sửa người dùng
                        </div>
                        <div class="panel-body">
                            <?php  
                                $id_user = $_GET['id'];
                                $queryUser = "SELECT * FROM user WHERE id = '$id_user' ";
                                $resultUser = $mysqli -> query($queryUser);
                                if ($arUser = mysqli_fetch_assoc($resultUser)) {
                                    $username = $arUser['username'];
                                    $fullname = $arUser['fullname'];
                                    $email = $arUser['email'];
                                    $active = $arUser['active'];
                                }

                                if ($username == 'admin' && $_SESSION['userInfo']['username'] != 'admin') {
                                    header('location:/admin/user/index.php?msg=Bạn không có quyền sửa Administration!');
                                }

                                if (isset($_POST['submit'])) {
                                    $password = $_POST['password'];
                                    $fullname = $_POST['fullname'];
                                    $email = $_POST['email'];

                                    if ($password == '') {
                                        $queryEditUser = "UPDATE user SET fullname = '$fullname',email = '$email' WHERE id = '$id_user' ";
                                        $resultEditUser = $mysqli -> query($queryEditUser);

                                        if ($resultEditUser) {
                                            header('location:/admin/user/index.php?msg=Sửa thành công!');
                                        } else {
                                            header('location:/admin/user/index.php?msg=Sửa không thành công!');
                                        }
                                    } else {
                                        $password = md5($_POST['password']);

                                        $queryEditUser2 = "UPDATE user SET password = '$password', fullname = '$fullname', email = '$email' WHERE id = '$id_user' ";
                                        $resultEditUser2 = $mysqli -> query($queryEditUser2);

                                        if ($resultEditUser2) {
                                            header('location:/admin/user/index.php?msg=Sửa thành công!');
                                        } else {
                                            header('location:/admin/user/index.php?msg=Sửa không thành công!');
                                        }
                                    }
                                }
                            ?>
                            <form role="form" action="" method="POST">
                                <div class="form-group">
                                    <label>Tài khoản</label>
                                    <input readonly="" class="form-control" type="text" name="username" value="<?php echo $username; ?>">
                                </div>
                                 <div class="form-group">
                                    <label>Mật khẩu</label>
                                    <input class="form-control" type="password" name="password" value="">
                                </div>
                                <div class="form-group">
                                    <label>Họ và tên</label>
                                    <input class="form-control" type="text" name="fullname" value="<?php echo $fullname; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="email" name="email" value="<?php echo $email; ?>">
                                </div>
            					<div class="form-group">
                                    <label>Chức vụ</label>
                                    <select class="form-control" name="role">
                                        <?php if ($active == 1) { ?>
                                            <option value="1">Admin</option>
                                        <?php } else { ?>
                                            <option value="0">User</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <input type="submit" name="submit" value="Sửa" class="btn btn-info">
                            </form>
                            </div>
                        </div>
                            </div>
            </div>
                <!-- /. ROW  -->
           
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
	 
   
<?php  
    require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php';
?>