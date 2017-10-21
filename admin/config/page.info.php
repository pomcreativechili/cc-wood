<?php
	// Page Information
	$sqlp = "select * from tb_page WHERE pid='$pid'";
	$resultp = mysql_query($sqlp, $dgz) or die(mysql_error());
	$p = mysql_fetch_array($resultp);
	
	// Text
	if ($pid == "0000")	{
		if ($htype == "0" or $sess_htype == "0")	{
			$htext = "Highlight";
			$hfile = "hl";
			$hurltext = "External or Page URL :";
			$hurltip = "^ Example : http://www.yourdomain.com/yourpage.html";
		}	else if ($htype == "1" or $sess_htype == "1")	{
			$htext = "Video";
			$hfile = "vd";
			$hurltext = "YouTube / Share URL :";
			$hurltip = "^ Copy / Paste share video URL from YouTube.";
		}
	}
	
	// List
	if ($p[plist] == "1")	{
		$lwidth = 420;
	}	else if ($p[plist] == "2" or $p[plist] == "3")	{
		$lwidth = 265;
		$lheight = 200;
	}
?>