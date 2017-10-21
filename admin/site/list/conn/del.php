<?php
	require_once('../../../../Connections/dgz.php');

	$pid = $_GET['pid'];
	$ltype = $_GET['ltype'];
	$lid = $_GET['lid'];
	$lpic = $_GET['lpic'];
	$lpath = "../../../resources/list";

	if ($ltype == "3")	{
		$sqlg = "select * from tb_gallery WHERE pid='$lid' AND gpage='$pid' AND gtype='3' order by gsort";
		$resultg = mysql_query($sqlg, $dgz) or die(mysql_error());
		$totalg = mysql_num_rows($resultg);
		if ($totalg > 0)	{
			while ($g = mysql_fetch_array($resultg))	{
				unlink("$lpath/gallery/$g[gthumb]");
				unlink("$lpath/gallery/$g[glarge]");
				
				$sqldg = "DELETE FROM tb_gallery WHERE gid='$g[gid]' AND pid='$lid' AND gpage='$pid' AND gtype='3'";
				$resultdg = mysql_query($sqldg,$dgz);
				if ($resultdg) continue;
				else echo "ERROR : Can not delete this picture.";
			}
		}
	}

	if ($lpic != "") unlink("$lpath/$lpic");
	$sql = "DELETE FROM tb_list WHERE lid='$lid' AND pid='$pid' AND ltype='$ltype'";
	$result = mysql_query($sql,$dgz);
	if ($result) header("Location:../index.php?pid=$pid");
	else echo "ERROR : Can not delete this information.";
?>