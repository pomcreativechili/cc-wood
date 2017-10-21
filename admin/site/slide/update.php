<?php
	include('../../config/chksession.php');
	require_once('../../../Connections/dgz.php');
	
	$slid = $_REQUEST['slid'];
	$_SESSION['sess_padmin'] = "site/slide/update.php?slid=$slid";
	$slpath = "../../resources/slide";
	
	$chk = $_POST['chk'];
	if ($chk == "1")	{
		$sltext1_en =	$_POST['sltext1_en'];
		$sltext2_en = 	$_POST['sltext2_en'];
		$sltext3_en =	$_POST['sltext3_en'];
		$slurl_en =		$_POST['slurl_en'];
		$sltext1_th =	$_POST['sltext1_th'];
		$sltext2_th = 	$_POST['sltext2_th'];
		$sltext3_th =	$_POST['sltext3_th'];
		$slurl_th =		$_POST['slurl_th'];

		// Upload Image
		$slpic = $_FILES['slpic']['tmp_name']; $slpicname = $_FILES['slpic']['name']; 
		if ($slpic != "")	{
			$new = $slid."_".str_replace(" ","_","$slpicname");
			if (is_uploaded_file($slpic)) { copy($slpic,"$slpath/$new"); }
			$uslpic = ", slpic='$new'";

			include("../../config/simpleimage.php");
			$image = new SimpleImage();
			$image->load("$slpath/".$new);
			$image->resizeToWidth(400);
			$image->save("$slpath/thumb/".$new);
		}
		
		$sqlsl = "UPDATE tb_slide SET sltext1_en='$sltext1_en', sltext1_th='$sltext1_th', sltext2_en='$sltext2_en', sltext2_th='$sltext2_th', sltext3_en='$sltext3_en',sltext3_th='$sltext3_th', slurl_en='$slurl_en', slurl_th='$slurl_th'".$uslpic." WHERE slid='$slid'";
		$resultsl = mysql_query($sqlsl,$dgz);
		if ($resultsl) { print "<meta http-equiv=\"refresh\"content=\"0; URL=update.php?slid=$slid&err=2\">"; exit(); }
		else { print "<meta http-equiv=\"refresh\"content=\"0; URL=update.php?slid=$slid&err=1\">"; exit(); }
		
	}	else	{
		$sql= "select * from tb_slide WHERE slid='$slid'";
		$result = mysql_query($sql, $dgz) or die(mysql_error());
		$rec = mysql_fetch_array($result);

		$sltext1_en = $rec[sltext1_en];
		$sltext2_en = $rec[sltext2_en];
		$sltext3_en = $rec[sltext3_en];
		$slurl_en = $rec[slurl_en];
		$sltext1_th = $rec[sltext1_th];
		$sltext2_th = $rec[sltext2_th];
		$sltext3_th = $rec[sltext3_th];
		$slurl_th = $rec[slurl_th];
		$slpic = $rec[slpic];
		$slposted = $rec[slposted];
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
	if (document.form1.sltext1_en.value == "")	{
		alert("Please fill in Text / Line 1");
		document.form1.sltext1_en.focus();
		return false;
	}
	if (document.form1.sltext2_en.value == "")	{
		alert("Please fill in Text / Line 2");
		document.form1.sltext2_en.focus();
		return false;
	}
	if (document.form1.sltext3_en.value != "" && document.form1.slurl_en.value == "")	{
		alert("Please fill in External URL");
		document.form1.slurl_en.focus();
		return false;
	}
	if (document.form1.sltext3_en.value == "" && document.form1.slurl_en.value != "")	{
		alert("Please fill in Button / Text");
		document.form1.sltext3_en.focus();
		return false;
	}
	if (document.form1.sltext1_th.value == "")	{
		alert("Please fill in Text / Line 1");
		document.form1.sltext1_th.focus();
		return false;
	}
	if (document.form1.sltext2_th.value == "")	{
		alert("Please fill in Text / Line 2");
		document.form1.sltext2_th.focus();
		return false;
	}
	if (document.form1.sltext3_th.value != "" && document.form1.slurl_th.value == "")	{
		alert("Please fill in External URL");
		document.form1.slurl_th.focus();
		return false;
	}
	if (document.form1.sltext3_th.value == "" && document.form1.slurl_th.value != "")	{
		alert("Please fill in Button / Text");
		document.form1.sltext3_th.focus();
		return false;
	}
	return true;
}
</script> 
</head>

<body>
	<?php include("../menu.php");?>
	<p id="nav">
		<a href="index.php">All Pictures</a> &nbsp;&gt;&nbsp; 
		<strong><?php echo $sltext1_en." / ".$sltext2_en;?></strong>
	</p>

	<div id="content">
	<?php echo $error;?>
	<form action="update.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check();">
		<h3><img src="../../images/tools/edit.png" alt="" />&nbsp; Update Slide</h3>	
		<table cellpadding="0" cellspacing="0" class="contentinfo">
        	<tr><td class="contenttitle" colspan="2"><img src="../../images/tools/en.jpg" alt="" /> ENGLISH</td></tr>
			<tr>
				<td style="padding-top:25px; width:160px;">Text / Line 1 :</td>
				<td style="padding-top:25px; width:740px;"><input name="sltext1_en" type="text" class="box" value="<?php echo $sltext1_en;?>" size="" style="width:700px;" /></td>
			</tr>
			<tr>
				<td>Text / Line 2 :</td>
				<td><input name="sltext2_en" type="text" class="box" value="<?php echo $sltext2_en;?>" size="" style="width:700px;" /></td>
			</tr>
            <tr>
                <td>&nbsp;</td>
                <td class="tip">^ Any copied text (from Microsoftword or other program) MUST be pasted into "Micosoft Note Pad application" first, then re-copied into the text area editor below. This is to stop uni-code (which is in Word) getting into the system.</td>
            </tr>
			<tr>
				<td>Button / Text :</td>
				<td><input name="sltext3_en" type="text" class="box" value="<?php echo $sltext3_en;?>" size="" style="width:300px;" /></td>
			</tr>
			<tr>
				<td>External or Page URL :</td>
				<td><input name="slurl_en" type="text" class="box" value="<?php echo $slurl_en;?>" size="" style="width:700px;" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">^ Example : http://www.yourdomain.com/yourpage.html</td>
			</tr>
        	<tr><td class="contenttitle" colspan="2"><img src="../../images/tools/th.jpg" alt="" /> THAI</td></tr>
			<tr>
				<td style="padding-top:25px;">Text / Line 1 :</td>
				<td style="padding-top:25px;"><input name="sltext1_th" type="text" class="box" value="<?php echo $sltext1_th;?>" size="" style="width:700px;" /></td>
			</tr>
			<tr>
				<td>Text / Line 2 :</td>
				<td><input name="sltext2_th" type="text" class="box" value="<?php echo $sltext2_th;?>" size="" style="width:700px;" /></td>
			</tr>
            <tr>
                <td>&nbsp;</td>
                <td class="tip">^ Any copied text (from Microsoftword or other program) MUST be pasted into "Micosoft Note Pad application" first, then re-copied into the text area editor below. This is to stop uni-code (which is in Word) getting into the system.</td>
            </tr>
			<tr>
				<td>Button / Text :</td>
				<td><input name="sltext3_th" type="text" class="box" value="<?php echo $sltext3_th;?>" size="" style="width:300px;" /></td>
			</tr>
			<tr>
				<td>External or Page URL :</td>
				<td><input name="slurl_th" type="text" class="box" value="<?php echo $slurl_th;?>" size="" style="width:700px;" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">^ Example : http://www.yourdomain.com/yourpage.html</td>
			</tr>
        	<tr><td class="contenttitle" colspan="2"><img src="../../images/tools/img.jpg" alt="" /> Picture</td></tr>
			<tr>
				<td style="padding-top:25px;">Choose (File) :</td>
				<td style="padding-top:25px;">
				<?php 
					if($slpic == "") echo '<input name="slpic" type="file" class="box" size="" style="width:400px;" />';
					else echo "<img src='$slpath/thumb/$slpic?".date("YmdHis")."' alt=''/>&nbsp; <a href='conn/pic.php?slid=$slid&amp;slpic=$slpic' onclick=\"return confirm('Do you want to delete this picture ?')\"'><img src='../../images/tools/del.png' alt='' /></a>";
				?>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">
				^ 1680 x 505 Pixels for picture size<br />
				^ .JPG, .PNG, GIF for file type
				</td>
			</tr>
			<tr>
				<td>Posted :</td>
				<td><strong><?php echo $slposted;?></strong></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
                <input type="submit" name="Submit" value="Update" class="but"/>
                <input type="reset" name="Reset" value="Reset" class="but"/>
                <input name="chk" type="hidden" value="1" />
                <input name="slid" type="hidden" value="<?php echo $slid;?>" />
				</td>
			</tr>
		</table>
	</form>
	</div>
	
</body>
</html>
