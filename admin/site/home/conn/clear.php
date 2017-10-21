<?php
	session_start();
	
	$htype = $_SESSION['sess_htype'];
	$hid = $_SESSION['sess_hid'];
	$pic = $_GET['pic'];
	$path = "../../../resources/home";
	if ($pic != "") unlink("$path/$pic");

	$_SESSION['sess_hlid'] = "";
	$_SESSION['sess_htype'] = "";
	$_SESSION['random_key']= "";
	$_SESSION['user_file_ext']= "";
	header("Location:../update.php?htype=$htype&hid=$hid");
?>