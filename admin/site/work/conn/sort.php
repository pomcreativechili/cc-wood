<?php
	require_once('../../../../Connections/dgz.php');

	$total = $_POST['total'];
	
	while ($total > 0)	{
		$text1 = "id".$total;
		$text2 = "num".$total;
		$wid = $_POST[$text1];
		$num = $_POST[$text2];
		$total--;
	
		$sql = "UPDATE tb_work SET wsort='$num' WHERE wid='$wid'";
		$result = mysql_query($sql,$dgz);
		if ($result) continue;
		else echo "ERROR : Cannot update sort number for work.";
	}
	
	header("Location:../index.php");
?>