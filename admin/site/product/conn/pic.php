<?php
	require_once("../../../../Connections/dgz.php");

	$pid = $_GET['pid'];
	$cid = $_GET['cid'];
	$pdid = $_GET['pdid'];
	$pdpic = $_GET['pdpic'];
	$pdlarge = str_replace('th','',"$pdpic");
	$pdpath = "../../../resources/product";
	if ($pdpic != "") {
		unlink("$pdpath/$pdpic");
		unlink("$pdpath/$pdlarge");
	}
		
	$sql = "UPDATE tb_product SET pdpic='' WHERE pid='$pid' AND cid='$cid' AND pdid='$pdid'";
	$result = mysql_query($sql,$dgz);
	if ($result) header("Location:../update.php?pid=$pid&cid=$cid&pdid=$pdid");
	else echo "ERROR : Can not delete this picture.";
?>