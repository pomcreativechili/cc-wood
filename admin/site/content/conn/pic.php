<?php
	require_once('../../../../Connections/dgz.php');

	$pid = $_GET['pid'];
	$ptype = $_GET['ptype'];
	$ppic = $_GET['ppic'];
	$ppath = "../../../resources/pages";
	
	if ($ppic != "")	{
		if ($ptype != "6") unlink("$ppath/thumb/$ppic");
		unlink("$ppath/$ppic");
	}
		
	$sql = "UPDATE tb_page SET ppic='' WHERE pid='$pid'";
	$result = mysql_query($sql,$dgz);
	if ($result) header("Location:../update.php?pid=$pid");
	else echo "ERROR : Cannot delete this picture.";
?>