<?php
	require_once('../../../../Connections/dgz.php');

	$pid = $_GET['pid'];
	$cid = $_GET['cid'];
	$pdid = $_GET['pdid'];
	$pdpic = $_GET['pdpic'];
	$pdlarge = str_replace('th','',"$pdpic");
	$pdpath = "../../../resources/product";

	$sqlg = "select * from tb_gallery WHERE pid='$pid' AND gpage='$cid' AND gtype='5' AND pdid='$pdid' order by gsort";
	$resultg = mysql_query($sqlg, $dgz) or die(mysql_error());
	$totalg = mysql_num_rows($resultg);
	if ($totalg > 0)	{
		while ($g = mysql_fetch_array($resultg))	{
			unlink("$pdpath/gallery/$g[gthumb]");
			unlink("$pdpath/gallery/$g[glarge]");
			
			$sqldg = "DELETE FROM tb_gallery WHERE gid='$g[gid]' AND pid='$pid' AND gpage='$cid' AND gtype='5' AND pdid='$pdid'";
			$resultdg = mysql_query($sqldg,$dgz);
			if ($resultdg) continue;
			else echo "ERROR : Can not delete this picture.";
		}
	}

	if ($pdpic != "")	{
		unlink("$pdpath/$pdpic");
		unlink("$pdpath/$pdlarge");
	}
	$sqlpd = "DELETE FROM tb_product WHERE pdid='$pdid' AND pid='$pid' AND cid='$cid'";
	$resultpd = mysql_query($sqlpd,$dgz);
	if ($resultpd) header("Location:../index.php?pid=$pid&cid=$cid&pdid=$pdid");
	else echo "ERROR : Can not delete this information.";
?>