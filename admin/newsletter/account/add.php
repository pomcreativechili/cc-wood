<?php
	include('../../config/chksession.php');
	require_once('../../../Connections/dgz.php');
	
	$egid = $_REQUEST['egid'];
	$_SESSION['sess_padmin'] = "email/account/add.php?egid=$egid";

	$chk = $_POST['chk'];
	if ($chk == "1")	{
		$emid = date("ymdHis");
		$emname = $_POST['emname'];
		$ememail = $_POST['ememail'];
		$emposted = date("Y-m-d H:i:s");

		$sqlem = "INSERT INTO tb_email_account VALUES ('$emid','','$egid','$emname','$ememail','$emposted','1')";
		$resultem = mysql_query($sqlem,$dgz);
		if ($resultem) { print "<meta http-equiv=\"refresh\"content=\"0; URL=index.php?egid=$egid\">"; exit(); } 
		else { print "<meta http-equiv=\"refresh\"content=\"0; URL=add.php?egid=$egid&err=1\">"; exit(); } 
	}

	$sqleg = "select * from tb_email_group WHERE egid='$egid'";
	$resulteg = mysql_query($sqleg, $dgz) or die(mysql_error());
	$eg = mysql_fetch_array($resulteg);
	
	$err = $_GET['err'];
	if ($err == "1") $error = "<p class='err'><img src='../../../images/tools/err.png' alt='' />&nbsp; ERROR : Can not add new account.</p>";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../css/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function check()	{
	if (document.form1.emname.value == "")	{
		alert("Please fill in name");
		document.form1.emname.focus();
		return false;
	}
	if(document.form1.ememail.value != "")	{
		var str=document.form1.ememail.value;
		var filter=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;	
		if (!filter.test(str))	{
			alert("Please fill in correctly style of email address");
			document.form1.ememail.select();
			return false;
		}
	}	else	{
		alert("Please fill in email address");
		document.form1.ememail.select();
		return false;
	}
	return true;
}
</script> 
</head>

<body>
	<p id="nav">
    	<a href="../group/update.php?egid=<?php echo $egid;?>"><?php echo $eg[egtitle];?></a> &nbsp;&gt;&nbsp; 
    	<a href="index.php?egid=<?php echo $egid;?>">All Accounts</a> &nbsp;&gt;&nbsp; 
		<strong>Add new Account</strong>
	</p>
	
	<div id="content">
		<?php echo $error;?>
        <form action="add.php" method="post" name="form1" id="form1" onsubmit="return check();">
		<h3><img src="../../images/tools/add.png" alt="" />&nbsp; Add new Account</h3>	
		<table cellpadding="0" cellspacing="0" class="contentinfo">
			<tr>
				<td style="padding-top:25px; width:160px;">Name :</td>
				<td style="padding-top:25px; width:740px;"><input name="emname" type="text" class="box" value="" style="width:700px;" /></td>
			</tr>
			<tr>
				<td>Email Address :</td>
				<td><input name="ememail" type="text" class="box" value="" style="width:700px;" /></td>
			</tr>
            <tr>
                <td>&nbsp;</td>
                <td class="tip">^ Any copied text (from Microsoftword or other program) MUST be pasted into "Micosoft Note Pad application" first, then re-copied into the text area editor below. This is to stop uni-code (which is in Word) getting into the system.</td>
            </tr>
			<tr>
				<td>&nbsp;</td>
				<td>
                <input type="submit" name="Submit1" value="Add" class="but"/>
                <input type="reset" name="Submit2" value="Reset" class="but"/>
                <input name="chk" type="hidden" value="1" />
                <input name="egid" type="hidden" value="<?php echo $egid;?>" />
				</td>
			</tr>
		</table>
        </form>
	</div>
	
</body>
</html>