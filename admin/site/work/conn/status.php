<?php
	require_once('../../../../Connections/dgz.php');

	$wid = $_GET['wid'];
	$status = $_GET['status'];

	$sql = "UPDATE tb_work SET wactive='$status' WHERE wid='$wid'";
	$result = mysql_query($sql,$dgz);
	if ($result) header("Location:../index.php");
	else echo "ERROR : Can not update work active.";
?>