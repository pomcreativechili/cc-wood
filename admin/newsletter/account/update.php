<?php
	include('../../config/chksession.php');
	require_once('../../../Connections/dgz.php');
	
	$egid = $_REQUEST['egid'];
	$emid = $_REQUEST['emid'];
	$_SESSION['sess_padmin'] = "email/account/update.php?egid=$egid&emid=$emid";
	
	$chk = $_POST['chk'];
	if ($chk == "1")	{
		$emname = $_POST['emname'];
		$ememail = $_POST['ememail'];

		$sqlem = "UPDATE tb_email_account SET emname='$emname', ememail='$ememail' WHERE egid='$egid' AND emid='$emid'";
		$resultem = mysql_query($sqlem,$dgz);
		if ($resultem) { print "<meta http-equiv=\"refresh\"content=\"0; URL=update.php?egid=$egid&emid=$emid&err=2\">"; exit(); }
		else { print "<meta http-equiv=\"refresh\"content=\"0; URL=update.php?egid=$egid&emid=$emid&err=1\">"; exit(); }
		
	}	else	{
		$sqleg = "select * from tb_email_group WHERE egid='$egid'";
		$resulteg = mysql_query($sqleg, $dgz) or die(mysql_error());
		$eg = mysql_fetch_array($resulteg);

		$sqlem = "select * from tb_email_account WHERE egid='$egid' AND emid='$emid'";
		$resultem = mysql_query($sqlem, $dgz) or die(mysql_error());
		$em = mysql_fetch_array($resultem);

		$emname = $em[emname];
		$ememail = $em[ememail];
	}

	$err = $_GET['err'];
	if ($err == "1") $error = "<p class='err'><img src='../../images/tools/err.png' alt='' />&nbsp; ERROR : Can not update information.</p>";
	else if ($err == "2") $error = "<p class='success''><img src='../../images/tools/success.png' alt='' />&nbsp; Update information successfully.</p>";	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../css/default.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<p id="nav">
    	<a href="../group/update.php?egid=<?php echo $egid;?>"><?php echo $eg[egtitle];?></a> &nbsp;&gt;&nbsp; 
    	<a href="index.php?egid=<?php echo $egid;?>">All Accounts</a> &nbsp;&gt;&nbsp; 
		<strong><?php echo $emname;?></strong>
    </p>

	<div id="content">
	<form action="update.php" method="post" name="form1" id="form1">
		<?php echo $error; ?>
		<h3><img src="../../images/tools/edit.png" alt="" />&nbsp; Update Account</h3>	
		<table cellpadding="0" cellspacing="0" class="contentinfo">
			<tr>
				<td style="padding-top:25px; width:160px;">Name :</td>
				<td style="padding-top:25px; width:740px;"><input name="emname" type="text" class="box" value="<?php echo $emname;?>" style="width:700px;" /></td>
			</tr>
			<tr>
				<td>Email Address :</td>
				<td><input name="ememail" type="text" class="box" value="<?php echo $ememail;?>" style="width:700px;" /></td>
			</tr>
            <tr>
                <td>&nbsp;</td>
                <td class="tip">^ Any copied text (from Microsoftword or other program) MUST be pasted into "Micosoft Note Pad application" first, then re-copied into the text area editor below. This is to stop uni-code (which is in Word) getting into the system.</td>
            </tr>
			<tr>
				<td>Posted :</td>
                <td><strong><?php echo $em[emdate];?></strong></td>
            </tr>
			<tr>
				<td>&nbsp;</td>
				<td>
                <input type="submit" name="Submit1" value="Update" class="but"/>
                <input type="reset" name="Submit2" value="Reset" class="but"/>
                <input name="chk" type="hidden" value="1" />
                <input name="egid" type="hidden" value="<?php echo $egid;?>" />
                <input name="emid" type="hidden" value="<?php echo $emid;?>" />
				</td>
			</tr>
		</table>
	</form>
	</div>
	
</body>
</html>
