<?php
	include('../../config/chksession.php');
	require_once('../../../Connections/dgz.php');
	
	$nid = $_REQUEST['nid'];
	$chk = $_POST['chk'];
	if ($chk == "1")	{
		$ngid = $nid."".date("ymdHis");
		$ngalt = $_POST['ngalt'];
		$ngurl = $_POST['ngurl'];

		$ngpic = $_FILES['ngpic']['tmp_name'];
		$ngpicname = $_FILES['ngpic']['name'];
		$ngpath = "resources/gallery";

		// Upload Header
		if ($ngpic != "")	{
			$new = $ngid."_".str_replace(" ","_",$ngpicname);
			if (is_uploaded_file($ngpic)) copy($ngpic,$ngpath."/temp/".$new);
			
			include("conn/simpleimage.php");
			$image = new SimpleImage();
			$image->load($ngpath."/temp/".$new);
			$image->resizeToWidth(212);
			$image->save($ngpath."/".$new);
			unlink($ngpath."/temp/".$new);
		}
		
		$sqlng = "INSERT INTO tb_newsletter_gallery VALUES ('$ngid','$nid','$new','$ngalt','$ngurl','0')";
		$resultng = mysql_query($sqlng,$dgz);
		if ($resultng) { print "<meta http-equiv=\"refresh\"content=\"0; URL=gallery.php?nid=$nid&err=1\">"; exit(); } 
		else { print "<meta http-equiv=\"refresh\"content=\"0; URL=gallery.php?nid=$nid&err=2\">"; exit(); } 
	}

	$err = $_GET['err'];
	if ($err == "1") $error = "<p class='success''><img src='resources/images/success.png' alt='' />&nbsp; Post new picture successfully. Click <a href='template.php?nid=$nid' target='admin'>here</a> to refresh page.</p>";
	else if ($err == "2") $error = "<p class='err'><img src='resources/images/err.png' alt='' />&nbsp; ERROR : Can not post new picture.</p>";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../css/default.css" rel="stylesheet" type="text/css" />
<link href="../../css/newsletter.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function check()	{
	if(document.form1.ngpic.value == "")	{
		alert("Please choose a picture");
		document.form1.ngpic.focus();
		return false;
	}
	return true;
}
</script>
</head>

<body>
	<div id="popuparea">
	<form action="gallery.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check();">
		<?php echo $error;?>
		<h3><img src="resources/images/add.png" alt="" />&nbsp; Post new Picture</h3>	
		<table cellpadding="0" cellspacing="0" class="popuptable">
			<tr>
				<td style="width:160px; padding-top:25px; font-size:14px;">Picture (File) : </td>
				<td style="width:380px; padding-top:25px; font-size:14px;"><input name="ngpic" type="file" class="box" size="" style="width:320px; font-size:14px;" /> *</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">^ 212 Pixels for width size, and .JPG, .PNG, GIF for file type.</td>
			</tr>
			<tr>
				<td>Text - Alt :</td>
				<td><input name="ngalt" type="text" class="box" value="" size="" style="width:320px;" /></td>
			</tr>
			<tr>
				<td>Link (URL) :</td>
				<td><input name="ngurl" type="text" class="box" value="" size="" style="width:320px;" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">^ Example : http://www.yourdomain.com/yourpage.html</td>
			</tr>
			<tr>
				<td colspan="2">
                <input type="submit" name="Submit1" value="Post" class="but"/>
                <input type="reset" name="Submit2" value="Reset" class="but"/>
                <input name="chk" type="hidden" value="1" />
                <input name="nid" type="hidden" value="<?php echo $nid;?>" />
				</td>
			</tr>
		</table>
	</form>
	</div>
</body>
</html>
