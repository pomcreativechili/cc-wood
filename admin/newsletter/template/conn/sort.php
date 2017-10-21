<?php
	require_once('../../../../Connections/dgz.php');

	$nid = $_POST['nid'];
	$total = $_POST['total'];
	while ($total > 0)	{
		$text1 = "id".$total;
		$text2 = "num".$total;
		$ngid = $_POST[$text1];
		$num = $_POST[$text2];
		$total--;
	
		$sql = "UPDATE tb_newsletter_gallery SET ngsort='$num' WHERE ngid='$ngid' AND nid='$nid'";
		$result = mysql_query($sql,$dgz);
		if ($result) continue;
		else echo "ERROR : Cannot update sort number for gallery.";
	}
	
	header("Location:../template.php?nid=$nid&err=1#gallery");
?>