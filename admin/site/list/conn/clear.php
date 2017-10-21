<?php
	session_start();
	
	$pid = $_SESSION['sess_pid'];
	$lid = $_SESSION['sess_lid'];
	$pic = $_GET['pic'];
	$lpath = "../../../resources/list";
	if ($pic != "") unlink("$lpath/$pic");

	$_SESSION['sess_pid'] = "";
	$_SESSION['sess_lid'] = "";
	$_SESSION['sess_ltype'] = "";
	$_SESSION['random_key']= "";
	$_SESSION['user_file_ext']= "";
	header("Location:../update.php?pid=$pid&lid=$lid");
?>