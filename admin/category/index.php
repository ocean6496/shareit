<?php  
    require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php';
?>

<script type="text/javascript">
    document.title = 'ShareIT | Category';
</script>
<div class="content-wrapper">
    <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Quản lý danh mục</h4>

                <a href="/admin/category/add.php" class="btn btn-success">Thêm</a>
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
                        Danh sách danh mục tin
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="20%">ID Danh mục</th>
                                        <th width="50%">Tên Danh mục</th>
                                        <th width="30%">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
                                        $queryCat = "SELECT * FROM cat_list WHERE parent_id = '0' ORDER BY id DESC";
                                        $resultCat = $mysqli -> query($queryCat);
                                        while ( $arCat = mysqli_fetch_assoc($resultCat)) {
                                            $id_cat = $arCat['id'];
                                            $name = $arCat['name'];
                                            
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $id_cat ?></td>
                                        <td>
                                            <?php echo $name ?>
                                            <ul style="list-style:none">
                                                <?php  
                                                    $query = "SELECT * FROM cat_list WHERE  parent_id = '$id_cat' ORDER BY id DESC";
                                                    $result = $mysqli ->query($query);
                                                    while ($ar = mysqli_fetch_assoc($result)) {
                                                        $id_cat_con = $ar['id'];
                                                        $nameCon = $ar['name'];
                                                    
                                                ?>
                                                <li>
                                                    <?php echo $nameCon; ?>
                                                    <a href="/admin/category/delete.php?id=<?php echo $id_cat_con; ?>" onclick="return confirm(&#39;Bạn có chắc chắn muốn xóa&#39;)" class="fa fa-trash-o"></a>
                                                    <a href="#" data-toggle="modal" data-target="#<?php echo $id_cat_con; ?>" class="fa fa-pencil"></a>
                                                    <div class="modal fade" id="<?php echo $id_cat_con; ?>" role="dialog">
                                                        <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                                                    <h4 class="modal-title">SỬA DANH MỤC TIN</h4>
                                                                </div>
                                                                <?php  
                                                                    if (isset($_POST['submit'])) {
                                                                        $nameCat = $_POST['nameCat'];
                                                                        $catParent = $_POST['catParent'];
                                                                        $id = $_GET['id'];

                                                                        $queryEditCat = "UPDATE cat_list SET name = '{$nameCat}',parent_id = '{$catParent}' WHERE id = '{$id}' ";
                                                                        $resultEditCat = $mysqli -> query($queryEditCat);
                                                                        if ($resultEditCat) {
                                                                            header('location:/admin/category/index.php?msg=Sửa thành công!');
                                                                        } else {
                                                                            header('location:/admin/category/index.php?msg=Sửa không thành công!');
                                                                        }
                                                                    }
                                                                ?>
                                                                <form action="index.php?id=<?php echo $id_cat_con ?>" method="POST">
                                                                    <input type="hidden" name="_token" value="GzOgAeAQ2aVpA37WbIjUaJY0HAc9xtnSgznogsOh">
                                                                    <div class="modal-body">

                                                                        <div class="form-group">
                                                                            <label>Tên danh mục</label>
                                                                            <input class="form-control" type="text" name="nameCat" value="<?php echo $nameCon; ?>">

                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Danh mục cha</label>
                                                                            <select class="form-control" name="catParent">
                                                                                <?php  
                                                                                    $queryParent = "SELECT * FROM cat_list WHERE parent_id = '0' ORDER BY id DESC ";
                                                                                    $resulParent = $mysqli ->query($queryParent);
                                                                                    while ($arCatParent = mysqli_fetch_assoc($resulParent)) {
                                                                                        $id_nameParent = $arCatParent['id'];
                                                                                        $nameParent = $arCatParent['name'];
                                                                                    
                                                                                ?>                      
                                                                                <option value="<?php echo $id_nameParent; ?>"><?php echo $nameParent; ?></option>
                                                                                <?php  
                                                                                    }
                                                                                ?> 
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input class="btn btn-info" type="submit" name="submit" value="Lưu">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php  
                                                    }
                                                ?>
                                            </ul>
                                        </td>
                                        <td align="center">
                                            <a href="/admin/category/edit.php?id=<?php echo $id_cat; ?>" class="btn btn-primary">Sửa</a>
                                            <a href="/admin/category/delete.php?id=<?php echo $id_cat; ?>" onclick="return confirm(&#39;Bạn có chắc chắn muốn xóa&#39;)" class="btn btn-danger">Xóa</a>
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