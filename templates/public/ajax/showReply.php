<?php  
	$id_news = $_POST['id'];
	$id_comment = $_POST['bid'];
?>
<div class="media-left response-text-left">
	<a href="">
		<img style="width: 60px !important" class="media-object" src="/templates/public/images/icon1.png" alt="">
	</a>
	<h5>
		<a href="#">Khách</a>
	</h5>
</div>
<div class="media-body response-text-right">
	<form action="javascript:void(0)" onsubmit="pcmt(<?php echo $id_news; ?>,<?php echo $id_comment; ?>)" method="POST">
		<p>
			<input type="email" name="email" id="email" placeholder="Nhập email">
			<input type="submit" name="submit" id="btn-info" value="Gửi" style="margin-left: 2%;color: #fff;background-color: #5bc0de;
            border-color: #46b8da;padding: 5px 9px;border-radius: 4px;">
			<textarea type="text" id="messages" name="messages" cols="40" placeholder="Nhập bình luận"></textarea>
		</p>
	</form>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
	function pcmt(id,pid){
	var email;
	var mess;
	email = $('#email').val();
	mess = $('#messages').val();
	        $.ajax({
            url: "/templates/public/ajax/reply.php", 
            type: 'POST',
            dataType: 'html',
            data: {
             	id:id,
             	pid:pid,
				email:email,
				mess:mess,
               _token: '4dPywYttKmAcfAGLdNitYRTaoVUCPEx0cfu52JLx',
            },
           success: function(data){
				$('.p-show').html('<h4 style="font-size:16px">Quản trị viên đang xem xét bình luận của bạn</h4>');
				
			},
			error: function (){
				alert('Có lỗi xảy ra');
			}
		});
	
	}
</script>