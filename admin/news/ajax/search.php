<?php require_once $_SERVER['DOCUMENT_ROOT'].'/functions/DBConnectionUtil.php' ?>
<?php  
	$nameSearch = $_POST['aname'];
?>
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
                                    $queryNews = "SELECT news.*,cat_list.name AS nameCat FROM news LEFT JOIN cat_list ON news.cat_id = cat_list.id WHERE news.name LIKE '%{$nameSearch}%' ORDER BY id DESC ";
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
                            
                        </div>