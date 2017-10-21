<?php
	require_once('../../../../Connections/dgz.php');

	$htype = $_GET['htype'];
	$hid = $_GET['hid'];
	$hpic = $_GET['hpic'];
	$hpath = "../../../resources/home";

	if ($htype == "0")	{
		$sqlg = "select * from tb_gallery WHERE pid='0000' AND gpage='$hid' AND gtype='0' order by gsort";
		$resultg = mysql_query($sqlg, $dgz) or die(mysql_error());
		$totalg = mysql_num_rows($resultg);
		if ($totalg > 0)	{
			while ($g = mysql_fetch_array($resultg))	{
				unlink("$hpath/gallery/$g[gthumb]");
				
				$sqldg = "DELETE FROM tb_gallery WHERE gid='$g[gid]' AND pid='0000' AND gpage='$hid' AND gtype='0'";
				$resultdg = mysql_query($sqldg,$dgz);
				if ($resultdg) continue;
				else echo "ERROR : Can not delete this picture.";
			}
		}
	}

	if ($hpic != "") unlink("$hpath/$hpic");

	$sqlh = "DELETE FROM tb_home WHERE hid='$hid' AND htype='$htype'";
	$resulth = mysql_query($sqlh,$dgz);
	if ($resulth) header("Location:../index.php?htype=$htype&hid=$hid");
	else echo "ERROR : Can not delete this information.";
?>