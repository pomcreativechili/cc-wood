<?php
	require_once('../../../../Connections/dgz.php');

	$egid = $_GET['egid'];
	$emid = $_GET['emid'];
	$status = $_GET['status'];

	$sql = "UPDATE tb_email_account SET emactive='$status' WHERE egid='$egid' AND emid='$emid'";
	$result = mysql_query($sql,$dgz);
	if ($result) header("Location:../index.php?egid=$egid");
	else echo "ERROR : Can not update account active.";
?>