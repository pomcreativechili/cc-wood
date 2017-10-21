<?php
	require_once('../../../../Connections/dgz.php');

	$pid = $_GET['pid'];
	$ltype = $_GET['ltype'];
	$lid = $_GET['lid'];
	$status = $_GET['status'];

	$sql = "UPDATE tb_list SET lactive='$status' WHERE lid='$lid' AND pid='$pid' AND ltype='$ltype'";
	$result = mysql_query($sql,$dgz);
	if ($result) header("Location:../index.php?pid=$pid");
	else echo "ERROR : Can not update information active.";
?>