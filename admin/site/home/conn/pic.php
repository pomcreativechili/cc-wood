<?php
	require_once("../../../../Connections/dgz.php");

	$htype = $_GET['htype'];
	$hid = $_GET['hid'];
	$hpic = $_GET['hpic'];
	$hpath = "../../../resources/home";
	if ($hpic != "") unlink("$hpath/$hpic");
		
	$sql = "UPDATE tb_home SET hpic='' WHERE hid='$hid' AND htype='$htype'";
	$result = mysql_query($sql,$dgz);
	if ($result) header("Location:../update.php?htype=$htype&hid=$hid");
	else echo "ERROR : Can not delete this picture.";
?>