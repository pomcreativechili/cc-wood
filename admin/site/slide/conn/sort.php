<?php
	require_once('../../../../Connections/dgz.php');

	$total = $_POST['total'];
	while ($total > 0)	{
		$text1 = "id".$total;
		$text2 = "num".$total;
		$slid = $_POST[$text1];
		$num = $_POST[$text2];
		$total--;
	
		$sql = "UPDATE tb_slide SET slsort='$num' WHERE slid='$slid'";
		$result = mysql_query($sql,$dgz);
		if ($result) continue;
		else echo "ERROR : Cannot update sort number for slide.";
	}
	
	header("Location:../index.php");
?>