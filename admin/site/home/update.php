<?php
	include('../../config/chksession.php');
	require_once('../../../Connections/dgz.php');
	
	$htype = $_REQUEST['htype'];
	$hid = $_REQUEST['hid'];
	$_SESSION['sess_padmin'] = "site/home/update.php?htype=$htype&hid=$hid";
	
	$chk = $_POST['chk'];
	if ($chk == "1")	{
		$htitle_en = $_POST['htitle_en'];
		$hdetail_en = $_POST['hdetail_en'];
		$hdetail_en = str_replace('"',"&quot;","$hdetail_en");
		$hdetail_en = str_replace("'","&rsquo;","$hdetail_en");
		$hurl_en = $_POST['hurl_en'];

		$htitle_th = $_POST['htitle_th'];
		$hdetail_th = $_POST['hdetail_th'];
		$hdetail_th = str_replace('"',"&quot;","$hdetail_th");
		$hdetail_th = str_replace("'","&rsquo;","$hdetail_th");
		$hurl_th = $_POST['hurl_th'];

		$sqlh = "UPDATE tb_home SET htitle_en='$htitle_en', htitle_th='$htitle_th', hdetail_en='$hdetail_en', hdetail_th='$hdetail_th', hurl_en='$hurl_en', hurl_th='$hurl_th' WHERE hid='$hid' AND htype='$htype'";
		$resulth = mysql_query($sqlh,$dgz);
		if ($resulth) { print "<meta http-equiv=\"refresh\"content=\"0; URL=update.php?htype=$htype&hid=$hid&err=2\">"; exit(); }
		else { print "<meta http-equiv=\"refresh\"content=\"0; URL=update.php?htype=$htype&hid=$hid&err=1\">"; exit(); }
		
	}	else	{
		$sql = "select * from tb_home WHERE hid='$hid' AND htype='$htype'";
		$result = mysql_query($sql, $dgz) or die(mysql_error());
		$rec = mysql_fetch_array($result);

		$htitle_en = $rec[htitle_en];
		$htitle_th = $rec[htitle_th];
		$hdetail_en = $rec[hdetail_en];
		$hdetail_th = $rec[hdetail_th];
		$hurl_en = $rec[hurl_en];
		$hurl_th = $rec[hurl_th];
		$hpic = $rec[hpic];
		$hposted = $rec[hposted];
		$hpath = "../../resources/home";

		// Page Information
		$pid = "0000";
		include("../../config/page.info.php");
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
<script type="text/javascript">
function check()	{
	if (document.form1.htitle_en.value == "")	{
		alert("Please fill in title");
		document.form1.htitle_en.focus();
		return false;
	}
	if (document.form1.hdetail_en.value == "")	{
		alert("Please fill in detail / info");
		document.form1.hdetail_en.focus();
		return false;
	}
	<?php if ($htype == "1") { ?>
	if (document.form1.hurl_en.value == "")	{
		alert("Please fill in URL");
		document.form1.hurl_en.focus();
		return false;
	}
	<?php } ?>
	if (document.form1.htitle_th.value == "")	{
		alert("Please fill in title");
		document.form1.htitle_th.focus();
		return false;
	}
	if (document.form1.hdetail_th.value == "")	{
		alert("Please fill in detail / info");
		document.form1.hdetail_th.focus();
		return false;
	}
	<?php if ($htype == "1") { ?>
	if (document.form1.hurl_th.value == "")	{
		alert("Please fill in URL");
		document.form1.hurl_th.focus();
		return false;
	}
	<?php } ?>
	return true;
}
</script> 
</head>

<body>
	<?php include("../menu.php");?>
	<p id="nav">
        <a href="index.php?htype=<?php echo $htype;?>">All <?php echo $htext;?>s</a> &nbsp;&gt;&nbsp; 
		<strong><?php echo $htitle_en;?></strong>
	</p>

	<div id="content">
	<?php echo $error;?>
	<form action="update.php" method="post" name="form1" id="form1" onsubmit="return check();">
		<h3><img src="../../images/tools/edit.png" alt="" />&nbsp; Update <?php echo $htext;?></h3>	
		<table cellpadding="0" cellspacing="0" class="contentinfo">
        	<tr><td class="contenttitle" colspan="2"><img src="../../images/tools/en.jpg" alt="" /> ENGLISH</td></tr>
			<tr>
				<td style="padding-top:25px; width:160px;">Title :</td>
				<td style="padding-top:25px; width:740px;"><input name="htitle_en" type="text" class="box" value="<?php echo $htitle_en;?>" size="" style="width:700px;" /></td>
			</tr>
            <tr>
				<td>Detail / Info :</td>
                <td><textarea name="hdetail_en" class="box" rows="4" style="width:700px;"><?php echo $hdetail_en;?></textarea></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td class="tip">^ Any copied text (from Microsoftword or other program) MUST be pasted into "Micosoft Note Pad application" first, then re-copied into the text area editor below. This is to stop uni-code (which is in Word) getting into the system.</td>
            </tr>
            <tr>
                <td><?php echo $hurltext;?></td>
                <td><input name="hurl_en" type="text" class="box" value="<?php echo $hurl_en;?>" size="" style="width:700px;" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td class="tip"><?php echo $hurltip;?></td>
            </tr>
        	<tr><td class="contenttitle" colspan="2"><img src="../../images/tools/th.jpg" alt="" /> THAI</td></tr>
			<tr>
				<td style="padding-top:25px; width:160px;">Title :</td>
				<td style="padding-top:25px; width:740px;"><input name="htitle_th" type="text" class="box" value="<?php echo $htitle_th;?>" size="" style="width:700px;" /></td>
			</tr>
            <tr>
				<td>Detail / Info :</td>
                <td><textarea name="hdetail_th" class="box" rows="5" style="width:700px;"><?php echo $hdetail_th;?></textarea></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td class="tip">^ Any copied text (from Microsoftword or other program) MUST be pasted into "Micosoft Note Pad application" first, then re-copied into the text area editor below. This is to stop uni-code (which is in Word) getting into the system.</td>
            </tr>
            <tr>
                <td><?php echo $hurltext;?></td>
                <td><input name="hurl_th" type="text" class="box" value="<?php echo $hurl_th;?>" size="" style="width:700px;" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td class="tip"><?php echo $hurltip;?></td>
            </tr>
       		<tr><td class="contenttitle" colspan="2"><img src="../../images/tools/img.jpg" alt="" /> Picture</td></tr>
			<tr>
				<td style="padding-top:25px;">Choose (File) :</td>
				<td style="padding-top:25px;">
				<?php 
					if($hpic == "") echo "<img src='../../images/tools/pic.png' alt='' />&nbsp; <a href='pic.php?htype=$htype&amp;hid=$hid'>Upload Picture</a>";
					else echo "<img src='$hpath/$hpic?".date('YmdHis')." alt=''/>&nbsp; <a href='conn/pic.php?htype=$htype&amp;hid=$hid&amp;hpic=$hpic' onclick=\"return confirm('Do you want to delete this picture ?')\"'><img src='../../images/tools/del.png' alt='' /></a>";
				?>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">
                ^ 600 Pixels for maximum of width size (124 x 124 Pixels for Thumbnail size)<br />
                ^ 1 MB for file size and .JPG, .PNG, GIF for file type
				</td>
			</tr>
			<tr>
				<td>Posted :</td>
				<td><strong><?php echo $hposted;?></strong></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
                <input type="submit" name="Submit" value="Update" class="but"/>
                <input type="reset" name="Reset" value="Reset" class="but"/>
                <input name="chk" type="hidden" value="1" />
                <input name="htype" type="hidden" value="<?php echo $htype;?>" />
                <input name="hid" type="hidden" value="<?php echo $hid;?>" />
				</td>
			</tr>
		</table>
	</form>
	</div>
	
</body>
</html>