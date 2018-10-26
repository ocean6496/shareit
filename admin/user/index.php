<?php  
    require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php';
?>

<script type="text/javascript">
    document.title = 'ShareIT | User';
</script>
<div class="content-wrapper">
    <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Quản lý người dùng</h4>
                <a href="/admin/user/add.php" class="btn btn-success">Thêm</a>
                <?php  
                    if (isset($_GET['msg'])) {
                        echo "<h4 style = 'color:red;padding-top:10px;'>{$_GET['msg']}</h4>";
                    }
                ?>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Danh sách người dùng
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th width="20%">Tài khoản</th>
                                        <th width="25%">Họ tên</th>
                                        <th width="25%">Email</th>
                                        <th width="10%">Chức vụ</th>
                                        <th width="15%">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
                                        $queryUser = "SELECT * FROM user ORDER BY id DESC";
                                        $resultUser = $mysqli -> query($queryUser);
                                        while ($arUser  = mysqli_fetch_assoc($resultUser)) {
                                            $id_user = $arUser['id'];
                                            $username = $arUser['username'];
                                            $fullname = $arUser['fullname'];
                                            $email = $arUser['email'];
                                            $active = $arUser['active'];
                                        
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $id_user ?></td>
                                        <td><?php echo $username ?></td>
                                        <td><?php echo $fullname ?></td>
                                        <td><?php echo $email ?></td>
                                        <td><?php if ($active == 1) {
                                            echo 'admin';
                                        } else {
                                            echo 'user';
                                        } ?>   
                                        </td>
                                        <td align="center">
                                            <?php  
                                                if ($username != 'admin' || $_SESSION['userInfo']['username'] == 'admin') {
                                            ?>
                                            <a href="/admin/user/edit.php?id=<?php echo $id_user; ?>" class="btn btn-primary">Sửa</a>
                                            <?php  
                                                }
                                            ?>
                                            <?php  
                                                if ($username != 'admin') {
                                            ?>
                                            <a href="/admin/user/delete.php?id=<?php echo $id_user; ?>" onclick="return confirm(&#39;Bạn có chắc chắn muốn xóa&#39;)" class="btn btn-danger">Xóa</a>
                                            <?php  
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php  
                                        }
                                    ?>
                                    
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>
        <!-- /. ROW  -->

    </div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->

<?php  
    require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php';
?>