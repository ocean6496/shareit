<?php  
    require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php';
?>

<script type="text/javascript">
    document.title = 'ShareIT | Contact';
</script>
<div class="content-wrapper">
    <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Quản lý liên hệ</h4>
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
                        Danh sách liên hệ
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th width="20%">Họ tên</th>
                                        <th width="25%">Email</th>
                                        <th width="25%">Website</th>
                                        <th width="10%">Nội dung</th>
                                        <th width="15%">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
                                        $queryContact = "SELECT * FROM contact ORDER BY id DESC";
                                        $resultContact = $mysqli -> query($queryContact);
                                        while ($arContact  = mysqli_fetch_assoc($resultContact)) {
                                            $id = $arContact['id'];
                                            $name = $arContact['name'];
                                            $email = $arContact['email'];
                                            $website = $arContact['website'];
                                            $content = $arContact['content'];
                                        
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $id ?></td>
                                        <td><?php echo $name ?></td>
                                        <td><?php echo $email ?></td>
                                        <td><?php echo $website ?></td>
                                        <td><?php echo $content ?></td>
                                        <td align="center">
                                            <a href="/admin/contact/delete.php?id=<?php echo $id; ?>" onclick="return confirm(&#39;Bạn có chắc chắn muốn xóa&#39;)" class="btn btn-danger">Xóa</a>
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