<?php
	require_once('../../../../Connections/dgz.php');

	$nid = $_GET['nid'];

	// Gallery
	$sqlg = "select * from tb_newsletter_gallery WHERE nid='$nid'";
	$resultg = mysql_query($sqlg, $dgz) or die(mysql_error());
	while ($g = mysql_fetch_array($resultg))	{
		if ($g[ngpic] != "") unlink("../resources/gallery/$g[ngpic]");
		$sqldg = "DELETE FROM tb_newsletter_gallery WHERE ngid='$g[ngid]' AND nid='$nid'";
		$resultdg = mysql_query($sqldg,$dgz);
		if ($resultdg) continue;
		else die('ERROR : Can not delete this picture.<meta http-equiv="refresh" content="3;URL=../index.php?nid=$nid">');
	}

	// Info
	$sqltp = "select * from tb_newsletter_info WHERE nid='$nid'";
	$resulttp = mysql_query($sqltp, $dgz) or die(mysql_error());
	$tp = mysql_fetch_array($resulttp);

	if ($tp[nheader] != "") unlink("../resources/pic/".$tp[nheader]);

	$sqln = "DELETE FROM tb_newsletter_info WHERE nid='$nid'";
	$resultn = mysql_query($sqln,$dgz);
	if ($resultn) header("Location:../index.php");
	else die('ERROR : Can not delete this Template.<meta http-equiv="refresh" content="3;URL=../index.php">');
?>