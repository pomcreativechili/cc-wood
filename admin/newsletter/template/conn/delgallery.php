<?php
	require_once('../../../../Connections/dgz.php');

	$ngid = $_GET['ngid'];
	$nid = $_GET['nid'];
	$ngpic = $_GET['ngpic'];
	if ($ngpic != "") unlink("../resources/gallery/".$ngpic);

	$sqlng = "DELETE FROM tb_newsletter_gallery WHERE ngid='$ngid' AND nid='$nid'";
	$resultng = mysql_query($sqlng,$dgz);
	if ($resultng) header("Location:../template.php?nid=$nid#gallery");
	else die('ERROR : Can not delete this Picture.<meta http-equiv="refresh" content="3;URL=../template.php?nid=$nid">');
?>