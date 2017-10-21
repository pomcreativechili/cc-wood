<?php
	include('../../config/chksession.php');
	require_once('../../../Connections/dgz.php');
	
	$nid = $_GET['nid'];
	$_SESSION['sess_padmin'] = "newsletter/template/preview.php?nid=$nid";
	
	$sqltp= "select * from tb_newsletter_info WHERE nid='$nid'";
	$resulttp = mysql_query($sqltp, $dgz) or die(mysql_error());
	$tp = mysql_fetch_array($resulttp);
	
	$nsubject = $tp[nsubject];
	$nmessage = $tp[nmessage];
	$nheader = $tp[nheader];
	$nhdalt = $tp[nhdalt];
	$nhdurl = $tp[nhdurl];
	$nfooter = $tp[nfooter];
	$ntitle = $tp[ntitle];
	$nstitle = $tp[nstitle];
	$ndetail = $tp[ndetail];
	$nurl = $tp[nurl];
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
		Preview &amp; Send
	</p>

	<div id="content">
	<?php
		echo $error;
		$spg = "preview";
		include("menu.php");
	?>
	<h3 class="newstopic"><img src="resources/images/view.png" alt="" />&nbsp; Preview &amp; Send</h3>
	
	<div class="newspreview">
	<?php
		// Subject / Title
		echo "<h1>".$nsubject."</h1>";
		
		// Message
		$nmessage = str_replace("&quot;",'"',$nmessage);
		$nmessage = str_replace("&rsquo;","'",$nmessage);
		echo $nmessage;
		
		if ($nheader != "") {
			if ($nhdurl == "") $nhdpic = '<img src="resources/pic/'.$nheader.'" alt="'.$nhdalt.'" title="'.$nhdalt.'" />';
			else $nhdpic = '<a href="'.$nhdurl.'" target="_blank"><img src="resources/pic/'.$nheader.'" alt="'.$nhdalt.'" title="'.$nhdalt.'" /></a>';
		}
		
		echo '
		<table cellpadding="0" cellspacing="0" class="newsheader">
			<tr><td><img src="resources/template/bghead.jpg" alt="" /></td></tr>';
			if ($nheader != "") echo '<tr><td>'.$nhdpic.'</td></tr>';
		echo '
			<tr><td><img src="resources/template/bgcontenthead.jpg" alt="" /></td></tr>
		</table>
		';
	?>
    <table cellpadding="0" cellspacing="0" class="newscontent">
    <tr>
    	<td class="newsinfo">
        <?php 
			// Information
			$ntitle = str_replace("&quot;",'"',$ntitle);
			$ntitle = str_replace("&rsquo;","'",$ntitle);
			echo '<h2>'.$ntitle.'</h2>';

			$nstitle = str_replace("&quot;",'"',$nstitle);
			$nstitle = str_replace("&rsquo;","'",$nstitle);
			echo '<h3>'.$nstitle.'</h3>';

			$ndetail = str_replace("&quot;",'"',$ndetail);
			$ndetail = str_replace("&rsquo;","'",$ndetail);
			echo $ndetail;
		?>        
        </td>
    	<td class="newsgallery">
        <?php
			// Gallery
			$sqlng= "select * from tb_newsletter_gallery WHERE nid='$nid' ORDER BY ngsort";
			$resultng = mysql_query($sqlng, $dgz) or die(mysql_error());
			while ($ng = mysql_fetch_array($resultng))	{
				if ($ng[ngurl] != "") echo '<a href="'.$ng[ngurl].'" target="_blank">';
				echo '<img src="resources/gallery/'.$ng[ngpic].'" alt="'.$ng[ngalt].'" title="'.$ng[ngalt].'" />';
				if ($ng[ngurl] != "") echo '</a>';
			}
		?>
        </td>
	</tr>
    </table>
    
    <table cellpadding="0" cellspacing="0">
    <tr><td><img src="resources/template/bgcontentfooter.jpg" alt="" /></td></tr>
    <tr><td><img src="resources/template/bgfooter.jpg" alt="" /></td></tr>
    </table>
    
    <?php
		// Footer
		echo '<div class="newsfooter">';
		$nfooter = str_replace("&quot;",'"',$nfooter);
		$nfooter = str_replace("&rsquo;","'",$nfooter);
		echo $nfooter;
		
		// External URL
		if ($nurl != "") echo '<p>Please click <a href="'.$nurl.'" target="_blank">here</a> to view page in website. or Click <a href="'.$url.'/newsletter/index.php?nid='.$nid.'" target="_blank">here</a> to view this newsletter in an online version.</p>';
		
		echo '</div>';
	?>
	</div>
	
	<div class="newssend"><a href="send.php?nid=<?php echo $nid;?>" class="nsend">Send to Email Address</a></div>
	
	</div>
</body>
</html>