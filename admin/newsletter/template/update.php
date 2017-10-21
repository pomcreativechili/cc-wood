<?php
	include('../../config/chksession.php');
	require_once('../../../Connections/dgz.php');
	
	$nid = $_REQUEST['nid'];
	$_SESSION['sess_padmin'] = "newsletter/template/update.php?nid=$nid";
	
	$chk = $_POST['chk'];
	if ($chk == "1")	{
		$nsubject = $_POST['nsubject'];
		$nsubject = str_replace('"',"&quot;",$nsubject);
		$nsubject = str_replace("'","&rsquo;",$nsubject);
		
		$nmessage = $_POST['nmessage'];
		$nmessage = str_replace('"',"&quot;",$nmessage);
		$nmessage = str_replace("'","&rsquo;",$nmessage);
		
		$nfooter = $_POST['nfooter'];
		$nfooter = str_replace('"',"&quot;",$nfooter);
		$nfooter = str_replace("'","&rsquo;",$nfooter);
		
		$nurl = $_POST['nurl'];

		$sqln = "UPDATE tb_newsletter_info SET nsubject='$nsubject', nmessage='$nmessage', nfooter='$nfooter', nurl='$nurl' WHERE nid = '$nid'";
		$resultn = mysql_query($sqln,$dgz);
		if ($resultn) { print "<meta http-equiv=\"refresh\"content=\"0; URL=update.php?nid=$nid&err=1\">"; exit(); } 
		else { $error = "<p class='err'><img src='resources/images/err.png' alt='' />&nbsp; ERROR : Can not update information.</p>"; }
	}

	$sqln= "select * from tb_newsletter_info WHERE nid = '$nid'";
	$resultn = mysql_query($sqln, $dgz) or die(mysql_error());
	$recn = mysql_fetch_array($resultn);
	
	$nsubject = $recn[nsubject];
	$nmessage = $recn[nmessage];
	$nfooter = $recn[nfooter];
	$nurl = $recn[nurl];

	$err = $_GET['err'];
	if ($err == "1") { $error = "<p class='success'><img src='resources/images/success.png' alt='' />&nbsp; Update information successfully.</p>"; }	
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
	if(document.form1.nsubject.value == "")	{
		alert("Please fill in Subject");
		document.form1.nsubject.focus();
		return false;
	}
	return true;
}
</script>
</head>

<body>
	<?php include("config.php");?>
	<p id="nav">
		<a href="index.php">All Templates</a> &nbsp;&gt;&nbsp; 
		<a href="update.php?nid=<?php echo $nid;?>"><strong><?php echo $nsubject;?></strong></a> &nbsp;&gt;&nbsp; 
		Overview &amp; Info
	</p>

	<div id="content">
	<?php 
		echo $error; 
		$spg = "info";
		include("menu.php");
	?>
	<form action="update.php" method="post" name="form1" id="form1" onsubmit="return check();">
		<h3><img src="resources/images/edit.png" alt="" />&nbsp; Overview &amp; Info</h3>	
		<table cellpadding="0" cellspacing="0" class="contentinfo">
			<tr><td class="contenttitle" colspan="2">Information / Detail</td></tr>
			<tr>
				<td style="padding-top:25px;">Subject : </td>
				<td style="padding-top:25px;"><input name="nsubject" type="text" class="box" value="<?php echo $nsubject;?>" size="" style="width:700px;" /></td>
			</tr>
			<tr>
				<td>Message :</td>
				<td><textarea name="nmessage" class="box" rows="15" style="width:660px;"><?php echo $nmessage;?></textarea><script type="text/javascript">CKEDITOR.replace('nmessage');</script></td>
			</tr>
			<tr><td class="contenttitle" colspan="2">Overview / URL</td></tr>
			<tr>
				<td style="width:160px; padding-top:25px;">External or Page URL : </td>
				<td style="width:740px; padding-top:25px;"><input name="nurl" type="text" class="box" value="<?php echo $nurl;?>" size="" style="width:700px;" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">
				<?php if ($nurl != "") echo "^ Click <a href='$nurl' target='_blank'>here</a> to view the site<br/>";?>
				^ Example : http://www.yourdomain.com/yourpage.html
				</td>
			</tr>
			<tr>
				<td>Text on Footer :</td>
				<td><textarea name="nfooter" class="box" rows="10" style="width:660px;"><?php echo $nfooter;?></textarea><script type="text/javascript">CKEDITOR.replace('nfooter');</script></td>
			</tr>
			<tr>
				<td>Posted :</td>
				<td><?php echo $recn[ndate];?></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
                <input type="submit" name="Submit1" value="Update" class="but"/>
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
