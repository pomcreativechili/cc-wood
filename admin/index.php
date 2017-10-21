<?php
	session_start();
	$_SESSION['sess_url'] = "http://www.thaweephan.co.th";

	$username = $_POST['username'];
	$password = $_POST['password'];
	$chk = $_POST['chk'];

	if ($chk == "login")	{
		if ($username == "thaweephan" and $password == "twp@admin")	{
			$_SESSION['sess_chkmenu'] = "site";
			$_SESSION['sess_status'] = "0";
			$_SESSION['sess_padmin'] = "";
			header("Location:admin.php"); exit();
		}	else	{
			header("Location:index.php?err=1"); exit();
		}
	}
	
	$err = $_GET['err'];
	if ($err == "1") { $error = "<p class='error'>X &nbsp; Username or Password is incorrect.</p>"; }	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="<?php echo $_SESSION['sess_url'];?>/favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thaweephan | Backend Management System</title>
<link href="<?php echo $_SESSION['sess_url'];?>/admin/css/login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function chklogin()	{
	if (document.form1.username.value == "")	{
		alert("Please fill in a username.");
		document.form1.username.focus();
		return false;
	}
	if (document.form1.password.value == "")	{
		alert("Please fill in a password.");
		document.form1.password.focus();
		return false;
	}
	return true;
}
</script>
</head>

<body>
	<div id="content">
        <div id="header">
            <h1>Thaweephan</h1>
            <h2>Premium Quality Wook. Service Excellence. Since 1955</h2>
            <h2>Refining Nature. Defining Quality.</h2>
        </div>
        <form id="form1" name="form1" method="post" action="<?php echo $_SESSION['sess_url'];?>/admin/index.php" onsubmit="return chklogin();">
        <div id="loginpic"></div>
        <div id="loginform">
            <h2>Login to System</h2>
            <div id="formarea">
                <?php echo $error; ?>
                <p class="formtopic">Username</p>
                <p><input name="username" type="text" class="box" value=""/></p>
                <p class="formtopic">Password</p>
                <p><input name="password" type="password" class="box" value="" /></p>
                <p class="formbutton"><input type="submit" name="Submit" value="Login" class="btlogin" /><input type="reset" name="Reset" value="Reset" class="btreset" /><input name="chk" type="hidden" value="login" /></p>
            </div>
        </div>
        </form>
        <p class="copyright">&copy; 2004 - <?php echo date("Y");?> Thaweephan Wood Products Co., Ltd. All Rights Reserved. Designed &amp; Developed by <a href="http://www.dgzoo.com" target="_blank">Digital Zoo</a>.</p>
	</div>
</body>
</html>
