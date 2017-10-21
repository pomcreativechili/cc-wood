<?php
	require_once('../../../../Connections/dgz.php');

	$slid = $_GET['slid'];
	$slpic = $_GET['slpic'];
	$slpath = "../../../resources/slide";
	
	if ($slpic != "")	{
		unlink("$slpath/thumb/$slpic");
		unlink("$slpath/$slpic");
	}
		
	$sql = "UPDATE tb_slide SET slpic='' WHERE slid='$slid'";
	$result = mysql_query($sql,$dgz);
	if ($result) { header("Location:../update.php?slid=$slid"); }
	else { echo "ERROR : Cannot delete this picture."; }
?>