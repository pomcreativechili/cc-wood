<?php
	include('../../config/chksession.php');
	require_once('../../../Connections/dgz.php');
	
	$pid = $_REQUEST['pid'];
	$cid = $_REQUEST['cid'];
	$pdid = $_REQUEST['pdid'];
	$_SESSION['sess_padmin'] = "site/product/update.php?pid=$pid&cid=$cid&pdid=$pdid";
	
	$chk = $_POST['chk'];
	if ($chk == "1")	{
		$pdurl = preg_replace('/[^a-zA-Z0-9\-]/', '_', $_POST['pdurl']);
		$pdurl = str_replace(" ","_","$pdurl");
		$pdurl = strtolower($pdurl);

		// English
		$pdtitle_en = $_POST['pdtitle_en'];
		$pdtitle_en = str_replace('"',"&quot;","$pdtitle_en");
		$pdtitle_en = str_replace("'","&rsquo;","$pdtitle_en");

		$pddetail_en = $_POST['pddetail_en'];
		$pddetail_en = str_replace('"',"&quot;","$pddetail_en");
		$pddetail_en = str_replace("'","&rsquo;","$pddetail_en");

		// Thai
		$pdtitle_th = $_POST['pdtitle_th'];
		$pdtitle_th = str_replace('"',"&quot;","$pdtitle_th");
		$pdtitle_th = str_replace("'","&rsquo;","$pdtitle_th");

		$pddetail_th = $_POST['pddetail_th'];
		$pddetail_th = str_replace('"',"&quot;","$pddetail_th");
		$pddetail_th = str_replace("'","&rsquo;","$pddetail_th");
		
		$sqlpd = "UPDATE tb_product SET pdurl='$pdurl', pdtitle_en='$pdtitle_en', pdtitle_th='$pdtitle_th', pddetail_en='$pddetail_en', pddetail_th='$pddetail_th' WHERE pid='$pid' AND cid='$cid' AND pdid='$pdid'";
		$resultpd = mysql_query($sqlpd,$dgz);
		if ($resultpd) { print "<meta http-equiv=\"refresh\"content=\"0; URL=update.php?pid=$pid&cid=$cid&pdid=$pdid&err=2\">"; exit(); }
		else { print "<meta http-equiv=\"refresh\"content=\"0; URL=update.php?pid=$pid&cid=$cid&pdid=$pdid&err=1\">"; exit(); }
		
	}	else	{
		// Page Information
		include("../../config/page.info.php");
	
		$sqlc = "select * from tb_category WHERE pid='$pid' AND cid='$cid'";
		$resultc = mysql_query($sqlc, $dgz) or die(mysql_error());
		$c = mysql_fetch_array($resultc);

		$sql = "select * from tb_product WHERE pdid='$pdid' AND pid='$pid' AND cid='$cid'";
		$result = mysql_query($sql, $dgz) or die(mysql_error());
		$rec = mysql_fetch_array($result);
		
		$pdurl = $rec[pdurl];
		$pdtitle_en = $rec[pdtitle_en];
		$pddetail_en = $rec[pddetail_en];
		$pdtitle_th = $rec[pdtitle_th];
		$pddetail_th = $rec[pddetail_th];
		$pdpic = $rec[pdpic];
		$pdposted = $rec[pdposted];
		$pdpath = "../../resources/product";
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
	if (document.form1.pdurl.value == "")	{
		alert("Please fill in URL.");
		document.form1.pdurl.focus();
		return false;
	}
	if (document.form1.pdtitle_en.value == "")	{
		alert("Please fill in title.");
		document.form1.pdtitle_en.focus();
		return false;
	}
	if (document.form1.pdtitle_th.value == "")	{
		alert("Please fill in title.");
		document.form1.pdtitle_th.focus();
		return false;
	}
	return true;
}
</script> 
</head>

<body>
	<?php include("../menu.php");?>
	<p id="nav">
		<a href="../category/update.php?pid=<?php echo $pid;?>&amp;cid=<?php echo $cid;?>&amp;pdid=<?php echo $pdid;?>"><?php echo $c[ctitle_en];?></a> &nbsp;&gt;&nbsp; 
        <a href="index.php?pid=<?php echo $pid;?>&amp;cid=<?php echo $cid;?>">All Products</a> &nbsp;&gt;&nbsp; 
		<strong><?php echo $pdtitle_en;?></strong>
	</p>

	<div id="content">
	<form action="update.php" method="post" name="form1" id="form1" onsubmit="return check();">
		<?php 
			echo $error;
			$pg = "info";
			include("../submenu.php");
		?>
		<h3><img src="../../images/tools/edit.png" alt="" />&nbsp; Update Product</h3>	
		<table cellpadding="0" cellspacing="0" class="contentinfo">
			<tr>
				<td style="padding-top:25px; width:160px;">Page URL :</td>
				<td style="padding-top:25px; width:740px;">
				<?php 
					// URL main page
					$sqlpm = "select * from tb_page WHERE pid='$p[pmp]'";
					$resultpm = mysql_query($sqlpm, $dgz) or die(mysql_error());
					$pm = mysql_fetch_array($resultpm);
					echo $url."/".$pm[purl]."/".$p[purl]."/".$c[curl]."/";
				?>
                <input name="pdurl" type="text" class="box" value="<?php echo $pdurl;?>" size="" style="width:240px;" />
                </td>
			</tr>
            <tr><td class="contenttitle" colspan="2"><img src="../../images/tools/en.jpg" alt="" /> ENGLISH</td></tr>
            <tr>
                <td style="padding-top:25px; width:160px;">Title :</td>
                <td style="padding-top:25px; width:740px;"><input name="pdtitle_en" type="text" class="box" value="<?php echo $pdtitle_en;?>" size="" style="width:700px;" /></td>
            </tr>
            <tr>
                <td>Detail / Info :</td>
                <td><textarea name="pddetail_en" class="box" rows="10" style="width:700px;"><?php echo $pddetail_en;?></textarea><script type="text/javascript">CKEDITOR.replace('pddetail_en');</script></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td class="tip">^ When copying text from anywhere, please ensure you click either the "Paste as plain text" button or "Paste from Word" button. (Which are found at the top of the textarea editor, brown button). This is to ensure no unwanted code will damage the layout structure.</td>
            </tr>
            <tr><td class="contenttitle" colspan="2"><img src="../../images/tools/th.jpg" alt="" /> THAI</td></tr>
            <tr>
                <td style="padding-top:25px; width:160px;">Title :</td>
                <td style="padding-top:25px; width:740px;"><input name="pdtitle_th" type="text" class="box" value="<?php echo $pdtitle_th;?>" size="" style="width:700px;" /></td>
            </tr>
            <tr>
                <td>Detail / Info :</td>
                <td><textarea name="pddetail_th" class="box" rows="10" style="width:700px;"><?php echo $pddetail_th;?></textarea><script type="text/javascript">CKEDITOR.replace('pddetail_th');</script></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td class="tip">^ When copying text from anywhere, please ensure you click either the "Paste as plain text" button or "Paste from Word" button. (Which are found at the top of the textarea editor, brown button). This is to ensure no unwanted code will damage the layout structure.</td>
            </tr>
       		<tr><td class="contenttitle" colspan="2"><img src="../../images/tools/img.jpg" alt="" /> Picture</td></tr>
			<tr>
				<td style="padding-top:25px;">Choose (File) :</td>
				<td style="padding-top:25px;">
				<?php 
					if($pdpic == "") echo "<img src='../../images/tools/pic.png' alt='' />&nbsp; <a href='pic.php?pid=$pid&amp;cid=$cid&amp;pdid=$pdid'>Upload Picture</a>";
					else echo "<a href='$pdpath/".str_replace('th','',"$pdpic")."' class='largepic'><img src='$pdpath/$pdpic' alt=''/></a>&nbsp; <a href='conn/pic.php?pid=$pid&amp;cid=$cid&amp;pdid=$pdid&amp;pdpic=$pdpic' onclick=\"return confirm('Do you want to delete this picture ?')\"'><img src='../../images/tools/del.png' alt='' /></a>";
				?>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">
                ^ 750 x 500 Pixels for picture size <br />
                ^ 2 MB for file size and .JPG, .PNG, GIF for file type
				</td>
			</tr>
			<tr>
				<td>Posted :</td>
				<td><strong><?php echo $pdposted;?></strong></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
                <input type="submit" name="Submit1" value="Update" class="but"/>
                <input type="reset" name="Submit2" value="Reset" class="but"/>
                <input name="chk" type="hidden" value="1" />
                <input name="pid" type="hidden" value="<?php echo $pid;?>" />
                <input name="cid" type="hidden" value="<?php echo $cid;?>" />
                <input name="pdid" type="hidden" value="<?php echo $pdid;?>" />
				</td>
			</tr>
		</table>
	</form>
	</div>
	
</body>
</html>