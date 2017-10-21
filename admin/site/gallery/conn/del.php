<?php
	require_once('../../../../Connections/dgz.php');

	$gpage = $_GET['gpage'];
	$pid = $_GET['pid'];
	$pdid = $_GET['pdid'];
	$gtype = $_GET['gtype'];
	$gid = $_GET['gid'];
	$gthumb = $_GET['gthumb'];
	$glarge = $_GET['glarge'];

	if ($gtype == "1")	{
		if ($gthumb != "") unlink("../../../resources/pages/gallery/$gthumb");
	}	else if ($gtype == "2")	{
		if ($gthumb != "") unlink("../../../resources/pages/gallery/$gthumb");
		if ($glarge != "") unlink("../../../resources/pages/gallery/$glarge");
	}	else if ($gtype == "3")	{
		if ($gthumb != "") unlink("../../../resources/list/gallery/$gthumb");
		if ($glarge != "") unlink("../../../resources/list/gallery/$glarge");
	}	else if ($gtype == "4")	{
		if ($gthumb != "") unlink("../../../resources/work/gallery/$gthumb");
		if ($glarge != "") unlink("../../../resources/work/gallery/$glarge");
	}	else if ($gtype == "5")	{
		$pdsql = " AND pdid='$pdid'";
		if ($gthumb != "") unlink("../../../resources/product/gallery/$gthumb");
		if ($glarge != "") unlink("../../../resources/product/gallery/$glarge");
	}

	$sql = "DELETE FROM tb_gallery WHERE gid='$gid' AND pid='$pid' AND gtype='$gtype' AND gpage='$gpage'".$pdsql;
	$result = mysql_query($sql,$dgz);
	if ($result) header("Location:../index.php?pid=$pid&gtype=$gtype&gpage=$gpage&pdid=$pdid");
	else echo "ERROR : Can not delete this picture.";
?>