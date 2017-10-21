<?php
	session_start();
	
	$pid = $_SESSION['sess_pid'];
	$cid = $_SESSION['sess_cid'];
	$pdid = $_SESSION['sess_pdid'];
	$pic = $_GET['pic'];
	$pdpath = "../../../resources/product";
	if ($pic != "") unlink("$pdpath/$pic");

	$_SESSION['sess_pid'] = "";
	$_SESSION['sess_cid'] = "";
	$_SESSION['sess_pdid'] = "";
	$_SESSION['random_key']= "";
	$_SESSION['user_file_ext']= "";
	header("Location:../update.php?pid=$pid&cid=$cid&pdid=$pdid");
?>