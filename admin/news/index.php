<?php  
    require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php';
?>

<script type="text/javascript">
    document.title = 'ShareIT | News';
</script>
<div class="content-wrapper">
    <div class="container">
        <div class="row pad-botm">
            <div class="col-md-6">
                <h4 class="header-line">Quản lý tin</h4>
                <a href="/admin/news/add.php" class="btn btn-success">Thêm</a>
                <?php  
                    if (isset($_GET['msg'])) {
                        echo "<h4 style = 'color:red;padding-top:10px;'>{$_GET['msg']}</h4>";
                    }
                ?>
            </div>
            <div class="col-md-6" style="text-align: right;margin-top: 50px;">
                <form method="post" action="javascript: void(0)">
                    <input type="submit" name="search" value="Tìm kiếm" onclick="return getInfo();" class="btn btn-warning btn-sm" style="float:right" />
                    <input type="search" class="form-control input-sm" id="search" placeholder="Nhập tên tin" style="float:right; width: 300px;" />
                    <div style="clear:both"></div>
                </form><br />
            </div>
            <script type="text/javascript">
                function getInfo() {
                    var name = $('#search').val();
                    $.ajax({
                        url: 'ajax/search.php',
                        type: 'POST',
                        cache: false,
                        data: {aname: name},
                        success: function(data){
                            $('.table-responsive').html(data);
                        },
                        error: function (){
                            alert('Có lỗi xảy ra');
                        }
                    });


                    return false;
                }
            </script>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Danh sách tin
                    </div>

                    <div class="panel-body">
                        <?php  
                            //tong so truyen
                            $queryTST = "SELECT COUNT(*) AS soluong FROM news";
                            $resultTST = $mysqli -> query($queryTST);
                            $arTmp = mysqli_fetch_assoc($resultTST);
                            $tongSoTruyen = $arTmp['soluong'];
                            //so truyen tren 1 trang
                            $row_count = ROW_COUNT;
                            //tong so trang 
                            $tongSoTrang = ceil($tongSoTruyen/$row_count);
                            //trang hien tai
                            $current_page = 1;
                            if (isset($_GET['page'])) {
                                $current_page = $_GET['page'];
                            }
                            //offset
                            $offset = ($current_page - 1)*$row_count;
                        ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="10%">ID Tin</th>
                                        <th width="30%">Tên Tin</th>
                                        <th width="15%">Danh mục</th>
                                        <th width="15%">Hình ảnh</th>
                                        <th width="15%">Trạng thái</th>
                                        <th width="15%">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php  
                                    $queryNews = "SELECT news.*,cat_list.name AS nameCat FROM news LEFT JOIN cat_list ON news.cat_id = cat_list.id ORDER BY id DESC LIMIT {$offset},{$row_count}";
                                    $resultNews = $mysqli -> query($queryNews);
                                    while ($arNews = mysqli_fetch_assoc($resultNews)) {
                                      $id_news = $arNews['id'];
                                      $name = $arNews['name'];
                                      $nameCat = $arNews['nameCat'];
                                      $picture = $arNews['picture'];
                                      $active = $arNews['active'];
                                      
                                    
                                  ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $id_news ?></td>
                                        <td><?php echo $name ?></td>
                                        <td><?php echo $nameCat ?></td>
                                        <td>
                                            <img src="/files/images/<?php echo $picture;  ?>" width="120px" height="80px" alt="">
                                        </td>


                                        <td class="<?php echo $id_news ?>" style="padding-left: 70px; ">
                                            <a href="javascript:void(0)" onclick="return setStatus(<?php if ($active ==1) {echo 0;} else {echo 1;} ?>, '<?php echo $id_news?>')">
                                                <?php
                                                if ($active == 1) {
                                                    $pic = 'active.gif';
                                                } else {
                                                    $pic = 'deactive.gif';
                                                }
                                                ?>
                                                <img src="/files/active/<?php echo $pic?>" alt="" />
                                            </a>
                                        </td> 


                                        <td align="center">
                                            <a href="/admin/news/edit.php?id=<?php echo $id_news ?>" class="btn btn-primary">Sửa</a>
                                            <a href="/admin/news/delete.php?id=<?php echo $id_news ?>" onclick="return confirm(&#39;Bạn có chắc chắn muốn xóa&#39;)" class="btn btn-danger">Xóa</a>
                                        </td>

                                    </tr>
                                  <?php  
                                    }
                                  ?>
                                   
                                </tbody>
                            </table>
                            <div align="center">
                               <!--  <ul class="pagination">

                                    <li class="disabled"><span>«</span></li>
                                    <li class="active"><span>1</span></li>
                                    <li><a href="http://shareit.vinaenter.edu.vn/admincp/news?page=2">2</a></li>
                                    <li><a href="http://shareit.vinaenter.edu.vn/admincp/news?page=3">3</a></li>
                                    <li><a href="http://shareit.vinaenter.edu.vn/admincp/news?page=2" rel="next">»</a></li>
                                </ul> -->
                                <ul class="pagination">
                                    <?php  
                                        if ($current_page == 1) {
                                    ?>        
                                            <li class="disabled"><span>«</span></li>
                                        <?php    
                                            } 
                                            else {
                                        ?>
                                            <li><a href="index.php?page=<?php echo $current_page-1; ?>" rel="previous">«</a></li>
                                    <?php
                                        }
                                    ?>
                                    
                                    <?php  
                                        for ($i=1; $i <= $tongSoTrang; $i++) { 
                                            if ($current_page == $i) {
                                    ?>
                                            <li class="paginate_button active" aria-controls="dataTables-example" tabindex="0">
                                                <a href="#"><?php echo "$i"; ?></a>
                                            </li>
                                        <?php  
                                            } else {
                                        ?>
                                    <li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="index.php?page=<?php echo $i; ?>"><?php echo "$i"; ?></a></li>
                                    <?php  
                                            }
                                        }
                                    ?>
                                    
                                    <?php  
                                        if ($current_page == $tongSoTrang) {
                                    ?>        
                                            <li class="disabled"><span>»</span></li>
                                        <?php    
                                            } 
                                            else {
                                        ?>
                                            <li><a href="index.php?page=<?php echo $current_page+1; ?>" rel="next">»</a></li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                            </div>
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
<script>
    function setStatus(active, cl){
        $.ajax({
            url: '/admin/news/ajax/status.php',
            type: 'POST',
            cache: false,
            data: {aactive: active, acl:cl},
            

            success: function(data){
                $('.' + cl).html(data);
            },
            error: function (){
                alert('Có lỗi xảy ra');
            }
        });
    }
</script>
<!-- <script type="text/javascript">
    function active(nid, active) {
        var url = '/admincp/news/active/' + nid + '/' + active;
        var tmp = "#actice-" + nid;

        $.ajax({
            url: url,
            dataType: "html",
            data: {

            },
            success: function(data) {
                tmp = "#actice-" + nid;
                if (active == 1) {
                    var ac = "<a href='javascript:void(0)' onclick='active(" + nid + " ,0);'><img src='/public/templates/admin/img/de.png'/></a>";
                    $(tmp).html(ac);
                } else {
                    var de = "<a href='javascript:void(0)' onclick='active(" + nid + " ,1);'><img src='/public/templates/admin/img/ac.png'/></a>";
                    $(tmp).html(de);
                }
                $('.ac123').html(data);
            },
        });
    }
</script> -->

<?php  
    require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php';
?>