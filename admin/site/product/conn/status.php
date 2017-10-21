<?php
	require_once('../../../../Connections/dgz.php');

	$pdid = $_GET['pdid'];
	$pid = $_GET['pid'];
	$cid = $_GET['cid'];
	$status = $_GET['status'];

	$sql = "UPDATE tb_product SET pdactive='$status' WHERE pdid='$pdid' AND pid='$pid' AND cid='$cid'";
	$result = mysql_query($sql,$dgz);
	if ($result) header("Location:../index.php?pid=$pid&cid=$cid");
	else echo "ERROR : Can not update information active.";
?>