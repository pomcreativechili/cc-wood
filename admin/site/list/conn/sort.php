<?php
	require_once('../../../../Connections/dgz.php');

	$pid = $_POST['pid'];
	$ltype = $_POST['ltype'];
	$total = $_POST['total'];
	
	while ($total > 0)	{
		$text1 = "id".$total;
		$text2 = "num".$total;
		$lid = $_POST[$text1];
		$num = $_POST[$text2];
		$total--;
	
		$sql = "UPDATE tb_list SET lsort='$num' WHERE lid='$lid' AND pid='$pid' AND ltype='$ltype'";
		$result = mysql_query($sql,$dgz);
		if ($result) continue;
		else echo "ERROR : Cannot update sort number for information.";
	}
	
	header("Location:../index.php?pid=$pid");
?>