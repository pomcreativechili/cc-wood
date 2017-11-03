<?php
	include('../../config/chksession.php');
	require_once('../../../Connections/dgz.php');
	
	$pid = $_REQUEST['pid'];
	$_SESSION['sess_padmin'] = "site/list/add.php?pid=$pid";
	$lpath = "../../resources/list";
	
	$chk = $_POST['chk'];
	if ($chk == "1")	{
		$lid = date("ymdHis");
		$ltype = $_POST['ltype'];
		$lwidth = $_POST['lwidth'];
		$lposted = date("Y-m-d H:i:s");

		// English
		$ltopic_en = $_POST['ltopic_en'];
		$ltopic_en = str_replace('"',"&quot;","$ltopic_en");
		$ltopic_en = str_replace("'","&rsquo;","$ltopic_en");

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

			include("../../config/simpleimage.php");
			$image = new SimpleImage();
			$image->load("$lpath/".$new);
			$image->resizeToWidth($lwidth);
			$image->save("$lpath/".$new);
		}
		
		$sql = "INSERT INTO tb_list VALUES ('$lid','$pid','$ltype','','$ltopic_en','$ltopic_th','$lintro_en','$lintro_th','$ldetail_en','$ldetail_th','$lbuttext_en','$lbuttext_th','$lbuturl_en','$lbuturl_th','$new','$lposted','0','0')";
		$result = mysql_query($sql,$dgz);
		if ($result) { print "<meta http-equiv=\"refresh\"content=\"0; URL=index.php?pid=$pid&cid=$cid\">"; exit(); } 
		else { print "<meta http-equiv=\"refresh\"content=\"0; URL=add.php?pid=$pid&cid=$cid&err=1\">"; exit(); } 
	}

	// Page Content
	include("../../config/page.info.php");
	
	$err = $_GET['err'];
	if ($err == "1") $error = "<p class='err'><img src='../../images/tools/err.png' alt='' />&nbsp; ERROR : Can not post new information.</p>";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../css/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function check()	{
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
	<?php if ($pid != '11000') { ?>
	if (document.form1.lpic.value == "")	{
		alert("Please choose a picture");
		document.form1.lpic.focus();
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
		<a href="../content/update.php?pid=<?php echo $pid;?>"><?php echo $p[ptopic_en];?></a> &nbsp;&gt;&nbsp; 
		<a href="index.php?pid=<?php echo $pid;?>">All Informations</a> &nbsp;&gt;&nbsp; 
		<strong>Post new Info</strong>
	</p>
	
	<div id="content">
	<?php echo $error;?>
	<form action="add.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check();">
		<h3><img src="../../images/tools/add.png" alt="" />&nbsp; Post new Information</h3>	
		<table cellpadding="0" cellspacing="0" class="contentinfo">
        	<tr><td class="contenttitle" colspan="2"><img src="../../images/tools/en.jpg" alt="" /> ENGLISH</td></tr>
			<tr>
				<td style="padding-top:25px; width:160px;">Topic :</td>
				<td style="padding-top:25px; width:740px;"><input name="ltopic_en" type="text" class="box" value="" size="" style="width:700px;" /></td>
			</tr>
            <?php if ($p[plist] != "1") { ?>
			<tr>
				<td>Introduction :</td>
				<td><textarea name="lintro_en" class="box" rows="5" style="width:700px;"></textarea></td>
			</tr>
            <?php } ?>
			<tr>
				<td>Detail / Info :</td>
				<td><textarea name="ldetail_en" class="box" rows="10" style="width:700px;"></textarea><script type="text/javascript">CKEDITOR.replace('ldetail_en');</script></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">^ When copying text from anywhere, please ensure you click either the "Paste as plain text" button or "Paste from Word" button. (Which are found at the top of the textarea editor, brown button). This is to ensure no unwanted code will damage the layout structure.</td>
			</tr>
			<tr>
				<td style="padding-top:25px;">Button / Text :</td>
				<td style="padding-top:25px;"><input name="lbuttext_en" type="text" class="box" value="" size="" style="width:300px;" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">^ This text will be displayed with link when filled.</td>
			</tr>
			<tr>
				<td>External or Page URL :</td>
				<td><input name="lbuturl_en" type="text" class="box" value="" size="" style="width:700px;" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">^ Example : http://www.yourdomain.com/yourpage.html</td>
			</tr>
        	<tr><td class="contenttitle" colspan="2"><img src="../../images/tools/th.jpg" alt="" /> THAI</td></tr>
			<tr>
				<td style="padding-top:25px; width:160px;">Topic :</td>
				<td style="padding-top:25px; width:740px;"><input name="ltopic_th" type="text" class="box" value="" size="" style="width:700px;" /></td>
			</tr>
            <?php if ($p[plist] != "1") { ?>
			<tr>
				<td>Introduction :</td>
				<td><textarea name="lintro_th" class="box" rows="5" style="width:700px;"></textarea></td>
			</tr>
            <?php } ?>
			<tr>
				<td>Detail / Info :</td>
				<td><textarea name="ldetail_th" class="box" rows="10" style="width:700px;"></textarea><script type="text/javascript">CKEDITOR.replace('ldetail_th');</script></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">^ When copying text from anywhere, please ensure you click either the "Paste as plain text" button or "Paste from Word" button. (Which are found at the top of the textarea editor, brown button). This is to ensure no unwanted code will damage the layout structure.</td>
			</tr>
			<tr>
				<td>Button / Text :</td>
				<td><input name="lbuttext_th" type="text" class="box" value="" size="" style="width:300px;" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">^ This button text will be displayed with link when filled in.</td>
			</tr>
			<tr>
				<td>External or Page URL :</td>
				<td><input name="lbuturl_th" type="text" class="box" value="" size="" style="width:700px;" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">^ Example : http://www.yourdomain.com/yourpage.html</td>
			</tr>
			<?php if ($pid != '11000') { ?>
        	<tr><td class="contenttitle" colspan="2"><img src="../../images/tools/img.jpg" alt="" /> Picture</td></tr>
			<tr>
				<td style="padding-top:25px;">Choose (File) :</td>
				<td style="padding-top:25px;"><input name="lpic" type="file" class="box" size="" style="width:400px;" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">
				^ <?php echo $lwidth;?> Pixels for width size with any height size<br />
				^ .JPG, .PNG, GIF for file type
				</td>
			</tr>
			<?php } ?>
			<tr>
				<td>&nbsp;</td>
				<td>
                <input type="submit" name="Submit" value="Post" class="but"/>
                <input type="reset" name="Reset" value="Reset" class="but"/>
                <input name="pid" type="hidden" value="<?php echo $pid;?>" />
                <input name="ltype" type="hidden" value="<?php echo $p[plist];?>" />
                <input name="lwidth" type="hidden" value="<?php echo $lwidth;?>" />
                <input name="chk" type="hidden" value="1" />
				</td>
			</tr>
		</table>
	</form>
	</div>
	
</body>
</html>