<?php  
    require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php';
?>

<script type="text/javascript">
    document.title = 'ShareIT | Comment';
</script>
<div class="content-wrapper">
    <div class="container">
        <div class="row pad-botm">
            <div class="col-md-6">
                <h4 class="header-line">Quản lý bình luận</h4>
            </div>
            <div class="col-md-6" style="text-align: right;margin-top: 20px;">
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
                            $('#table-search').html(data);
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
                <div class="panel panedanh mục tinl-default">

                    <?php  
                        //tong so truyen
                        $queryTST = "SELECT COUNT(*) AS soluong FROM comment";
                        $resultTST = $mysqli -> query($queryTST);
                        $arTmp = mysqli_fetch_assoc($resultTST);
                        $tongSoTruyen = $arTmp['soluong'];
                        //so truyen tren 1 trang
                        $row_count = ROW_COUNT_CMT;
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
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="table-search">
                                <thead>
                                    <tr>
                                        <th width="10%">ID bình luận</th>
                                        <th width="30%">Tên tin</th>
                                        <th width="15%">Người bình luận</th>
                                        <th width="30%">Nội dung</th>
                                        <th width="15%">Quản lý bình luận</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
                                        $queryCmt = "SELECT comment.*,news.name AS newsName FROM comment INNER JOIN news ON comment.news_id = news.id ORDER BY id DESC LIMIT {$offset},{$row_count} ";
                                        $resultCmt = $mysqli -> query($queryCmt);
                                        while ($arCmt = mysqli_fetch_assoc($resultCmt)) {
                                            $id_comment = $arCmt['id'];
                                            $newsName = $arCmt['newsName'];
                                            $content = $arCmt['content'];
                                            $name = $arCmt['name'];
                                            $active = $arCmt['active'];
                                        
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $id_comment; ?></td>
                                        <td><?php echo $newsName ?></td>
                                        <td><?php echo $name ?></td>
                                        <td><?php echo $content ?></td>

                                        <td class="<?php echo $id_comment ?>" style="padding-left: 70px; ">
                                            <a href="javascript:void(0)" onclick="return setStatus(<?php if ($active ==1) {echo 0;} else {echo 1;} ?>, '<?php echo $id_comment?>')">
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

                                    </tr>
                                    <?php  
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <!-- <ul class="pagination">

                                <li class="disabled"><span>«</span></li> <li class="active"><span>1</span></li>
                                <li><a href="http://shareit.vinaenter.edu.vn/admincp/comment?page=2">2</a></li>
                                <li><a href="http://shareit.vinaenter.edu.vn/admincp/comment?page=3">3</a></li>
                                <li><a href="http://shareit.vinaenter.edu.vn/admincp/comment?page=4">4</a></li>


                                <li><a href="http://shareit.vinaenter.edu.vn/admincp/comment?page=2" rel="next">»</a></li>
                            </ul> -->
                            <div align="center">
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
        <script>
            function setStatus(active, cl){
                $.ajax({
                    url: '/admin/comment/ajax/status.php',
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
            function active(bid, active) {
                var url = '/admincp/comment/active/' + bid + '/' + active;
                var tmp = "#actice-" + bid;

                $.ajax({
                    url: url,
                    dataType: "html",
                    data: {

                    },
                    success: function(data) {
                        tmp = "#actice-" + bid;
                        $(tmp).html(data);
                    },
                });
            }
        </script> -->
    </div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->



<?php  
    require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php';
?>