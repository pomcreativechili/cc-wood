<?php
	require_once('../../../../Connections/dgz.php');

	$nid = $_GET['nid'];
	$nheader = $_GET['nheader'];
	if ($nheader != "") unlink("../resources/pic/".$nheader);
	
	$sqlhd = "UPDATE tb_newsletter_info SET nheader='', nhdalt='', nhdurl='' WHERE nid='$nid'";
	$resulthd = mysql_query($sqlhd,$dgz);
	if ($resulthd) header("Location:../header.php?nid=$nid");
	else die('ERROR : Can not delete this Header.<meta http-equiv="refresh" content="3;URL=../header.php?nid='.$nid.'">');
?>