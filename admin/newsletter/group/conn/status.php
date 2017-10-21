<?php
	require_once('../../../../Connections/dgz.php');

	$egid = $_GET['egid'];
	$status = $_GET['status'];

	$sql = "UPDATE tb_email_group SET egactive='$status' WHERE egid='$egid'";
	$result = mysql_query($sql,$dgz);
	if ($result) header("Location:../index.php");
	else echo "ERROR : Can not update group active.";
?>