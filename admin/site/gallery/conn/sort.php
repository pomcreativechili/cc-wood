<?php
	require_once('../../../../Connections/dgz.php');

	$pid = $_POST['pid'];
	$gtype = $_POST['gtype'];
	$pdid = $_POST['pdid'];
	if ($gtype == "5") $pdsql = " AND pdid='$pdid'";
	$gpage = $_POST['gpage'];
	$total = $_POST['total'];
	
	while ($total > 0)	{
		$text1 = "id".$total;
		$text2 = "num".$total;
		$gid = $_POST[$text1];
		$num = $_POST[$text2];
		$total--;
	
		$sql = "UPDATE tb_gallery SET gsort='$num' WHERE gtype='$gtype' AND gpage='$gpage' AND gid='$gid'".$pdsql;
		$result = mysql_query($sql,$dgz);
		if ($result) continue;
		else echo "ERROR : Cannot update sort number for picture.";
	}
	
	header("Location:../index.php?pid=$pid&gtype=$gtype&gpage=$gpage&pdid=$pdid");
?>