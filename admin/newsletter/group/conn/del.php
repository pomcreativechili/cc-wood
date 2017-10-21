<?php
	require_once('../../../../Connections/dgz.php');

	$egid = $_GET['egid'];

	$sql = "DELETE tb_email_group, tb_email_account FROM tb_email_group";
	$sql .= " LEFT JOIN tb_email_account ON tb_email_group.egid = tb_email_account.egid";
	$sql .= " WHERE tb_email_group.egid='$egid'";
	$result = mysql_query($sql,$dgz);
	if ($result) header("Location:../index.php");
	else echo "ERROR : Can not delete this group.";
?>