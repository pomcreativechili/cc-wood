<?php
	require_once('../../../../Connections/dgz.php');

	$htype = $_GET['htype'];
	$hid = $_GET['hid'];
	$status = $_GET['status'];
	
	$sql = "UPDATE tb_home SET hactive='$status' WHERE hid='$hid' AND htype='$htype'";
	$result = mysql_query($sql,$dgz);
	if ($result) header("Location:../index.php?htype=$htype");
	else echo "ERROR : Can not update information active.";
?>