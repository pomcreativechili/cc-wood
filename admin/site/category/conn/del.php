<?php
	require_once('../../../../Connections/dgz.php');

	$pid = $_GET['pid'];
	$cid = $_GET['cid'];
	$pdpath = "../../../resources/product";

	// Product
	$sqlpd = "select * from tb_product WHERE pid='$pid' AND cid='$cid' order by pdsort";
	$resultpd = mysql_query($sqlpd, $dgz) or die(mysql_error());
	$totalpd = mysql_num_rows($resultpd);
	if ($totalpd > 0)	{
		while ($pd = mysql_fetch_array($resultpd))	{
			// Gallery
			$sqlg = "select * from tb_gallery WHERE pid='$pid' AND gpage='$cid' AND gtype='5' AND pdid='$pd[pdid]' order by gsort";
			$resultg = mysql_query($sqlg, $dgz) or die(mysql_error());
			$totalg = mysql_num_rows($resultg);
			if ($totalg > 0)	{
				while ($g = mysql_fetch_array($resultg))	{
					unlink("$pdpath/gallery/$g[gthumb]");
					unlink("$pdpath/gallery/$g[glarge]");
					
					$sqldg = "DELETE FROM tb_gallery WHERE gid='$g[gid]' AND pid='$pid' AND gpage='$cid' AND gtype='5' AND pdid='$pd[pdid]'";
					$resultdg = mysql_query($sqldg,$dgz);
					if ($resultdg) continue;
					else echo "ERROR : Can not delete this picture.";
				}
			}
		
			// Delete Product
			if ($pd[pdpic] != "")	{
				$pdlarge = str_replace('th','',"$pd[pdpic]");
				unlink("$pdpath/$pd[pdpic]");
				unlink("$pdpath/$pdlarge");
			}
			$sqlpd = "DELETE FROM tb_product WHERE pdid='$pd[pdid]' AND pid='$pid' AND cid='$cid'";
			$resultpd = mysql_query($sqlpd,$dgz);
			if ($resultpd) continue;
			else echo "ERROR : Can not delete this information.";
		}
	}

	// Category
	$sqlc = "DELETE FROM tb_category WHERE pid='$pid' AND cid='$cid'";
	$resultc = mysql_query($sqlc,$dgz);
	if ($resultc) header("Location:../index.php?pid=$pid");
	else echo "ERROR : Can not delete this category.";
?>