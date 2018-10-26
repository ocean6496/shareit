<?php  
    require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php';
?>

<script type="text/javascript">
    document.title = 'ShareIT | Add User';
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
                          Thêm người dùng
                        </div>
                        <div class="panel-body">
                            <?php  
                                if (isset($_POST['submit'])) {
                                    $username = $_POST['username'];
                                    $password = md5($_POST['password']);
                                    $fullname = $_POST['fullname'];
                                    $email = $_POST['email'];
                                    $role = $_POST['role'];

                                    $queryUser = "SELECT COUNT(*) AS soluong FROM user WHERE username = '$username' ";
                                    $resultUser = $mysqli -> query($queryUser);
                                    $arUser = mysqli_fetch_assoc($resultUser);
                                    if ($arUser['soluong'] == 0) {
                                        $queryAddUser = "INSERT INTO user(id,username,password,fullname,email,active) VALUES('','{$username}','{$password}','{$fullname}','{$email}','{$role}')";
                                        $resultAddUser = $mysqli -> query($queryAddUser);
                                        if ($resultAddUser) {
                                            header('location:/admin/user/index.php?msg=Thêm thành công!');
                                        } else {
                                            header('location:/admin/user/index.php?msg=Thêm không thành công!');
                                        }
                                    } else {
                                         header('location:/admin/user/index.php?msg=Tài khoản người dùng đã tồn tại.Thêm tài khoản khác!');
                                    }

                                }
                            ?>
                            <form role="form" action="" method="POST" id="frmAdd">
                                    <div class="form-group">
                                        <label>Tài khoản</label>
                                        <input class="form-control" type="text" name="username" value="">
                                    </div>
                                     <div class="form-group">
                                        <label>Mật khẩu</label>
                                        <input class="form-control" type="password" name="password" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Họ và tên</label>
                                        <input class="form-control" type="text" name="fullname" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" type="email" name="email" value="">
                                    </div>
                                     <div class="form-group">
                                        <label>Chức vụ</label>
                                        <select class="form-control" name="role">
                                            <option value="0">User</option>
                                            <option value="1">Admin</option>
                                        </select>
                                    </div>
                                    <input type="submit" name="submit" value="Thêm" class="btn btn-info">
                                </form>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        jQuery.validator.addMethod("noSpace", function(value, element) { 
                                          return value.indexOf(" ") < 0 && value != ""; 
                                        }, "Vui lòng không để khoảng trống!");
                                        $('#frmAdd').validate({
                                            rules: {
                                                "username": {
                                                    required: true,
                                                    noSpace:true,
                                                },
                                                "password": {
                                                    required: true,
                                                },
                                                "fullname": {
                                                    required: true,
                                                },
                                                "email": {
                                                    required: true,
                                                    email: true,
                                                },
                                            },
                                            messages: {
                                              "username": {
                                                required: "Vui lòng nhập tên người dùng!",
                                              },
                                              "password": {
                                                required: "Vui lòng nhập mật khẩu!",
                                              },
                                              "fullname": {
                                                required: "Vui lòng nhập họ tên!",
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
            </div>
                <!-- /. ROW  -->
           
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
	 
   
<?php  
    require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php';
?>