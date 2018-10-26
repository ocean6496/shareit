<?php  
    require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php';
?>

<script type="text/javascript">
    document.title = 'ShareIT | Edit News';
</script>
<div class="content-wrapper">
    <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Quản lý tin tức</h4>

            </div>

        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Sửa tin
                    </div>
                    <div class="panel-body">
                        <?php
                            $id_news = $_GET['id'];  
                            $queryNews = "SELECT news.*,cat_list.name AS nameCat FROM news INNER JOIN cat_list ON news.cat_id = cat_list.id WHERE news.id = '$id_news' ORDER BY id DESC";
                            $resultNews = $mysqli -> query($queryNews);
                            if ($arNews = mysqli_fetch_assoc($resultNews)) {
                              $id_news = $arNews['id'];
                              $id_cat = $arNews['cat_id'];
                              $name = $arNews['name'];
                              $nameCat = $arNews['nameCat'];
                              $picture = $arNews['picture'];
                              $preview = $arNews['preview'];
                              $detail = $arNews['detail'];
                            }  
                            
                        ?>
                        <?php  
                            if (isset($_POST['submit'])) {
                                
                                $nameNews = $_POST['name'];
                                $danhmuc = $_POST['category'];                                     
                                $preview = $_POST['preview_text'];                                        
                                $detail = $_POST['detail_text'];
                                    //delete image
                                    if (isset($_POST['delete'])) {
                                        $file_path = $_SERVER['DOCUMENT_ROOT'].'/files/images/'.$picture;
                                        unlink($file_path);
                                    }
                                    //upload files
                                    if ($_FILES['picture']['name'] != '') {
                                        //change file name
                                        $name = $_FILES['picture']['name'];
                                        $arTmp = explode(".", $name);
                                        $duoiFile = end($arTmp);
                                        $newName = 'VNE-'.time().'.'.$duoiFile;

                                        $tmp_name = $_FILES['picture']['tmp_name'];
                                        $path_upload = $_SERVER['DOCUMENT_ROOT'].'/files/images/'.$newName;
                                        move_uploaded_file($tmp_name, $path_upload);

                                        $query = "UPDATE news SET name = '$nameNews', cat_id = '$danhmuc', preview = '$preview', detail = '$detail',picture = '$newName' WHERE id = '$id_news' ";
                                        $result = $mysqli -> query($query);
                                        if ($result) {
                                           header('location: index.php?msg=Sửa thành công');
                                        } else {
                                            header('location: index.php?msg=Lỗi khi sửa dữ liệu!');
                                        } 
                                    } else {
                                        $query = "UPDATE news SET name = '$nameNews', cat_id = '$danhmuc', preview = '$preview', detail = '$detail' WHERE id = '$id_news' ";
                                        $result = $mysqli -> query($query);
                                        if ($result) {
                                           header('location: index.php?msg=Sửa thành công');
                                        } else {
                                            header('location: index.php?msg=Lỗi khi sửa dữ liệu!');
                                        } 
                                    }

                            }
                        ?>
                        <form role="form" action="edit.php?id=<?php echo $id_news; ?>" enctype="multipart/form-data" method="POST">
                            <div class="form-group">
                                <label>Tên tin</label>
                                <input class="form-control" type="text" name="name" value="<?php echo $name; ?>">
                            </div>
                            <div class="form-group">
                                <label>Danh mục</label>
                                <select class="form-control" name="category">
                                    <option value="<?php echo $id_cat; ?>">
                                        <?php echo $nameCat; ?>
                                    </option>
                                    <?php  
                                        $queryCat = "SELECT * FROM cat_list WHERE id != '$cat_id' ORDER BY id DESC";
                                        $resultCat = $mysqli -> query($queryCat);
                                        while ( $arCat = mysqli_fetch_assoc($resultCat)) {
                                            $id_cat = $arCat['id'];
                                            $nameCat = $arCat['name'];
                                            
                                    ?>
                                    <option value="<?php echo $id_cat; ?>">
                                        <?php echo $nameCat; ?>
                                    </option>
                                    <?php  
                                                    }
                                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh củ</label><br> Xóa hình <input type="checkbox" name="delete">
                                <img width="100px" src="/files/images/<?php echo $picture;  ?>">
                                <p class="help-block"></p>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input type="file" name="picture" value="">
                                <p class="help-block"></p>
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="form-control" rows="3" name="preview_text"><?php echo $preview; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Chi tiết</label>
                                <textarea class="form-control" id="editor1" rows="3" name="detail_text"><?php echo $detail; ?></textarea>
                                <script type="text/javascript">
                                    CKEDITOR.replace('editor1', {
                                        filebrowserBrowseUrl: '/libraries/ckfinder/ckfinder.html',
                                        filebrowserImageBrowseUrl: '/libraries/ckfinder/ckfinder.html?type=Images',
                                        filebrowserUploadUrl: '/libraries/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                        filebrowserImageUploadUrl: '/libraries/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
                                    });
                                </script>
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