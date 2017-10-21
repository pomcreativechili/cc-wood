<?php
	include('../../config/chksession.php');
	require_once('../../../Connections/dgz.php');
	
	$nid = $_REQUEST['nid'];
	$chk = $_POST['chk'];
	if ($chk == "1")	{
		$nhdalt = $_POST['nhdalt'];
		$nhdurl = $_POST['nhdurl'];

		$nheader = $_FILES['nheader']['tmp_name'];
		$nheadername = $_FILES['nheader']['name'];
		$hdpath = "resources/pic";

		// Upload Header
		if ($nheader != "")	{
			$new = $nid."_".str_replace(" ","_",$nheadername);
			if (is_uploaded_file($nheader)) copy($nheader,$hdpath."/temp/".$new);
			$anheader = "nheader='$new',";

			include("conn/simpleimage.php");
			$image = new SimpleImage();
			$image->load($hdpath."/temp/".$new);
			$image->resizeToWidth(800);
			$image->save($hdpath."/".$new);
			unlink($hdpath."/temp/".$new);
		}
		
		$sqluhd = "UPDATE tb_newsletter_info SET ".$anheader." nhdalt='$nhdalt', nhdurl='$nhdurl' WHERE nid='$nid'";
		$resultuhd = mysql_query($sqluhd,$dgz);
		if ($resultuhd) { print "<meta http-equiv=\"refresh\"content=\"0; URL=header.php?nid=$nid&err=1\">"; exit(); } 
		else { print "<meta http-equiv=\"refresh\"content=\"0; URL=header.php?nid=$nid&err=2\">"; exit(); } 

	}

	$sqlhd= "select * from tb_newsletter_info WHERE nid='$nid'";
	$resulthd = mysql_query($sqlhd, $dgz) or die(mysql_error());
	$hd = mysql_fetch_array($resulthd);
	
	$nheader = $hd[nheader];
	$nhdalt = $hd[nhdalt];
	$nhdurl = $hd[nhdurl];

	$err = $_GET['err'];
	if ($err == "1") $error = "<p class='success'><img src='resources/images/success.png' alt='' />&nbsp; Update information successfully. Click <a href='template.php?nid=$nid' target='admin'>here</a> to refresh page.</p>";
	else if ($err == "2") $error = "<p class='err'><img src='resources/images/err.png' alt='' />&nbsp; ERROR : Can not update this header.</p>";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../css/default.css" rel="stylesheet" type="text/css" />
<link href="../../css/newsletter.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<?php if ($nheader == "") { ?>
function check()	{
	if(document.form1.nheader.value == "")	{
		alert("Please choose a picture");
		document.form1.nheader.focus();
		return false;
	}
	return true;
}
<?php } ?>

function gotourl() { window.location = "conn/delheader.php?nid=<?php echo $nid;?>&nheader=<?php echo $nheader;?>"; }
</script>
</head>

<body>
	<div id="popuparea">
	<form action="header.php" method="post" enctype="multipart/form-data" name="form1" id="form1" <?php if ($nheader == "") { ?>onsubmit="return check();"<?php } ?>>
		<?php echo $error;?>
		<h3><img src="resources/images/edit.png" alt="" />&nbsp; Update Header</h3>	
		<table cellpadding="0" cellspacing="0" class="popuptable">
			<?php if ($nheader == "") { ?>				
			<tr>
				<td style="width:180px; padding-top:25px; font-size:14px;">Upload Picture (File) : </td>
				<td style="width:360px; padding-top:25px; font-size:14px;"><input name="nheader" type="file" class="box" size="" style="width:300px; font-size:14px;" /></td>
			</tr>
			<?php } else { ?>
			<tr>
				<td style="width:180px; padding-top:25px; font-size:14px;">Picture (File) : </td>
				<td style="width:360px; padding-top:25px; font-size:14px;"><img src="resources/images/pic.png" alt="" /> <?php echo $nheader;?></td>
			</tr>
			<?php } ?>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">^ 800 Pixels for width size, and .JPG, .PNG for file type.</td>
			</tr>
			<tr>
				<td>Text - Alt :</td>
				<td><input name="nhdalt" type="text" class="box" value="<?php echo $nhdalt;?>" size="" style="width:300px;" /></td>
			</tr>
			<tr>
				<td>Link (URL) :</td>
				<td><input name="nhdurl" type="text" class="box" value="<?php echo $nhdurl;?>" size="" style="width:300px;" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">
				<?php if ($nhdurl != "") echo "^ Click <a href='$nhdurl' target='_blank'>here</a> to view the website<br/>";?>
				^ Example : http://www.yourdomain.com/yourpage.html
				</td>
			</tr>
			<tr>
				<td colspan="2">
                <input type="submit" name="Submit1" value="Update" class="but"/>
                <input type="reset" name="Submit2" value="Reset" class="but"/>
                <?php if ($nheader != "") echo '<input type="reset" name="Submit2" value="Delete this Header" onclick="gotourl();" class="butclear"/>';?>
                <input name="chk" type="hidden" value="1" />
                <input name="nid" type="hidden" value="<?php echo $nid;?>" />
				</td>
			</tr>
		</table>
	</form>
	</div>
</body>
</html>
