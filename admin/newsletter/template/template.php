<?php
	include('../../config/chksession.php');
	require_once('../../../Connections/dgz.php');
	
	$nid = $_REQUEST['nid'];
	$_SESSION['sess_padmin'] = "newsletter/template/template.php?nid=$nid";
	
	$chk = $_POST['chk'];
	if ($chk == "update")	{
		$ntitle = $_POST['ntitle'];
		$ntitle = str_replace('"',"&quot;",$ntitle);
		$ntitle = str_replace("'","&rsquo;",$ntitle);

		$nstitle = $_POST['nstitle'];
		$nstitle = str_replace('"',"&quot;",$nstitle);
		$nstitle = str_replace("'","&rsquo;",$nstitle);

		$ndetail = $_POST['ndetail'];
		$ndetail = str_replace('"',"&quot;",$ndetail);
		$ndetail = str_replace("'","&rsquo;",$ndetail);
		
		$sqltp = "UPDATE tb_newsletter_info SET ntitle='$ntitle', nstitle='$nstitle', ndetail='$ndetail' WHERE nid='$nid'";
		$resulttp = mysql_query($sqltp,$dgz);
		if ($resulttp) { print "<meta http-equiv=\"refresh\"content=\"0; URL=template.php?nid=$nid&err=1#detail\">"; exit(); }
		else { print "<meta http-equiv=\"refresh\"content=\"0; URL=template.php?nid=$nid&err=2\">"; exit(); }
	}
	
	// Information
	$sqltp= "select * from tb_newsletter_info WHERE nid='$nid'";
	$resulttp = mysql_query($sqltp, $dgz) or die(mysql_error());
	$tp = mysql_fetch_array($resulttp);
	
	$nsubject = $tp[nsubject];
	$ntitle = $tp[ntitle];
	$nstitle = $tp[nstitle];
	$ndetail = $tp[ndetail];
	
	// Gallery
	$sqlg= "select * from tb_newsletter_gallery WHERE nid='$nid' ORDER BY ngsort";
	$resultg = mysql_query($sqlg, $dgz) or die(mysql_error());
	$totalg = mysql_num_rows($resultg);

	$err = $_GET['err'];
	if ($err == "1")		$error = "<p class='success''><img src='resources/images/success.png' alt='' />&nbsp; Update information successfully.</p>";
	else if ($err == "2")	$error = "<p class='err'><img src='resources/images/err.png' alt='' />&nbsp; ERROR : Can not update information.</p>";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../css/default.css" rel="stylesheet" type="text/css" />
<link href="../../css/newsletter.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<?php include("config.php");?>
	<p id="nav">
		<a href="index.php">All Templates</a> &nbsp;&gt;&nbsp; 
		<a href="update.php?nid=<?php echo $nid;?>"><strong><?php echo $nsubject;?></strong></a> &nbsp;&gt;&nbsp; 
		Template &amp; Details
	</p>

	<div id="content">
		<?php
            echo $error;
            $spg = "template";
            include("menu.php");
        ?>
        <h3 class="newstopic"><img src="resources/images/view.png" alt="" />&nbsp; Template &amp; Details</h3>
		<div class="newstemplate">
        <table cellpadding="0" cellspacing="0">
            <tr><td>
            <?php
                $hdurl = "header.php?nid=$nid";
                if ($tp[nheader] == "")	{
					echo '<tr><td><p class="tdmenu"><img src="resources/images/pic.png" alt="" />&nbsp; <a href="'.$hdurl.'" class="nheader">Post Header Picture</a></p></td></tr>';
				}	else	{ 
					echo '
					<tr><td><a href="'.$hdurl.'" class="nheader"><img src="resources/pic/'.$tp[nheader].'" alt="'.$tp[nhdalt].'" title="'.$tp[nhdalt].'" /></a></td></tr>
					<tr><td class="tip">^ Click on picture, if want to update new header.</td></tr>
					';
				}
            ?>
            </td></tr>
        </table>
		</div>
        
		<a name="detail"></a>
	 	<form action="template.php" method="post" name="form1" id="form1">
       	<table cellpadding="0" cellspacing="0" class="contentinfo">
            <tr><td colspan="2" class="contenttitle">Information / Detail</td></tr>
            <tr>
                <td style="padding-top:25px; width:160px;">Title</td>
                <td style="padding-top:25px; width:740px;"><input name="ntitle" type="text" class="box" value="<?php echo $ntitle;?>" size="" style="width:700px;" /></td>
            </tr>
            <tr>
                <td>Sub Title</td>
                <td><input name="nstitle" type="text" class="box" value="<?php echo $nstitle;?>" size="" style="width:700px;" /></td>
            </tr>
            <tr>
                <td>Detail / Info :</td>
                <td><textarea name="ndetail" class="box" rows="12" style="width:700px;"><?php echo $ndetail;?></textarea><script type="text/javascript">CKEDITOR.replace('ndetail');</script></td>
            </tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">^ When copying text from anywhere, please ensure you click either the "Paste as plain text" button or "Paste from Word" button. (Which are found at the top of the textarea editor, brown button). This is to ensure no unwanted code will damage the layout structure.</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
                <input type="submit" name="Submit1" value="Update" class="but"/>
                <input type="reset" name="Submit2" value="Reset" class="but"/>
                <input name="chk" type="hidden" value="update" />
                <input name="nid" type="hidden" value="<?php echo $nid;?>" />
				</td>
			</tr>
        </table>
        </form>

		<a name="gallery"></a>
		<form action="conn/sort.php" method="post" name="form2" id="form2"> 
        <table cellpadding="0" cellspacing="0" class="contentlist">
            <tr><td colspan="2" class="contenttitle">Gallery / Pictures</td></tr>
			<tr>
				<th class="thtitle">
                <input type="submit" name="Submit" value="Sort" class="butsort" />
                <input name="total" type="hidden" value="<?php echo $totalg;?>" />
                <input name="nid" type="hidden" value="<?php echo $nid;?>" /> &nbsp;
                <img src="resources/images/view.png" alt="" />&nbsp; Amount of Pictures :&nbsp; <strong><?php echo $totalg;?></strong> &nbsp;&nbsp;
                <img src="resources/images/add.png" alt="" />&nbsp; <a href="gallery.php?nid=<?php echo $nid;?>" class="nheader">Post new Picture</a>
				</th>
			</tr>
			<tr><th style="background-color:#d7d7d7;">All Pictures</th></tr>
            <tr><td style="padding-top:15px;">
			<?php
				$count = $totalg;
				$gnum = 0;
				while ($g = mysql_fetch_array($resultg))	{
					if ($gnum % 4 == 0) $gallerylist = "newsgallerylist newsgalleryline";
					else $gallerylist = "newsgallerylist";
					$gnum++;
				
					if ($g[ngurl] == "") $ngpic = "<img src='resources/gallery/$g[ngpic]' alt='$g[ngalt]' title='$g[ngalt]' class='newspic' />";
					else $ngpic = "<a href='$g[ngurl]' target='_blank'><img src='resources/gallery/$g[ngpic]' alt='$g[ngalt]' title='$g[ngalt]' class='newspic' /></a>";
					
					echo "
					<div class='".$gallerylist."'>
						<p>$ngpic</p>
						<p>
							<input name='num$count' type='text' class='boxsort' value='$g[ngsort]' onclick='this.select();'/><input name='id$count' type='hidden' value='$g[ngid]' /> 
							<a href='conn/delgallery.php?ngid=$g[ngid]&amp;nid=$nid&amp;ngpic=$g[ngpic]'' onclick=\"return confirm('Do you want to delete this picture ?')\"><img src='resources/images/del.png' alt='Delete' /></a>
						</p>
					</div>
					";
					$count--;
				}
			?>
            </td></tr>
		</table>
        </form>
	</div>
</body>
</html>