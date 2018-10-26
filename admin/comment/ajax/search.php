<?php require_once $_SERVER['DOCUMENT_ROOT'].'/functions/DBConnectionUtil.php' ?>
<?php  
	$nameSearch = $_POST['aname'];
?>
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
            $queryCmt = "SELECT comment.*,news.name AS newsName FROM comment INNER JOIN news ON comment.news_id = news.id WHERE news.name LIKE '%{$nameSearch}%' ORDER BY id DESC  ";
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