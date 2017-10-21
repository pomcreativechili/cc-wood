<?php
	require_once('../../../../Connections/dgz.php');

	$slid = $_GET['slid'];
	$status = $_GET['status'];

	$sql = "UPDATE tb_slide SET slactive='$status' WHERE slid = '$slid'";
	$result = mysql_query($sql,$dgz);
	if ($result) header("Location:../index.php");
	else echo "ERROR : Can not update slide active.";
?>
