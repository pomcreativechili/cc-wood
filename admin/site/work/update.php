<?php
	include('../../config/chksession.php');
	require_once('../../../Connections/dgz.php');
	
	$wid = $_REQUEST['wid'];
	$_SESSION['sess_padmin'] = "site/work/update.php?wid=$wid";
	$wpath = "../../resources/work";
	
	$chk = $_POST['chk'];
	if ($chk == "1")	{
		$wurl = $_POST['wurl'];
		$wurl = preg_replace('/[^a-zA-Z0-9\-]/', '_', $wurl);
		$wurl = str_replace(" ","_","$wurl");
		$wurl = strtolower($wurl);

		$wpid = $_POST['wpid'];

		// English
		$wtitle_en = $_POST['wtitle_en'];
		$wtitle_en = str_replace('"',"&quot;","$wtitle_en");
		$wtitle_en = str_replace("'","&rsquo;","$wtitle_en");

		$wtopic1_en = $_POST['wtopic1_en'];
		$wtext1_en = $_POST['wtext1_en'];
		$wtopic2_en = $_POST['wtopic2_en'];
		$wtext2_en = $_POST['wtext2_en'];
		$wtopic3_en = $_POST['wtopic3_en'];
		$wtext3_en = $_POST['wtext3_en'];
		$wtopic4_en = $_POST['wtopic4_en'];
		$wtext4_en = $_POST['wtext4_en'];

		$wdetail_en = $_POST['wdetail_en'];
		$wdetail_en = str_replace('"',"&quot;","$wdetail_en");
		$wdetail_en = str_replace("'","&rsquo;","$wdetail_en");

		// Thai
		$wtitle_th = $_POST['wtitle_th'];
		$wtitle_th = str_replace('"',"&quot;","$wtitle_th");
		$wtitle_th = str_replace("'","&rsquo;","$wtitle_th");

		$wtopic1_th = $_POST['wtopic1_th'];
		$wtext1_th = $_POST['wtext1_th'];
		$wtopic2_th = $_POST['wtopic2_th'];
		$wtext2_th = $_POST['wtext2_th'];
		$wtopic3_th = $_POST['wtopic3_th'];
		$wtext3_th = $_POST['wtext3_th'];
		$wtopic4_th = $_POST['wtopic4_th'];
		$wtext4_th = $_POST['wtext4_th'];

		$wdetail_th = $_POST['wdetail_th'];
		$wdetail_th = str_replace('"',"&quot;","$wdetail_th");
		$wdetail_th = str_replace("'","&rsquo;","$wdetail_th");

		$sql = "UPDATE tb_work SET wurl='$wurl', pid='$wpid', wtitle_en='$wtitle_en', wtitle_th='$wtitle_th', wtopic1_en='$wtopic1_en', wtopic1_th='$wtopic1_th', wtext1_en='$wtext1_en', wtext1_th='$wtext1_th', wtopic2_en='$wtopic2_en', wtopic2_th='$wtopic2_th', wtext2_en='$wtext2_en', wtext2_th='$wtext2_th', wtopic3_en='$wtopic3_en', wtopic3_th='$wtopic3_th', wtext3_en='$wtext3_en', wtext3_th='$wtext3_th', wtopic4_en='$wtopic4_en', wtopic4_th='$wtopic4_th', wtext4_en='$wtext4_en', wtext4_th='$wtext4_th', wdetail_en='$wdetail_en', wdetail_th='$wdetail_th' WHERE wid='$wid'";
		$result = mysql_query($sql,$dgz);
		if ($result) { print "<meta http-equiv=\"refresh\"content=\"0; URL=update.php?wid=$wid&err=2\">"; exit(); }
		else { print "<meta http-equiv=\"refresh\"content=\"0; URL=update.php?wid=$wid&err=1\">"; exit(); }
		
	}
		
	// Page Content
	$pid = 4000;
	include("../../config/page.info.php");

	$sql = "select * from tb_work WHERE wid='$wid'";
	$result = mysql_query($sql, $dgz) or die(mysql_error());
	$rec = mysql_fetch_array($result);
	
	$wurl 		= $rec[wurl];
	$wpid 		= $rec[pid];
	$wtitle_en	= $rec[wtitle_en];
	$wtopic1_en	= $rec[wtopic1_en];
	$wtext1_en	= $rec[wtext1_en];
	$wtopic2_en	= $rec[wtopic2_en];
	$wtext2_en	= $rec[wtext2_en];
	$wtopic3_en	= $rec[wtopic3_en];
	$wtext3_en	= $rec[wtext3_en];
	$wtopic4_en	= $rec[wtopic4_en];
	$wtext4_en	= $rec[wtext4_en];
	$wdetail_en	= $rec[wdetail_en];
	$wtitle_th	= $rec[wtitle_th];
	$wtopic1_th	= $rec[wtopic1_th];
	$wtext1_th	= $rec[wtext1_th];
	$wtopic2_th	= $rec[wtopic2_th];
	$wtext2_th	= $rec[wtext2_th];
	$wtopic3_th	= $rec[wtopic3_th];
	$wtext3_th	= $rec[wtext3_th];
	$wtopic4_th	= $rec[wtopic4_th];
	$wtext4_th	= $rec[wtext4_th];
	$wdetail_th	= $rec[wdetail_th];
	$wpic 		= $rec[wpic];
	$wposted 	= $rec[wposted];

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
	if (document.form1.wurl.value == "")	{
		alert("Please fill in URL.");
		document.form1.wurl.focus();
		return false;
	}
	if (document.form1.wtitle_en.value == "")	{
		alert("Please fill in title.");
		document.form1.wtitle_en.focus();
		return false;
	}
	if (document.form1.wtitle_th.value == "")	{
		alert("Please fill in title.");
		document.form1.wtitle_th.focus();
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
        <a href="index.php">All Works</a> &nbsp;&gt;&nbsp; 
		<strong><?php echo $wtitle_en;?></strong>
	</p>

	<div id="content">
	<form action="update.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check();">
		<?php 
			echo $error;
			$pg = "info";
			include("../submenu.php");
		?>
		<h3><img src="../../images/tools/edit.png" alt="" />&nbsp; Update Work</h3>	
		<table cellpadding="0" cellspacing="0" class="contentinfo">
			<tr>
				<td style="padding-top:25px; width:160px;">Page URL :</td>
				<td style="padding-top:25px; width:740px;">
				<?php echo $url."/".$p[purl]."/";?>
                <input name="wurl" type="text" class="box" value="<?php echo $wurl;?>" size="" style="width:300px;" />
                </td>
			</tr>
			<tr>
				<td style="padding-top:25px; width:160px;">Category :</td>
				<td style="padding-top:25px; width:740px;">
	                <select name="wpid" class="box">
	                <?php
	                	$sqlmnsp = "SELECT pid, ptopic_en FROM tb_page WHERE pmp LIKE '4000' ORDER BY pid";
				        $resultmnsp = mysql_query($sqlmnsp, $dgz) or die(mysql_error());
					
				        while ($mnsp = mysql_fetch_array($resultmnsp))	{
				        	if ( $mnsp[pid] == $wpid ) $select = ' selected="selected"'; else $select = '';
				        	echo '<option value="'.$mnsp[pid].'"'.$select.'>'.$mnsp[ptopic_en].'</option>';
				        }
	                ?>
	                </select>
                </td>
			</tr>
        	<tr><td class="contenttitle" colspan="2"><img src="../../images/tools/en.jpg" alt="" /> ENGLISH</td></tr>
            <tr>
                <td style="padding-top:25px;">Project / Title :</td>
                <td style="padding-top:25px;"><input name="wtitle_en" type="text" class="box" value="<?php echo $wtitle_en;?>" size="" style="width:700px;" /></td>
            </tr>
            <tr>
                <td>Topic 1 / Text 1 :</td>
                <td><input name="wtopic1_en" type="text" class="box" value="<?php echo $wtopic1_en;?>" size="" style="width:330px;" /> &nbsp; <input name="wtext1_en" type="text" class="box" value="<?php echo $wtext1_en;?>" size="" style="width:330px;" /></td>
            </tr>
            <tr>
                <td>Topic 2 / Text 2 :</td>
                <td><input name="wtopic2_en" type="text" class="box" value="<?php echo $wtopic2_en;?>" size="" style="width:330px;" /> &nbsp; <input name="wtext2_en" type="text" class="box" value="<?php echo $wtext2_en;?>" size="" style="width:330px;" /></td>
            </tr>
            <tr>
                <td>Topic 3 / Text 3 :</td>
                <td><input name="wtopic3_en" type="text" class="box" value="<?php echo $wtopic3_en;?>" size="" style="width:330px;" /> &nbsp; <input name="wtext3_en" type="text" class="box" value="<?php echo $wtext3_en;?>" size="" style="width:330px;" /></td>
            </tr>
            <tr>
                <td>Topic 4 / Text 4 :</td>
                <td><input name="wtopic4_en" type="text" class="box" value="<?php echo $wtopic4_en;?>" size="" style="width:330px;" /> &nbsp; <input name="wtext4_en" type="text" class="box" value="<?php echo $wtext4_en;?>" size="" style="width:330px;" /></td>
            </tr>
            <tr>
                <td>Detail / Info :</td>
                <td><textarea name="wdetail_en" class="box" rows="5" style="width:700px;"><?php echo $wdetail_en;?></textarea></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td class="tip">^ Any copied text (from Microsoftword or other program) MUST be pasted into "Micosoft Note Pad application" first, then re-copied into the text area editor below. This is to stop uni-code (which is in Word) getting into the system.</td>
            </tr>
            <tr><td class="contenttitle" colspan="2"><img src="../../images/tools/th.jpg" alt="" /> THAI</td></tr>
            <tr>
                <td style="padding-top:25px; width:160px;">Project / Title :</td>
                <td style="padding-top:25px; width:740px;"><input name="wtitle_th" type="text" class="box" value="<?php echo $wtitle_th;?>" size="" style="width:700px;" /></td>
            </tr>
            <tr>
                <td>Topic 1 / Text 1 :</td>
                <td><input name="wtopic1_th" type="text" class="box" value="<?php echo $wtopic1_th;?>" size="" style="width:330px;" /> &nbsp; <input name="wtext1_th" type="text" class="box" value="<?php echo $wtext1_th;?>" size="" style="width:330px;" /></td>
            </tr>
            <tr>
                <td>Topic 2 / Text 2 :</td>
                <td><input name="wtopic2_th" type="text" class="box" value="<?php echo $wtopic2_th;?>" size="" style="width:330px;" /> &nbsp; <input name="wtext2_th" type="text" class="box" value="<?php echo $wtext2_th;?>" size="" style="width:330px;" /></td>
            </tr>
            <tr>
                <td>Topic 3 / Text 3 :</td>
                <td><input name="wtopic3_th" type="text" class="box" value="<?php echo $wtopic3_th;?>" size="" style="width:330px;" /> &nbsp; <input name="wtext3_th" type="text" class="box" value="<?php echo $wtext3_th;?>" size="" style="width:330px;" /></td>
            </tr>
            <tr>
                <td>Topic 4 / Text 4 :</td>
                <td><input name="wtopic4_th" type="text" class="box" value="<?php echo $wtopic4_th;?>" size="" style="width:330px;" /> &nbsp; <input name="wtext4_th" type="text" class="box" value="<?php echo $wtext4_th;?>" size="" style="width:330px;" /></td>
            </tr>
            <tr>
                <td>Detail / Info :</td>
                <td><textarea name="wdetail_th" class="box" rows="5" style="width:700px;"><?php echo $wdetail_th;?></textarea></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td class="tip">^ Any copied text (from Microsoftword or other program) MUST be pasted into "Micosoft Note Pad application" first, then re-copied into the text area editor below. This is to stop uni-code (which is in Word) getting into the system.</td>
            </tr>
        	<tr><td class="contenttitle" colspan="2"><img src="../../images/tools/img.jpg" alt="" /> Picture</td></tr>
			<tr>
				<td style="padding-top:25px;">Choose (File) :</td>
				<td style="padding-top:25px;">
				<?php 
					if($wpic == "") echo "<img src='../../images/tools/pic.png' alt='' />&nbsp; <a href='pic.php?wid=$wid'>Upload Picture</a>";
					else echo "<img src='$wpath/$wpic' alt=''/>&nbsp; <a href='conn/pic.php?wid=$wid&amp;wpic=$wpic' onclick=\"return confirm('Do you want to delete this picture ?')\"'><img src='../../images/tools/del.png' alt='' /></a>";
				?>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">
				^ 750 x 500 Pixels for picture size<br />
                ^ .JPG, .PNG, GIF for file type
				</td>
			</tr>
			<tr>
				<td>Posted :</td>
				<td><strong><?php echo $wposted;?></strong></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
                <input type="submit" name="Submit" value="Update" class="but"/>
                <input type="reset" name="Reset" value="Reset" class="but"/>
                <input name="chk" type="hidden" value="1" />
                <input name="wid" type="hidden" value="<?php echo $wid;?>" />
				</td>
			</tr>
		</table>
	</form>
	</div>
	
</body>
</html>