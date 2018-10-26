<?php  
    require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php';
?>

<script type="text/javascript">
    document.title = 'ShareIT | Add News';
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
                          Thêm tin
                        </div>
                        <div class="panel-body">
                            <?php 
                                $created_by = $_SESSION['userInfo']['id'];
                                if (isset($_POST['submit'])) {
                                    
                                    $nameNews = $_POST['name'];
                                    $danhmuc = $_POST['category'];                                     
                                    $preview = $_POST['preview_text'];                                        
                                    $detail = $_POST['detail_text'];
                                    
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
                                        }

                                        $query = "INSERT INTO news(name, cat_id,created_by, preview, detail, picture) VALUES ('$nameNews', '$danhmuc', '$created_by', '$preview', '$detail', '$newName')";
                                        $result = $mysqli -> query($query);
                                        if ($result) {
                                           header('location: index.php?msg=Thêm thành công');
                                        } else {
                                            header('location: index.php?msg=Lỗi khi thêm dữ liệu!');
                                        }       
                                    
                                }
                            ?>
                            <form role="form" action="" enctype="multipart/form-data" method="POST" id="frmAdd">
                                        <div class="form-group">
                                            <label>Tên tin</label>
                                            <input class="form-control" type="text" name="name" value="">
                                        </div>
                                         <div class="form-group">
                                            <label>Danh mục</label>
                                             <select class="form-control" name="category">
                                                <?php  
                                                    $queryCat = "SELECT * FROM cat_list  ORDER BY id DESC";
                                                    $resultCat = $mysqli -> query($queryCat);
                                                    while ( $arCat = mysqli_fetch_assoc($resultCat)) {
                                                        $id_cat = $arCat['id'];
                                                        $nameCat = $arCat['name'];
                                                        
                                                ?>                                                    
                                                <option value="<?php echo $id_cat; ?>"><?php echo $nameCat; ?></option>
                                                <?php  
                                                    }
                                                ?> 
                                            </select>
                                            <p class="help-block"></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Hình ảnh</label>
                                            <input type="file" name="picture" value="">
                                            <p class="help-block"></p>
                                        </div>
                                          <div class="form-group">
                                            <label>Mô tả</label>
                                            <textarea class="form-control" class="CKEDITOR" rows="3" name="preview_text"></textarea>
                                        </div>
                                          <div class="form-group">
                                            <label>Chi tiết</label>
                                            <textarea id="editor1" class="form-control"  rows="5" name="detail_text"></textarea>
                                            <script type="text/javascript">
                                                CKEDITOR.replace( 'editor1',
                                             {
                                                 filebrowserBrowseUrl: '/libraries/ckfinder/ckfinder.html',
                                                 filebrowserImageBrowseUrl: '/libraries/ckfinder/ckfinder.html?type=Images',
                                                 filebrowserUploadUrl: '/libraries/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                                 filebrowserImageUploadUrl: '/libraries/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
                                             });
                                            </script>
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
                                                    "picture": {
                                                        required: true,
                                                    },
                                                    "preview_text": {
                                                        required: true,
                                                    },
                                                    "detail_text": {
                                                        required: true,
                                                    },
                                                },
                                                messages: {
                                                  "name": {
                                                    required: "Vui lòng nhập tên tin!",
                                                  },
                                                  "picture": {
                                                    required: "Vui lòng chọn hình ảnh!",
                                                  },
                                                  "preview_text": {
                                                    required: "Vui lòng nhập mô tả!",
                                                  },
                                                  "detail_text": {
                                                    required: "Vui lòng nhập chi tiết!",
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