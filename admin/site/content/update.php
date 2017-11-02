<?php
	include('../../config/chksession.php');
	require_once('../../../Connections/dgz.php');
	
	$pid = $_REQUEST['pid'];
	$_SESSION['sess_padmin'] = "site/content/update.php?pid=$pid";
	$ppath = "../../resources/pages";
	
	$chk = $_POST['chk'];
	if ($chk == "1")	{
		$ptype = $_POST['ptype'];
		$pdate = date("Y-m-d H:i:s");

		$purl = $_POST['purl'];
		$purl = preg_replace('/[^a-zA-Z0-9\-]/', '_', $purl);
		$purl = str_replace(" ","_","$purl");
		$purl = strtolower($purl);

		// English
		$ptitle_en = $_POST['ptitle_en'];
		$ptitle_en = str_replace('"',"&quot;","$ptitle_en");
		$ptitle_en = str_replace("'","&rsquo;","$ptitle_en");

		$pdesc_en = $_POST['pdesc_en'];
		$pdesc_en = str_replace('"',"&quot;","$pdesc_en");
		$pdesc_en = str_replace("'","&rsquo;","$pdesc_en");

		$pkeys_en = $_POST['pkeys_en'];
		$pmenu_en = $_POST['pmenu_en'];
		
		$ptopic_en = $_POST['ptopic_en'];
		$ptopic_en = str_replace('"',"&quot;","$ptopic_en");
		$ptopic_en = str_replace("'","&rsquo;","$ptopic_en");

		$pintro_en = $_POST['pintro_en'];
		$pintro_en = str_replace('"',"&quot;","$pintro_en");
		$pintro_en = str_replace("'","&rsquo;","$pintro_en");

		$pdetail_en = $_POST['pdetail_en'];
		$pdetail_en = str_replace('"',"&quot;","$pdetail_en");
		$pdetail_en = str_replace("'","&rsquo;","$pdetail_en");

		// Thai
		$ptitle_th = $_POST['ptitle_th'];
		$ptitle_th = str_replace('"',"&quot;","$ptitle_th");
		$ptitle_th = str_replace("'","&rsquo;","$ptitle_th");

		$pdesc_th = $_POST['pdesc_th'];
		$pdesc_th = str_replace('"',"&quot;","$pdesc_th");
		$pdesc_th = str_replace("'","&rsquo;","$pdesc_th");

		$pkeys_th = $_POST['pkeys_th'];
		$pmenu_th = $_POST['pmenu_th'];
		
		$ptopic_th = $_POST['ptopic_th'];
		$ptopic_th = str_replace('"',"&quot;","$ptopic_th");
		$ptopic_th = str_replace("'","&rsquo;","$ptopic_th");

		$pintro_th = $_POST['pintro_th'];
		$pintro_th = str_replace('"',"&quot;","$pintro_th");
		$pintro_th = str_replace("'","&rsquo;","$pintro_th");

		$pdetail_th = $_POST['pdetail_th'];
		$pdetail_th = str_replace('"',"&quot;","$pdetail_th");
		$pdetail_th = str_replace("'","&rsquo;","$pdetail_th");

		// Upload Image
		$ppic = $_FILES['ppic']['tmp_name'];
		$ppicname = $_FILES['ppic']['name']; 
		if ($ppic != "")	{
			$new = $pid."_".str_replace(" ","_","$ppicname");
			if (is_uploaded_file($ppic)) { copy($ppic,"$ppath/$new"); }
			$uppic = ", ppic='$new'";

			if ($ptype != "6")	{
				include("../../config/simpleimage.php");
				$image = new SimpleImage();
				$image->load("$ppath/".$new);
				$image->resizeToWidth(400);
				$image->save("$ppath/thumb/".$new);
			}
		}
		
		$sqlp = "UPDATE tb_page SET purl='$purl', ptitle_en='$ptitle_en', ptitle_th='$ptitle_th', pdesc_en='$pdesc_en', pdesc_th='$pdesc_th', pkeys_en='$pkeys_en', pkeys_th='$pkeys_th', pmenu_en='$pmenu_en', pmenu_th='$pmenu_th', ptopic_en='$ptopic_en', ptopic_th='$ptopic_th', pintro_en='$pintro_en', pintro_th='$pintro_th', pdetail_en='$pdetail_en', pdetail_th='$pdetail_th'".$uppic.", pupdated='$pdate' WHERE pid='$pid'";
		$resultp = mysql_query($sqlp,$dgz);
		if ($resultp) { print "<meta http-equiv=\"refresh\"content=\"0; URL=update.php?pid=$pid&err=2\">"; exit(); }
		else { print "<meta http-equiv=\"refresh\"content=\"0; URL=update.php?pid=$pid&err=1\">"; exit(); }
		
	}	else	{
		// Page Information
		include("../../config/page.info.php");
		
		$purl = 		$p[purl];
		$ptype = 		$p[ptype];
		$ptitle_en = 	$p[ptitle_en];
		$pdesc_en = 	$p[pdesc_en];
		$pkeys_en = 	$p[pkeys_en];
		$pmenu_en =		$p[pmenu_en];
		$ptopic_en = 	$p[ptopic_en];
		$pintro_en = 	$p[pintro_en];
		$pdetail_en = 	$p[pdetail_en];
		$ptitle_th = 	$p[ptitle_th];
		$pdesc_th = 	$p[pdesc_th];
		$pkeys_th = 	$p[pkeys_th];
		$pmenu_th =		$p[pmenu_th];
		$ptopic_th = 	$p[ptopic_th];
		$pintro_th = 	$p[pintro_th];
		$pdetail_th = 	$p[pdetail_th];
		$ppic = 		$p[ppic];
		
		if ($ptype == "6")	{
			$pwidth = 265;
			$pheight = 200;
		}	else	{
			$pwidth = 1920;
			$pheight = 420;
		}
	}

	$err = $_GET['err'];
	if ($err == "1") { $error = "<p class='err'><img src='../../images/tools/err.png' alt='' />&nbsp; ERROR : Can not update information.</p>"; }
	else if ($err == "2") { $error = "<p class='success''><img src='../../images/tools/success.png' alt='' />&nbsp; Update information successfully.</p>"; }	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../css/default.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<?php include("../menu.php"); ?>
	<p id="nav">
        <a href="index.php">All Pages</a> &nbsp;&gt;&nbsp; 
        <?php echo $ptopic_en;?> &nbsp;&gt;&nbsp; 
        <strong>Update Content</strong>
    </p>

	<div id="content">
	<form action="update.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
		<?php 
			echo $error;
			if (($ptype != "1" and $ptype != "5" and $ptype != "6") or ($ptype == "6" and $p[plist] == "1")) {
				$pg = "info";
				include("../submenu.php");
			}
		?>
		<h3><img src="../../images/tools/edit.png" alt="" />&nbsp; Update Content</h3>	
		<table cellpadding="0" cellspacing="0" class="contentinfo">
            <?php if ($ptype != "0") { ?>
			<tr>
				<td style="padding-top:25px; width:160px;">Page URL :</td>
				<td style="padding-top:25px; width:740px;">
				<?php 
					echo $url;
					if ($ptype == "5")	{
						echo "/popup";
					}
					if ($ptype != "4" and $ptype != "6") { 
						echo "/";
					}	else	{
						// URL main page
						$sqlpm = "select * from tb_page WHERE pid='$p[pmp]'";
						$resultpm = mysql_query($sqlpm, $dgz) or die(mysql_error());
						$pm = mysql_fetch_array($resultpm);
						echo "/".$pm[purl]."/";

						if ($ptype == "6")	{
							// URL sub page
							$sqlps = "select * from tb_page WHERE pid='$p[psp]'";
							$resultps = mysql_query($sqlps, $dgz) or die(mysql_error());
							$ps = mysql_fetch_array($resultps);
							echo $ps[purl]."/";
						}
					}
				?>
                <input name="purl" type="text" class="box" value="<?php echo $purl;?>" size="" style="width:300px;" />
                </td>
			</tr>
            <?php } ?>
            
            <?php if ($ptype != "4" and $ptype != "5" and $ptype != "6") { ?>
        	<tr><td class="contenttitle" colspan="2"><img src="../../images/tools/en.jpg" alt="" /> ENGLISH</td></tr>
			<tr>
				<td style="padding-top:25px; width:160px;">Page Title :</td>
				<td style="padding-top:25px; width:740px;"><input name="ptitle_en" type="text" class="box" value="<?php echo $ptitle_en;?>" size="" style="width:700px;" /></td>
			</tr>
			<tr>
				<td>Meta Description :</td>
				<td><textarea name="pdesc_en" class="box" rows="4" style="width:700px;"><?php echo $pdesc_en;?></textarea></td>
			</tr>
			<tr>
				<td>Meta Keywords :</td>
				<td><input name="pkeys_en" type="text" class="box" value="<?php echo $pkeys_en;?>" size="" style="width:700px;" /></td>
			</tr>
            <?php } ?>
        	<tr><td class="contenttitle" colspan="2"><?php if ($ptype == "4" or $ptype == "5" or $ptype == "6") echo '<img src="../../images/tools/en.jpg" alt="" /> English'; else echo 'Content';?></td></tr>
            <?php if ($ptype == "4") { ?>
			<tr>
				<td style="padding-top:25px; width:160px;">Text / Menu :</td>
				<td style="padding-top:25px; width:740px;"><input name="pmenu_en" type="text" class="box" value="<?php echo $pmenu_en;?>" size="" style="width:300px;" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">^ This text will be displayed on menu section.</td>
			</tr>
			<tr>
				<td>Topic :</td>
				<td><input name="ptopic_en" type="text" class="box" value="<?php echo $ptopic_en;?>" size="" style="width:700px;" /></td>
			</tr>
            <?php } else { ?>
			<tr>
				<td style="padding-top:25px; width:160px;">Topic :</td>
				<td style="padding-top:25px; width:740px;"><input name="ptopic_en" type="text" class="box" value="<?php echo $ptopic_en;?>" size="" style="width:700px;" /></td>
			</tr>
            <?php } ?>

			<?php if ($ptype == "6") { ?>
            <tr>
                <td>Introduction :</td>
                <td><textarea name="pintro_en" class="box" rows="5" style="width:700px;"><?php echo $pintro_en;?></textarea></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td class="tip">^ Any copied text (from Microsoftword or other program) MUST be pasted into "Micosoft Note Pad application" first, then re-copied into the text area editor below. This is to stop uni-code (which is in Word) getting into the system.</td>
            </tr>
            <?php } ?>
 
            <?php if ($ptype != "1") { ?>
			<tr>
				<td>Detail / Info :</td>
				<td><textarea name="pdetail_en" class="box" rows="10" style="width:700px;"><?php echo $pdetail_en;?></textarea><script type="text/javascript">CKEDITOR.replace('pdetail_en');</script></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">^ When copying text from anywhere, please ensure you click either the "Paste as plain text" button or "Paste from Word" button. (Which are found at the top of the textarea editor, brown button). This is to ensure no unwanted code will damage the layout structure.</td>
			</tr>
            <?php } else { ?>
            <tr>
                <td>&nbsp;</td>
                <td class="tip">^ Any copied text (from Microsoftword or other program) MUST be pasted into "Micosoft Note Pad application" first, then re-copied into the text area editor below. This is to stop uni-code (which is in Word) getting into the system.
                </td>
            </tr>
			<?php } ?>            
            
            <?php if ($ptype != "4" and $ptype != "5" and $ptype != "6") { ?>
        	<tr><td class="contenttitle" colspan="2"><img src="../../images/tools/th.jpg" alt="" /> THAI</td></tr>
			<tr>
				<td style="padding-top:25px; width:160px;">Page Title :</td>
				<td style="padding-top:25px; width:740px;"><input name="ptitle_th" type="text" class="box" value="<?php echo $ptitle_th;?>" size="" style="width:700px;" /></td>
			</tr>
			<tr>
				<td>Meta Description :</td>
				<td><textarea name="pdesc_th" class="box" rows="4" style="width:700px;"><?php echo $pdesc_th;?></textarea></td>
			</tr>
			<tr>
				<td>Meta Keywords :</td>
				<td><input name="pkeys_th" type="text" class="box" value="<?php echo $pkeys_th;?>" size="" style="width:700px;" /></td>
			</tr>
            <?php } ?>
        	<tr><td class="contenttitle" colspan="2"><?php if ($ptype == "4" or $ptype == "5" or $ptype == "6") echo '<img src="../../images/tools/th.jpg" alt="" /> Thai'; else echo 'Content';?></td></tr>
            <?php if ($ptype == "4") { ?>
			<tr>
				<td style="padding-top:25px; width:160px;">Text / Menu :</td>
				<td style="padding-top:25px; width:740px;"><input name="pmenu_th" type="text" class="box" value="<?php echo $pmenu_th;?>" size="" style="width:300px;" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">^ This text will be displayed on menu section.</td>
			</tr>
			<tr>
				<td>Topic :</td>
				<td><input name="ptopic_th" type="text" class="box" value="<?php echo $ptopic_th;?>" size="" style="width:700px;" /></td>
			</tr>
            <?php } else { ?>
			<tr>
				<td style="padding-top:25px; width:160px;">Topic :</td>
				<td style="padding-top:25px; width:740px;"><input name="ptopic_th" type="text" class="box" value="<?php echo $ptopic_th;?>" size="" style="width:700px;" /></td>
			</tr>
            <?php } ?>

			<?php if ($ptype == "6") { ?>
            <tr>
                <td>Introduction :</td>
                <td><textarea name="pintro_th" class="box" rows="5" style="width:700px;"><?php echo $pintro_th;?></textarea></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td class="tip">^ Any copied text (from Microsoftword or other program) MUST be pasted into "Micosoft Note Pad application" first, then re-copied into the text area editor below. This is to stop uni-code (which is in Word) getting into the system.</td>
            </tr>
            <?php } ?>

            <?php if ($ptype != "1") { ?>
			<tr>
				<td>Detail / Info :</td>
				<td><textarea name="pdetail_th" class="box" rows="10" style="width:700px;"><?php echo $pdetail_th;?></textarea><script type="text/javascript">CKEDITOR.replace('pdetail_th');</script></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">^ When copying text from anywhere, please ensure you click either the "Paste as plain text" button or "Paste from Word" button. (Which are found at the top of the textarea editor, brown button). This is to ensure no unwanted code will damage the layout structure.</td>
			</tr>
            <?php } else { ?>
            <tr>
                <td>&nbsp;</td>
                <td class="tip">^ Any copied text (from Microsoftword or other program) MUST be pasted into "Micosoft Note Pad application" first, then re-copied into the text area editor below. This is to stop uni-code (which is in Word) getting into the system.
                </td>
            </tr>
			<?php } ?>
                     
            <?php if ($ptype != "0" and $ptype != "4" and $ptype != "5") { ?>
       		<tr><td class="contenttitle" colspan="2"><img src="../../images/tools/img.jpg" alt="" /> Picture</td></tr>
			<tr>
				<td style="padding-top:25px;">Choose (File) :</td>
				<td style="padding-top:25px;">
				<?php 
					if($ppic == "") echo '<input name="ppic" type="file" class="box" size="" style="width:400px;" />';
					else if ($ppic != "" and $ptype == "6") echo "<img src='$ppath/$ppic' alt=''/>&nbsp; <a href='conn/pic.php?pid=$pid&amp;ptype=$ptype&amp;ppic=$ppic' onclick=\"return confirm('Do you want to delete this picture ?')\"'><img src='../../images/tools/del.png' alt='' /></a>";
					else if ($ppic != "" and $ptype != "6") echo "<img src='$ppath/thumb/$ppic' alt=''/>&nbsp; <a href='conn/pic.php?pid=$pid&amp;ptype=$ptype&amp;ppic=$ppic' onclick=\"return confirm('Do you want to delete this picture ?')\"'><img src='../../images/tools/del.png' alt='' /></a>";
				?>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">
				^ <?php echo $pwidth." x ".$pheight;?> Pixels for picture size<br />
				^ .JPG, .PNG, GIF for file type
				</td>
			</tr>
            <?php } ?>
            
			<tr>
				<td>Updated :</td>
                <td><strong><?php echo $p[pupdated];?></strong></td>
            </tr>
			<tr>
				<td>&nbsp;</td>
				<td>
                <input type="submit" name="Submit" value="Update" class="but"/>
                <input type="reset" name="Reset" value="Reset" class="but"/>
                <input name="chk" type="hidden" value="1" />
                <input name="pid" type="hidden" value="<?php echo $pid;?>" />
                <input name="ptype" type="hidden" value="<?php echo $ptype;?>" />
				</td>
			</tr>
		</table>
	</form>
	</div>
	
</body>
</html>
