<?php
	include("config/chksession.php");
	if ($_SESSION['sess_padmin'] == "") $sess_padmin = "site/content/index.php";
	else $sess_padmin = $_SESSION['sess_padmin'];
?>

<html>
<head>
<link rel="shortcut icon" href="<?php echo $sess_url;?>/favicon.ico" />
<title>Thaweephan | Backend Management System</title>
</head>

<frameset rows = "37,*" framespacing="0" frameborder="0">
	<frame src = "menu.php" noresize marginheight="0" marginwidth="0" scrolling="no">
	<frame src = "<?php echo $sess_padmin; ?>" noresize marginheight="0" marginwidth="0" scrolling="yes" name="admin">
</frameset><noframes></noframes>
</html>