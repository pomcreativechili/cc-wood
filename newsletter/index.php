<?php
	require_once("../Connections/dgz.php");
	
	$nid = $_GET['nid'];

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
		<style type="text/css">
		*, html { margin:0px; padding:0px; }
		body { background:#fff; margin:20px; padding:0px; font-size:12px; font-family:Arial; }
		.newsarea { width:800px; margin:auto; }
		a { color:#6e8030; }
		h1 { font-size:36px; font-weight:normal; line-height:48px; color:#000; text-transform:uppercase; padding-bottom:20px; }
		h2 { font-size:28px;  font-weight:normal; text-transform:uppercase; color:#333; line-height:34px; padding-bottom:15px; }
		h3 { font-size:14px; font-weight:normal; line-height:24px; color:#6e8030; padding-bottom:20px; }
		table { width:800px; }
		td { padding:0px; margin:0px; vertical-align:top; }
		p { padding-bottom:15px; line-height:22px; }
		.newswebsite { padding-bottom:20px; font-size:11px; color:#666; }
		.newscontent { padding-bottom:20px; background:url('.$ntppath.'/bgcontent.jpg) repeat-y; }
		.newsinfo { padding-top:10px; padding-bottom:30px; padding-left:50px; padding-right:45px; width:440px; font-size:12px; font-family:Arial; color:#333; line-height:24px; }
		.newsinfo p	{ padding-bottom:15px; line-height:20px; font-size:10px; }
		.newsgallery { padding-top:10px; padding-bottom:30px; padding-right:53px; width:212px; }
		.newsgallery img { width:212px; margin-bottom:15px; }
		.newsfooter { padding-top:20px; font-size:11px; color:#666; width:800px; }
		.newsfooter p { line-height:18px; }
		</style>
		
		<div class="newsarea">
		<p class="newswebsite">To view Thaweephan website, please click <a href="'.$url.'">here</a></p>
		<h1>'.$nsubject.'</h1>'.$nmessage.'';

		// Header
		if ($nheader != "") {
			$nhdpic = '<img src="'.$nimgpath.'/'.$nheader.'" alt="'.$nhdalt.'" title="'.$nhdalt.'" style="width:800px;" />';
			if ($nhdurl != "") $nhdpic = '<a href="'.$nhdurl.'" target="_blank">'.$nhdpic.'</a>';
		}
		
		$message .= '<table cellpadding="0" cellspacing="0" style="margin-top:15px;">
		<tr><td><img src="'.$ntppath.'/bghead.jpg" alt="" /></td></tr>';
		if ($nheader != "") $message .= '<tr><td>'.$nhdpic.'</td></tr>';
		$message .= '	
		<tr><td><img src="'.$ntppath.'/bgcontenthead.jpg" alt="" /></td></tr>
		</table>
		';

		// Information
		$message .= '
		<table cellpadding="0" cellspacing="0" class="newscontent">
		<tr>
			<td class="newsinfo">
			<h2>'.$ntitle.'</h2>
			<h3>'.$nstitle.'</h3>
			'.$ndetail.'
			</td>
			<td class="newsgallery">';

		// Gallery
		$sqlng= "select * from tb_newsletter_gallery WHERE nid='$nid' ORDER BY ngsort";
		$resultng = mysql_query($sqlng, $dgz) or die(mysql_error());
		while ($ng = mysql_fetch_array($resultng))	{
			if ($ng[ngurl] != "") $message .= '<a href="'.$ng[ngurl].'" target="_blank">';
			$message .= '<img src="'.$ngpath.'/'.$ng[ngpic].'" alt="'.$ng[ngalt].'" title="'.$ng[ngalt].'" />';
			if ($ng[ngurl] != "") $message .= '</a>';
		}
		$message .= '</td></tr></table>';

		// Footer
		$message .= '<table cellpadding="0" cellspacing="0"><tr><td><img src="'.$ntppath.'/bgcontentfooter.jpg" alt="" /></td></tr><tr><td><img src="'.$ntppath.'/bgfooter.jpg" alt="" /></td></tr></table>
		<div class="newsfooter">'.$nfooter.'';
		if ($nurl != "") $message .= '<p>Please click <a href="'.$nurl.'" target="_blank">here</a> to view page in website.</p>';
		$message .= '</div></div>'; // End news area
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="<?php echo $url;?>/favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $nsubject;?> | Thaweephan Newsleter</title>
</head>

<body>
<?php print $message; ?>

<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-37681780-1']);
	_gaq.push(['_trackPageview']);
	
	(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
</script>
</body>
</html>