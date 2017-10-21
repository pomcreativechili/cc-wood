<?php
	include('../../config/chksession.php');
	require_once('../../../Connections/dgz.php');
	
	$cid = $_REQUEST['cid'];
	$pid = $_REQUEST['pid'];
	$_SESSION['sess_padmin'] = "site/category/update.php?pid=$pid&cid=$cid";
	
	$chk = $_POST['chk'];
	if ($chk == "1")	{
		$curl = preg_replace('/[^a-zA-Z0-9\-]/', '_', $_POST['curl']);
		$curl = str_replace(" ","_","$curl");
		$curl = strtolower($curl);
		
		// English
		$ctitle_en = $_POST['ctitle_en'];
		$ctitle_en = str_replace('"',"&quot;","$ctitle_en");
		$ctitle_en = str_replace("'","&rsquo;","$ctitle_en");

		$cdetail_en = $_POST['cdetail_en'];
		$cdetail_en = str_replace('"',"&quot;","$cdetail_en");
		$cdetail_en = str_replace("'","&rsquo;","$cdetail_en");

		// Thai
		$ctitle_th = $_POST['ctitle_th'];
		$ctitle_th = str_replace('"',"&quot;","$ctitle_th");
		$ctitle_th = str_replace("'","&rsquo;","$ctitle_th");

		$cdetail_th = $_POST['cdetail_th'];
		$cdetail_th = str_replace('"',"&quot;","$cdetail_th");
		$cdetail_th = str_replace("'","&rsquo;","$cdetail_th");

		$sql = "UPDATE tb_category SET curl='$curl', ctitle_en='$ctitle_en', ctitle_th='$ctitle_th', cdetail_en='$cdetail_en', cdetail_th='$cdetail_th' WHERE pid='$pid' AND cid='$cid'";
		$result = mysql_query($sql,$dgz);
		if ($result) { print "<meta http-equiv=\"refresh\"content=\"0; URL=update.php?pid=$pid&cid=$cid&err=2\">"; exit(); }
		else { print "<meta http-equiv=\"refresh\"content=\"0; URL=update.php?pid=$pid&cid=$cid=$cid&err=1\">"; exit(); }
		
	}	else	{

		// Page Information
		include("../../config/page.info.php");
	
		$sqlc = "select * from tb_category WHERE pid='$pid' AND cid='$cid'";
		$resultc = mysql_query($sqlc, $dgz) or die(mysql_error());
		$c = mysql_fetch_array($resultc);

		$curl = $c[curl];
		$ctitle_en = $c[ctitle_en];
		$ctitle_th = $c[ctitle_th];
		$cdetail_en = $c[cdetail_en];
		$cdetail_th = $c[cdetail_th];
		$cposted = $c[cposted];
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
	if (document.form1.curl.value == "")	{
		alert("Please fill in URL.");
		document.form1.curl.focus();
		return false;
	}
	if (document.form1.ctitle_en.value == "")	{
		alert("Please fill in title.");
		document.form1.ctitle_en.focus();
		return false;
	}
	if (document.form1.ctitle_th.value == "")	{
		alert("Please fill in title.");
		document.form1.ctitle_th.focus();
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
		<a href="index.php?pid=<?php echo $pid;?>">All Categories</a> &nbsp;&gt;&nbsp; 
		<strong><?php echo $ctitle_en;?></strong>
	</p>

	<div id="content">
	<?php 
		echo $error;
		$pg = "info";
		include("../submenu.php");
	?>
	<form action="update.php" method="post" name="form1" id="form1" onsubmit="return check();">
		<h3><img src="../../images/tools/edit.png" alt="" />&nbsp; Update Category</h3>	
		<table cellpadding="0" cellspacing="0" class="contentinfo">
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
                <input name="curl" type="text" class="box" value="<?php echo $curl;?>" size="" style="width:300px;" />
                </td>
			</tr>
        	<tr><td class="contenttitle" colspan="2"><img src="../../images/tools/en.jpg" alt="" /> ENGLISH</td></tr>
			<tr>
				<td style="padding-top:25px; width:160px;">Topic :</td>
				<td style="padding-top:25px; width:740px;"><input name="ctitle_en" type="text" class="box" value="<?php echo $ctitle_en;?>" size="" style="width:700px;" /></td>
			</tr>
			<tr>
				<td>Detail / Info :</td>
				<td><textarea name="cdetail_en" class="box" rows="10" style="width:700px;"><?php echo $cdetail_en;?></textarea><script type="text/javascript">CKEDITOR.replace('cdetail_en');</script></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">^ When copying text from anywhere, please ensure you click either the "Paste as plain text" button or "Paste from Word" button. (Which are found at the top of the textarea editor, brown button). This is to ensure no unwanted code will damage the layout structure.</td>
			</tr>
        	<tr><td class="contenttitle" colspan="2"><img src="../../images/tools/th.jpg" alt="" /> THAI</td></tr>
			<tr>
				<td style="padding-top:25px; width:160px;">Topic :</td>
				<td style="padding-top:25px; width:740px;"><input name="ctitle_th" type="text" class="box" value="<?php echo $ctitle_th;?>" size="" style="width:700px;" /></td>
			</tr>
			<tr>
				<td>Detail / Info :</td>
				<td><textarea name="cdetail_th" class="box" rows="10" style="width:700px;"><?php echo $cdetail_th;?></textarea><script type="text/javascript">CKEDITOR.replace('cdetail_th');</script></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">^ When copying text from anywhere, please ensure you click either the "Paste as plain text" button or "Paste from Word" button. (Which are found at the top of the textarea editor, brown button). This is to ensure no unwanted code will damage the layout structure.</td>
			</tr>
			<tr>
				<td>Posted :</td>
				<td><strong><?php echo $cposted;?></strong></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="submit" name="Submit1" value="Update" class="but"/>
					<input type="reset" name="Submit2" value="Reset" class="but"/>
					<input name="chk" type="hidden" value="1" />
					<input name="pid" type="hidden" value="<?php echo $pid;?>" />
					<input name="cid" type="hidden" value="<?php echo $cid;?>" />
				</td>
			</tr>
		</table>
	</form>
	</div>
	
</body>
</html>
