<?php  
    require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php';
?>

<script type="text/javascript">
    document.title = 'ShareIT | Edit Category';
</script>
<div class="content-wrapper">
    <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Quản lý danh mục</h4>

            </div>

        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Sửa danh mục
                    </div>
                    <div class="panel-body">
                        <?php 
                            $id = $_GET['id'];
                            $queryCat = "SELECT * FROM cat_list WHERE id = '$id' ";
                            $resultCat = $mysqli -> query($queryCat);
                            $arCat = mysqli_fetch_assoc($resultCat); 
                            if (isset($_POST['submit'])) {
                                $name_cat = $_POST['name'];

                                $queryEditCat = "UPDATE cat_list SET name = '{$name_cat}' WHERE id = '{$id}' ";
                                $resultEditCat = $mysqli -> query($queryEditCat);
                                if ($resultEditCat) {
                                    header('location:/admin/category/index.php?msg=Sửa thành công!');
                                } else {
                                    header('location:/admin/category/index.php?msg=Sửa không thành công!');
                                }
                            }
                        ?>
                        <form role="form" action="" method="POST">
                            <input type="hidden" name="_token" value="GzOgAeAQ2aVpA37WbIjUaJY0HAc9xtnSgznogsOh">
                            <div class="form-group">
                                <label>Tên danh mục</label>
                                <input class="form-control" type="text" name="name" value="<?php echo $arCat['name']; ?>">
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