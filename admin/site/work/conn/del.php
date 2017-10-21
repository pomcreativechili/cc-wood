<?php
	require_once('../../../../Connections/dgz.php');

	$wid = $_GET['wid'];
	$wpic = $_GET['wpic'];
	$wpath = "../../../resources/work";

	$sqlg = "select * from tb_gallery WHERE pid='$wid' AND gpage='4000' AND gtype='4' order by gsort";
	$resultg = mysql_query($sqlg, $dgz) or die(mysql_error());
	$totalg = mysql_num_rows($resultg);
	if ($totalg > 0)	{
		while ($g = mysql_fetch_array($resultg))	{
			unlink("$wpath/gallery/$g[gthumb]");
			unlink("$wpath/gallery/$g[glarge]");
			
			$sqldg = "DELETE FROM tb_gallery WHERE gid='$g[gid]' AND pid='$wid' AND gpage='4000' AND gtype='4'";
			$resultdg = mysql_query($sqldg,$dgz);
			if ($resultdg) continue;
			else echo "ERROR : Can not delete this picture.";
		}
	}

	if ($wpic != "") unlink("$wpath/$wpic");
	$sql = "DELETE FROM tb_work WHERE wid='$wid'";
	$result = mysql_query($sql,$dgz);
	if ($result) header("Location:../index.php");
	else echo "ERROR : Can not delete this work.";
?>