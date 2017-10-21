<?php
	require_once("../../../../Connections/dgz.php");

	$wid = $_GET['wid'];
	$wpic = $_GET['wpic'];
	$wpath = "../../../resources/work";
	if ($wpic != "") unlink("$wpath/$wpic");
		
	$sql = "UPDATE tb_work SET wpic='' WHERE wid='$wid'";
	$result = mysql_query($sql,$dgz);
	if ($result) header("Location:../update.php?wid=$wid");
	else echo "ERROR : Can not delete this picture.";
?>