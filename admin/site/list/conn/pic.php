<?php
	require_once("../../../../Connections/dgz.php");

	$pid = $_GET['pid'];
	$ltype = $_GET['ltype'];
	$lid = $_GET['lid'];
	$lpic = $_GET['lpic'];
	$lpath = "../../../resources/list";
	if ($lpic != "") unlink("$lpath/$lpic");
		
	$sql = "UPDATE tb_list SET lpic='' WHERE pid='$pid' AND lid='$lid' AND ltype='$ltype'";
	$result = mysql_query($sql,$dgz);
	if ($result) header("Location:../update.php?pid=$pid&lid=$lid");
	else echo "ERROR : Can not delete this picture.";
?>