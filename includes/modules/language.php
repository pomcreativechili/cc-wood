<?php
	$lg = $_GET['lg'];
	
	if ($lg == "") $sess_lg = "_en";
	else $sess_lg = "_".$lg;

	// Language for URL
	if ($sess_lg == "_th") $lgurl = "/th";
	else $lgurl = "";
	
	// Gallery
	$galt = "galt".$sess_lg;
?>