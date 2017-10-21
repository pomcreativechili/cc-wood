<?php
	session_start();
	
	// Record new parameter when change main menu
	$chkmenu = $_GET['chkmenu'];
	if ($chkmenu != "") $_SESSION['sess_chkmenu'] = $chkmenu;
	
	// Check login session
	$sess_status = $_SESSION['sess_status'];
	$sess_url = $_SESSION['sess_url'];
	if ($sess_status == "")	{
		header("Location:".$sess_url."/tp-admin"); exit();
	}
?>