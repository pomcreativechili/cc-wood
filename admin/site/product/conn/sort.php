<?php
	require_once('../../../../Connections/dgz.php');

	$pid = $_POST['pid'];
	$cid = $_POST['cid'];
	$total = $_POST['total'];
	
	while ($total > 0)	{
		$text1 = "id".$total;
		$text2 = "num".$total;
		$pdid = $_POST[$text1];
		$num = $_POST[$text2];
		$total--;
	
		$sql = "UPDATE tb_product SET pdsort='$num' WHERE pdid='$pdid' AND pid='$pid' AND cid='$cid'";
		$result = mysql_query($sql,$dgz);
		if ($result) { continue; }
		else { echo "ERROR : Cannot update sort number for information."; }
	}
	
	header("Location:../index.php?pid=$pid&cid=$cid");
?>