<?php
	session_start();
	
	$wid = $_SESSION['sess_wid'];
	$pic = $_GET['pic'];
	$wpath = "../../../resources/work";
	if ($pic != "") unlink("$wpath/$pic");

	$_SESSION['sess_wid'] = "";
	$_SESSION['random_key']= "";
	$_SESSION['user_file_ext']= "";
	header("Location:../update.php?wid=$wid");
?>