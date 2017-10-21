<?php
	session_start();
	require_once("../../../../Connections/dgz.php");

	$gpage = $_SESSION['sess_gpage'];
	$pid = $_SESSION['sess_pid'];
	$pdid = $_SESSION['sess_pdid'];
	$gtype = $_SESSION['sess_gtype'];
	$pic = $_GET['pic'];
	
	if ($pic != "")	{ 
		if ($gtype == "0") unlink("../../../resources/home/gallery/$pic");
		else if ($gtype == "1" or $gtype == "2") unlink("../../../resources/pages/gallery/$pic");
		else if ($gtype == "3") unlink("../../../resources/list/gallery/$pic");
		else if ($gtype == "4") unlink("../../../resources/work/gallery/$pic");
		else if ($gtype == "5") unlink("../../../resources/product/gallery/$pic");
	}

	$_SESSION['sess_gpage']= "";
	$_SESSION['sess_pid']= "";
	$_SESSION['sess_pdid']= "";
	$_SESSION['sess_gtype']= "";
	$_SESSION['sess_gid']= "";
	$_SESSION['sess_galt_en']= "";
	$_SESSION['sess_galt_th']= "";
	$_SESSION['random_key']= "";
	$_SESSION['user_file_ext']= "";
	header("Location:../add.php?pid=$pid&gtype=$gtype&gpage=$gpage&pdid=$pdid");
?>