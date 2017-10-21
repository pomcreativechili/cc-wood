<?php
	require_once('../../../../Connections/dgz.php');

	$slid = $_GET['slid'];
	$slpic = $_GET['slpic'];
	$slpath = "../../../resources/slide";

	if ($slpic != "")	{
		unlink("$slpath/thumb/$slpic");
		unlink("$slpath/$slpic");
	}

	$sql = "DELETE FROM tb_slide WHERE slid='$slid'";
	$result = mysql_query($sql,$dgz);
	if ($result) header("Location:../index.php");
	else echo "ERROR : Can not delete this slide.";
?>