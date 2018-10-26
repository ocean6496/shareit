<?php  
    require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php';
?>

<script type="text/javascript">
    document.title = 'ShareIT | Add Category';
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
                        Thêm danh mục
                    </div>
                    <div class="panel-body">
                        <?php  
                            if (isset($_POST['submit'])) {
                                $nameCat = $_POST['name'];
                                $catParent = $_POST['cat'];

                                $queryAddCat = "INSERT INTO cat_list(id,name,parent_id) VALUES('','$nameCat','$catParent')";
                                $resultAddCat = $mysqli -> query($queryAddCat);
                                if ($resultAddCat) {
                                    header('location:/admin/category/index.php?msg=Thêm thành công!');
                                } else {
                                    header('location:/admin/category/index.php?msg=Thêm không thành công!');
                                }
                            }
                        ?>
                        <form role="form" action="" method="POST" id="frmAdd">
                            <input type="hidden" name="_token" value="GzOgAeAQ2aVpA37WbIjUaJY0HAc9xtnSgznogsOh">
                            <div class="form-group">
                                <label>Tên danh mục</label>
                                <input class="form-control" type="text" name="name" placeholder="nhập tên danh mục">
                                <p class="help-block">
                                    <i style="color:red">

                                      
                                </i>
                                </p>
                            </div>
                            <div class="form-group">
                                <label>Danh mục cha</label>
                                <select class="form-control" name="cat">
                                                <option value="0">Không</option>
                                                <?php  
                                                    $queryCat = "SELECT * FROM cat_list WHERE parent_id = 0 ";
                                                    $resultCat = $mysqli -> query($queryCat);
                                                    while ($arCat = mysqli_fetch_assoc($resultCat)) {
                                                        $id_cat = $arCat['id'];
                                                        $name = $arCat['name'];
                                                    
                                                ?>                              
                                                <option value="<?php echo $id_cat; ?>"><?php echo $name; ?></option>
                                                <?php  
                                                    }
                                                ?>
                                </select>
                                <p class="help-block"></p>
                            </div>
                            <input type="submit" name="submit" value="Thêm" class="btn btn-info">
                        </form>
                        <script type="text/javascript">
                            $(document).ready(function () {
                                $('#frmAdd').validate({
                                    rules: {
                                        "name": {
                                            required: true,
                                        },
                                    },
                                    messages: {
                                      "name": {
                                        required: "Vui lòng nhập tên danh mục!",
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