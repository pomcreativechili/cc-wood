<?php
	require_once('../../../../Connections/dgz.php');

	$pid = $_GET['pid'];
	$cid = $_GET['cid'];
	$status = $_GET['status'];

	$sql = "UPDATE tb_category SET cactive='$status' WHERE pid='$pid' AND cid='$cid'";
	$result = mysql_query($sql,$dgz);
	if ($result) header("Location:../index.php?pid=$pid");
	else echo "ERROR : Can not update category active.";
?>
