<?php
	session_start();
	$sess_url = $_SESSION['sess_url'];
	session_destroy();
	header("Location:".$sess_url."/tp-admin");
	exit();
?>