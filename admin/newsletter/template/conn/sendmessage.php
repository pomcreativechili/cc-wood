<?php
	$sqltp= "select * from tb_newsletter_info WHERE nid='$nid'";
	$resulttp = mysql_query($sqltp, $dgz) or die(mysql_error());
	$tp = mysql_fetch_array($resulttp);
	
	$nsubject = $tp[nsubject];
	$nmessage = $tp[nmessage];
	$nmessage = str_replace("&quot;",'"',$nmessage);
	$nmessage = str_replace("&rsquo;","'",$nmessage);

	$nheader = $tp[nheader];
	$nhdalt = $tp[nhdalt];
	$nhdurl = $tp[nhdurl];
	
	$ntitle = $tp[ntitle];
	$nstitle = $tp[nstitle];
	$ndetail = $tp[ndetail];
	$ndetail = str_replace("&quot;",'"',$ndetail);
	$ndetail = str_replace("&rsquo;","'",$ndetail);
	
	$nfooter = $tp[nfooter];
	$nfooter = str_replace("&quot;",'"',$nfooter);
	$nfooter = str_replace("&rsquo;","'",$nfooter);

	$nurl = $tp[nurl];
	$npath = $url."/admin/newsletter/template/resources";
	$nimgpath = $npath."/pic";
	$ngpath = $npath."/gallery";
	$ntppath = $npath."/template";

	$message = '
	<html>
	<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" bgcolor="#fff">
		<style>
		*, html	{ margin:0px; padding:0px; }
		body 	{ margin:20px; padding:0px; font-size:12px; font-family:Arial; width:800px; }
		h1 		{ font-size:24px; color:#020202; text-transform:uppercase; padding-bottom:20px; }
		table 	{ width:800px; }
		td 		{ padding:0px; margin:0px; vertical-align:top; }
		p 		{ padding-bottom:15px; line-height:18px; }
		</style>
		<div style="width:800px;">
		<h1>'.$nsubject.'</h1><div style="line-height:22px;">'.$nmessage.'</div></div>';

		// Header
		if ($nheader != "") {
			if ($nhdurl == "") $nhdpic = '<img src="'.$nimgpath.'/'.$nheader.'" alt="'.$nhdalt.'" style="display:block; width:800px;" />';
			else $nhdpic = '<a href="'.$nhdurl.'" target="_blank"><img src="'.$nimgpath.'/'.$nheader.'" alt="'.$nhdalt.'" style="display:block; width:800px;" /></a>';
		}
		
		$message .= '<table cellpadding="0" cellspacing="0" style="margin-top:20px;">
		<tr><td><img src="'.$ntppath.'/bghead.jpg" alt="" style="display:block;" /></td></tr>'; // Background Header
		if ($nheader != "") $message .= '<tr><td>'.$nhdpic.'</td></tr>'; // Banner
		$message .= '<tr><td><img src="'.$ntppath.'/bgcontenthead.jpg" alt="" style="display:block;" /></td></tr></table>'; // Background Header Content

	// Information
	$message .= '<table cellpadding="0" cellspacing="0" style="background-image:url('.$ntppath.'/bgcontent.jpg); background-repeat: repeat-y; width:800px; padding-bottom:20px;">
		<tr>
		<td valign="top" style="padding-bottom:15px; padding-left:50px; padding-right:45px; width:440px; font-size:11px; font-family:Arial; color:#333; line-height:22px;"><h2 style="font-size:28px; font-weight:normal; line-height:30px; padding-bottom:10px; color:#333;">'.$ntitle.'</h2><h3 style="font-size:14px; font-weight:normal; color:#6e8030; padding-bottom:15px;">'.$nstitle.'</h3>'.$ndetail.'</td>
		<td valign="top" style="padding-bottom:15px; padding-right:53px; width:212px;">';

	// Gallery
	$sqlng= "select * from tb_newsletter_gallery WHERE nid='$nid' ORDER BY ngsort";
	$resultng = mysql_query($sqlng, $dgz) or die(mysql_error());
	while ($ng = mysql_fetch_array($resultng))	{
		if ($ng[ngurl] != "") $message .= '<a href="'.$ng[ngurl].'" target="_blank"><img src="'.$ngpath.'/'.$ng[ngpic].'" alt="'.$ng[ngalt].'" title="'.$ng[ngalt].'" style="margin-bottom:15px; display:block; width:212px;" /></a><br/>';
		else $message .= '<img src="'.$ngpath.'/'.$ng[ngpic].'" alt="'.$ng[ngalt].'" title="'.$ng[ngalt].'" style="margin-bottom:15px; display:block; width:212px;" /><br/>';
	}
	$message .= '</td></tr></table>';

	// Footer
	$message .= '<table cellpadding="0" cellspacing="0"><tr><td><img src="'.$ntppath.'/bgcontentfooter.jpg" alt="" style="display:block;" /></td></tr><tr><td><img src="'.$ntppath.'/bgfooter.jpg" alt="" style="display:block;" /></td></tr></table>
	<div style="padding-top:20px; font-size:11px; color:#666; width:800px; line-height:17px;">'.$nfooter.'<p>'; // Start external link
	if ($nurl != "") $message .= 'Please click <a href="'.$nurl.'" target="_blank">here</a> to view page in website. or '; // External URL
	$message .= 'Click <a href="'.$url.'/newsletter/index.php?nid='.$nid.'" target="_blank">here</a> to view this newsletter in an online version.</p></div>
	</body>
	</html>'; // End footer + news area
?>