<?php require_once $_SERVER['DOCUMENT_ROOT'].'/functions/DBConnectionUtil.php'; ?>
<?php
$active = $_POST['aactive'];
$acl = $_POST['acl'];

if ($active == 0) {
	?>
	<a href="javascript:void(0)" onclick="return setStatus(1, '<?php echo $acl?>')">
		<img src="/files/active/deactive.gif" alt="" />
	</a>
	<?php
} elseif ($active == 1) {
	?>
	<a href="javascript:void(0)" onclick="return setStatus(0, '<?php echo $acl?>')">
		<img src="/files/active/active.gif" alt="" />
	</a>
	<?php
}

    $queryActive = " UPDATE news SET active = '$active' WHERE id = '$acl' ";
    $resultActive = $mysqli -> query($queryActive);
?>