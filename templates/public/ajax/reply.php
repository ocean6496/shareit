<?php  
	require_once $_SERVER['DOCUMENT_ROOT'].'/functions/DBConnectionUtil.php';

	$id_news = $_POST['id'];
	$id_comment = $_POST['pid'];
	$email = $_POST['email'];
	$content = $_POST['mess'];

	
    $query = "SELECT * FROM user WHERE email = '$email' ";
    $result = $mysqli -> query($query);
    if ($arUser = mysqli_fetch_assoc($result)) {
        $user_id = $arUser['id'];
        $username = $arUser['username'];
    }

    $queryAddComment = "INSERT INTO comment(id,content,user_id,news_id,parent_id,name,email,active) VALUES('','$content','$user_id','$id_news','$id_comment','$username','$email','0')";
    $resultAddComment = $mysqli -> query($queryAddComment);
    if ($resultAddComment) {
        echo "<script>alert('ok');</script>";
    } else {
        echo "<script>alert('not ok');</script>";
    }
    
?>