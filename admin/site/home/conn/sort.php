<?php
	require_once('../../../../Connections/dgz.php');

	$htype = $_POST['htype'];
	$total = $_POST['total'];
	
	while ($total > 0)	{
		$text1 = "id".$total;
		$text2 = "num".$total;
		$hid = $_POST[$text1];
		$num = $_POST[$text2];
		$total--;
	
		$sql = "UPDATE tb_home SET hsort='$num' WHERE hid='$hid' AND htype='$htype'";
		$result = mysql_query($sql,$dgz);
		if ($result) continue;
		else echo "ERROR : Cannot update sort number for information.";
	}
	
	header("Location:../index.php?htype=$htype");
?>