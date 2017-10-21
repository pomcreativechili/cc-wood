<?php
	include('../../config/chksession.php');
	require_once('../../../Connections/dgz.php');
	$_SESSION['sess_padmin'] = "newsletter/group/add.php";

	$chk = $_POST['chk'];
	if ($chk == "1")	{
		$egid = date("ymdHis");
		$egdate = date("Y-m-d H:i:s");

		$egtitle = $_POST['egtitle'];
		$egtitle = str_replace('"',"&quot;","$egtitle");
		$egtitle = str_replace("'","&rsquo;","$egtitle");

		$sqleg = "INSERT INTO tb_email_group VALUES ('$egid','$egtitle','$egdate','0')";
		$resulteg = mysql_query($sqleg,$dgz);
		if ($resulteg) { print "<meta http-equiv=\"refresh\"content=\"0; URL=index.php\">"; exit(); } 
		else { print "<meta http-equiv=\"refresh\"content=\"0; URL=add.php?err=1\">"; exit(); } 
	}

	$err = $_GET['err'];
	if ($err == "1") $error = "<p class='err'><img src='../../images/tools/err.png' alt='' />&nbsp; ERROR : Can not add new group.</p>";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../css/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function check()	{
	if (document.form1.egtitle.value == "")	{
		alert("Please fill in title");
		document.form1.egtitle.focus();
		return false;
	}
	return true;
}
</script> 
</head>

<body>
	<p id="nav">
		<a href="index.php">All Groups</a> &nbsp;&gt;&nbsp; 
		<strong>Add new Group</strong>
	</p>
	
	<div id="content">
	<?php echo $error;?>
	<form action="add.php" method="post" name="form1" id="form1" onsubmit="return check();">
		<h3><img src="../../images/tools/add.png" alt="" />&nbsp; Add new Group</h3>	
		<table cellpadding="0" cellspacing="0" class="contentinfo">
			<tr>
				<td style="padding-top:25px; width:160px;">Title :</td>
				<td style="padding-top:25px; width:740px;"><input name="egtitle" type="text" class="box" value="" style="width:700px;" /></td>
			</tr>
            <tr>
                <td>&nbsp;</td>
                <td class="tip">^ Any copied text (from Microsoftword or other program) MUST be pasted into "Micosoft Note Pad application" first, then re-copied into the text area editor below. This is to stop uni-code (which is in Word) getting into the system.</td>
            </tr>
			<tr>
				<td>&nbsp;</td>
				<td>
                <input type="submit" name="Submit" value="Add" class="but"/>
                <input type="reset" name="Reset" value="Reset" class="but"/>
                <input name="chk" type="hidden" value="1" />
				</td>
			</tr>
		</table>
	</form>
	</div>
</body>
</html>