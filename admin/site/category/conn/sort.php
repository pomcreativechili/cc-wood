<?php
	require_once('../../../../Connections/dgz.php');

	$pid = $_POST['pid'];
	$total = $_POST['total'];
	while ($total > 0)	{
		$text1 = "id".$total;
		$text2 = "num".$total;
		$cid = $_POST[$text1];
		$num = $_POST[$text2];
		$total--;
	
		$sql = "UPDATE tb_category SET csort='$num' WHERE pid='$pid' AND cid='$cid'";
		$result = mysql_query($sql,$dgz);
		if ($result) continue;
		else echo "ERROR : Cannot update sort number for category.";
	}
	
	header("Location:../index.php?pid=$pid");
?>