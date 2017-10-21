<?php
	require_once('../../../../Connections/dgz.php');

	$egid = $_GET['egid'];
	$emid = $_GET['emid'];

	$sqlem = "DELETE FROM tb_email_account WHERE egid='$egid' AND emid='$emid'";
	$resultem = mysql_query($sqlem,$dgz);
	if ($resultem) header("Location:../index.php?egid=$egid");
	else echo "ERROR : Can not delete this account.";
?>