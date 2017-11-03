<?php
	include('../../config/chksession.php');
	require_once('../../../Connections/dgz.php');
	
	$pid = $_REQUEST['pid'];
	$lid = $_REQUEST['lid'];
	$_SESSION['sess_padmin'] = "site/list/update.php?pid=$pid&lid=$lid";
	$lpath = "../../resources/list";
	
	$chk = $_POST['chk'];
	if ($chk == "1")	{
		$ltype = $_POST['ltype'];
		$lwidth = 750;

		$lurl = preg_replace('/[^a-zA-Z0-9\-]/', '_', $_POST['lurl']);
		$lurl = str_replace(" ","_","$lurl");
		$lurl = strtolower($lurl);

		// English
		$ltopic_en = $_POST['ltopic_en'];
		$ltopic_en = str_replace('"',"&quot;","$ltopic_en");
		$ltopic_en = str_replace("'","&rsquo;","$ltopic_en");

		$lurl = $_POST['lurl'];
		$lurl = preg_replace('/[^a-zA-Z0-9\-]/', '_', $lurl);
		$lurl = str_replace(" ","_","$lurl");
		$lurl = strtolower($lurl);

		$lintro_en = $_POST['lintro_en'];
		$lintro_en = str_replace('"',"&quot;","$lintro_en");
		$lintro_en = str_replace("'","&rsquo;","$lintro_en");

		$ldetail_en = $_POST['ldetail_en'];
		$ldetail_en = str_replace('"',"&quot;","$ldetail_en");
		$ldetail_en = str_replace("'","&rsquo;","$ldetail_en");

		$lbuttext_en =	$_POST['lbuttext_en'];
		$lbuturl_en =	$_POST['lbuturl_en'];

		// Thai
		$ltopic_th = $_POST['ltopic_th'];
		$ltopic_th = str_replace('"',"&quot;","$ltopic_th");
		$ltopic_th = str_replace("'","&rsquo;","$ltopic_th");

		$lintro_th = $_POST['lintro_th'];
		$lintro_th = str_replace('"',"&quot;","$lintro_th");
		$lintro_th = str_replace("'","&rsquo;","$lintro_th");

		$ldetail_th = $_POST['ldetail_th'];
		$ldetail_th = str_replace('"',"&quot;","$ldetail_th");
		$ldetail_th = str_replace("'","&rsquo;","$ldetail_th");

		$lbuttext_th =	$_POST['lbuttext_th'];
		$lbuturl_th =	$_POST['lbuturl_th'];

		// Upload Image
		$lpic = $_FILES['lpic']['tmp_name']; $lpicname = $_FILES['lpic']['name']; 
		if ($lpic != "")	{
			$new = $pid."_".$lid."_".str_replace(" ","_","$lpicname");
			if (is_uploaded_file($lpic)) { copy($lpic,"$lpath/$new"); }
			$ulpic = ", lpic='$new'";

			include("../../config/simpleimage.php");
			$image = new SimpleImage();
			$image->load("$lpath/".$new);
			$image->resizeToWidth($lwidth);
			$image->save("$lpath/".$new);
		}
	
		$sql = "UPDATE tb_list SET lurl='$lurl', ltopic_en='$ltopic_en', ltopic_th='$ltopic_th', lintro_en='$lintro_en', lintro_th='$lintro_th', ldetail_en='$ldetail_en', ldetail_th='$ldetail_th', lbuttext_en='$lbuttext_en', lbuttext_th='$lbuttext_th', lbuturl_en='$lbuturl_en', lbuturl_th='$lbuturl_th'".$ulpic." WHERE pid='$pid' AND lid='$lid' AND ltype='$ltype'";
		$result = mysql_query($sql,$dgz);
		if ($result) { print "<meta http-equiv=\"refresh\"content=\"0; URL=update.php?pid=$pid&lid=$lid&err=2\">"; exit(); }
		else { print "<meta http-equiv=\"refresh\"content=\"0; URL=update.php?pid=$pid&lid=$lid&err=1\">"; exit(); }
		
	}	else	{
		
		// Page Content
		include("../../config/page.info.php");
	
		$sql= "select * from tb_list WHERE lid='$lid' AND pid='$pid' AND ltype='$p[plist]'";
		$result = mysql_query($sql, $dgz) or die(mysql_error());
		$rec = mysql_fetch_array($result);
		
		$ltype			= $rec[ltype];
		$lurl 			= $rec[lurl];
		$ltopic_en		= $rec[ltopic_en];
		$lintro_en		= $rec[lintro_en];
		$ldetail_en		= $rec[ldetail_en];
		$lbuttext_en	= $rec[lbuttext_en];
		$lbuturl_en		= $rec[lbuturl_en];
		$ltopic_th		= $rec[ltopic_th];
		$lintro_th		= $rec[lintro_th];
		$ldetail_th		= $rec[ldetail_th];
		$lbuttext_th	= $rec[lbuttext_th];
		$lbuturl_th		= $rec[lbuturl_th];
		$lpic 			= $rec[lpic];
		$lposted 		= $rec[lposted];
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
	<?php if ($ltype == "3") { ?>
	if (document.form1.lurl.value == "")	{
		alert("Please fill in URL.");
		document.form1.lurl.focus();
		return false;
	}
	<?php } ?>
	if (document.form1.ltopic_en.value == "")	{
		alert("Please fill in topic.");
		document.form1.ltopic_en.focus();
		return false;
	}
	if (document.form1.lbuttext_en.value != "" && document.form1.lbuturl_en.value == "")	{
		alert("Please fill in External URL");
		document.form1.lbuturl_th.focus();
		return false;
	}
	if (document.form1.lbuttext_en.value == "" && document.form1.lbuturl_en.value != "")	{
		alert("Please fill in Button / Text");
		document.form1.lbuttext_en.focus();
		return false;
	}
	if (document.form1.ltopic_th.value == "")	{
		alert("Please fill in topic.");
		document.form1.ltopic_th.focus();
		return false;
	}
	if (document.form1.lbuttext_th.value != "" && document.form1.lbuturl_th.value == "")	{
		alert("Please fill in External URL");
		document.form1.lbuturl_th.focus();
		return false;
	}
	if (document.form1.lbuttext_th.value == "" && document.form1.lbuturl_th.value != "")	{
		alert("Please fill in Button / Text");
		document.form1.lbuttext_th.focus();
		return false;
	}
	return true;
}
</script> 
</head>

<body>
	<?php include("../menu.php");?>
	<p id="nav">
		<a href="../content/update.php?pid=<?php echo $pid;?>"><?php echo $p[ptopic_en];?></a> &nbsp;&gt;&nbsp; 
        <a href="index.php?pid=<?php echo $pid;?>">All Informations</a> &nbsp;&gt;&nbsp; 
		<strong><?php echo $ltopic_en;?></strong>
	</p>

	<div id="content">
	<form action="update.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check();">
		<?php 
			echo $error;
			if ($ltype == "3" or $ltype == "4") {
				$pg = "info";
				include("../submenu.php");
			}
		?>
		<h3><img src="../../images/tools/edit.png" alt="" />&nbsp; Update Information</h3>	
		<table cellpadding="0" cellspacing="0" class="contentinfo">
            <?php if ($ltype == "3") { ?>
			<tr>
				<td style="padding-top:25px; width:160px;">Page URL :</td>
				<td style="padding-top:25px; width:740px;">
				<?php 
					// URL main page
					$sqlpm = "select * from tb_page WHERE pid='$p[pmp]'";
					$resultpm = mysql_query($sqlpm, $dgz) or die(mysql_error());
					$pm = mysql_fetch_array($resultpm);
					echo $url."/".$pm[purl]."/".$p[purl]."/";
				?>
                <input name="lurl" type="text" class="box" value="<?php echo $lurl;?>" size="" style="width:300px;" />
                </td>
			</tr>
            <?php } ?>

        	<tr><td class="contenttitle" colspan="2"><img src="../../images/tools/en.jpg" alt="" /> ENGLISH</td></tr>
			<tr>
				<td style="padding-top:25px; width:160px;">Topic :</td>
				<td style="padding-top:25px; width:740px;"><input name="ltopic_en" type="text" class="box" value="<?php echo $ltopic_en;?>" size="" style="width:700px;" /></td>
			</tr>
			<?php if ($ltype == "2") { ?>
            <tr>
                <td>Detail / Info :</td>
                <td><textarea name="ldetail_en" class="box" rows="7" style="width:700px;"><?php echo $ldetail_en;?></textarea></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td class="tip">^ Any copied text (from Microsoftword or other program) MUST be pasted into "Micosoft Note Pad application" first, then re-copied into the text area editor below. This is to stop uni-code (which is in Word) getting into the system.</td>
            </tr>
            <?php } else { ?>
            <?php if ($ltype == "3") { ?>
			<tr>
				<td>Introduction :</td>
				<td><textarea name="lintro_en" class="box" rows="5" style="width:700px;"><?php echo $lintro_en;?></textarea></td>
			</tr>
            <tr>
                <td>&nbsp;</td>
                <td class="tip">^ Any copied text (from Microsoftword or other program) MUST be pasted into "Micosoft Note Pad application" first, then re-copied into the text area editor below. This is to stop uni-code (which is in Word) getting into the system.</td>
            </tr>
            <?php } ?>
			<tr>
				<td>Detail / Info :</td>
				<td><textarea name="ldetail_en" class="box" rows="10" style="width:700px;"><?php echo $ldetail_en;?></textarea><script type="text/javascript">CKEDITOR.replace('ldetail_en');</script></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">^ When copying text from anywhere, please ensure you click either the "Paste as plain text" button or "Paste from Word" button. (Which are found at the top of the textarea editor, brown button). This is to ensure no unwanted code will damage the layout structure.</td>
			</tr>
            <?php } ?>
            <?php if ($ltype != "3") { ?>
			<tr>
				<td>Button / Text :</td>
				<td><input name="lbuttext_en" type="text" class="box" value="<?php echo $lbuttext_en;?>" size="" style="width:300px;" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">^ This button text will be displayed with link when filled in.</td>
			</tr>
			<tr>
				<td>External or Page URL :</td>
				<td><input name="lbuturl_en" type="text" class="box" value="<?php echo $lbuturl_en;?>" size="" style="width:700px;" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">^ Example : http://www.yourdomain.com/yourpage.html</td>
			</tr>
            <?php } ?>
        	<tr><td class="contenttitle" colspan="2"><img src="../../images/tools/th.jpg" alt="" /> THAI</td></tr>
			<tr>
				<td style="padding-top:25px; width:160px;">Topic :</td>
				<td style="padding-top:25px; width:740px;"><input name="ltopic_th" type="text" class="box" value="<?php echo $ltopic_th;?>" size="" style="width:700px;" /></td>
			</tr>
			<?php if ($ltype == "2") { ?>
            <tr>
                <td>Detail / Info :</td>
                <td><textarea name="ldetail_th" class="box" rows="7" style="width:700px;"><?php echo $ldetail_th;?></textarea></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td class="tip">^ Any copied text (from Microsoftword or other program) MUST be pasted into "Micosoft Note Pad application" first, then re-copied into the text area editor below. This is to stop uni-code (which is in Word) getting into the system.</td>
            </tr>
            <?php } else { ?>
            <?php if ($ltype == "3") { ?>
			<tr>
				<td>Introduction :</td>
				<td><textarea name="lintro_th" class="box" rows="5" style="width:700px;"><?php echo $lintro_th;?></textarea></td>
			</tr>
            <tr>
                <td>&nbsp;</td>
                <td class="tip">^ Any copied text (from Microsoftword or other program) MUST be pasted into "Micosoft Note Pad application" first, then re-copied into the text area editor below. This is to stop uni-code (which is in Word) getting into the system.</td>
            </tr>
            <?php } ?>
			<tr>
				<td>Detail / Info :</td>
				<td><textarea name="ldetail_th" class="box" rows="10" style="width:700px;"><?php echo $ldetail_th;?></textarea><script type="text/javascript">CKEDITOR.replace('ldetail_th');</script></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">^ When copying text from anywhere, please ensure you click either the "Paste as plain text" button or "Paste from Word" button. (Which are found at the top of the textarea editor, brown button). This is to ensure no unwanted code will damage the layout structure.</td>
			</tr>
            <?php } ?>
            <?php if ($ltype != "3") { ?>
			<tr>
				<td>Button / Text :</td>
				<td><input name="lbuttext_th" type="text" class="box" value="<?php echo $lbuttext_th;?>" size="" style="width:300px;" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">^ This text will be displayed with link when filled.</td>
			</tr>
			<tr>
				<td>External or Page URL :</td>
				<td><input name="lbuturl_th" type="text" class="box" value="<?php echo $lbuturl_th;?>" size="" style="width:700px;" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">^ Example : http://www.yourdomain.com/yourpage.html</td>
			</tr>
            <?php } ?>
            <?php if ($pid != '11000') { ?>
        	<tr><td class="contenttitle" colspan="2"><img src="../../images/tools/img.jpg" alt="" /> Picture</td></tr>
			<tr>
				<td style="padding-top:25px;">Choose (File) :</td>
				<td style="padding-top:25px;">
				<?php 
					if($lpic == "")	{
						if ($ltype == "1") echo '<input name="lpic" type="file" class="box" size="" style="width:400px;" />';
						else if ($ltype == "2" or $ltype == "3") echo "<img src='../../images/tools/pic.png' alt='' />&nbsp; <a href='pic.php?pid=$pid&amp;lid=$lid'>Upload Picture</a>";
					}	else	{
						 echo "<img src='$lpath/$lpic' alt=''/>&nbsp; <a href='conn/pic.php?pid=$pid&amp;ltype=$ltype&amp;lid=$lid&amp;lpic=$lpic' onclick=\"return confirm('Do you want to delete this picture ?')\"'><img src='../../images/tools/del.png' alt='' /></a>";
					}
				?>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">
                <?php 
					if ($ltype == "1") echo '^ 750 x 500 Pixels for picture size<br />';
					else if ($ltype == "2" or $ltype == "3") echo '^ 750 x 500 Pixels for picture size<br />';
				?>
                ^ .JPG, .PNG, GIF for file type
				</td>
			</tr>
			<?php } ?>
			<tr>
				<td>Posted :</td>
				<td><strong><?php echo $lposted;?></strong></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
                <input type="submit" name="Submit" value="Update" class="but"/>
                <input type="reset" name="Reset" value="Reset" class="but"/>
                <input name="chk" type="hidden" value="1" />
                <input name="pid" type="hidden" value="<?php echo $pid;?>" />
                <input name="lid" type="hidden" value="<?php echo $lid;?>" />
                <input name="ltype" type="hidden" value="<?php echo $ltype;?>" />
                <input name="lwidth" type="hidden" value="<?php echo $lwidth;?>" />
				</td>
			</tr>
		</table>
	</form>
	</div>
	
</body>
</html>