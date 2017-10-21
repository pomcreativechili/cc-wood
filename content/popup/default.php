<?php
	require_once("../../Connections/dgz.php");
	include("../../includes/modules/language.php");
	include("../../includes/content/info.php");
	
	if ($spid == "0001") 		include("contact.php");
	else if ($spid == "0002")	include("subscribe.php");
?>