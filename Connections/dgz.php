<?php
	date_default_timezone_set ("Asia/Bangkok");
	
	$hostname_dgz = "localhost";
	$database_dgz = "site";
	$username_dgz = "dgzoo";
	$password_dgz = "dgzoo.thaweephan";
	$dgz = mysql_connect($hostname_dgz, $username_dgz, $password_dgz) or trigger_error(mysql_error(),E_USER_ERROR); 
	
	mysql_query("SET NAMES 'utf8'");
	mysql_select_db($database_dgz,$dgz);

	$url = "http://www.thaweephan.co.th";
?>