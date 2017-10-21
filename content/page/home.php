<?php
	$htitle =	"htitle".$sess_lg;
	$hdetail =	"hdetail".$sess_lg;
	$hurl = 	"hurl".$sess_lg;
	$hpath = 	$url."/admin/resources/home";
	
	// Highlight
	$sqlhl = "select * from tb_home WHERE htype='0' AND hactive='1' order by abs(hsort)";
	$resulthl = mysql_query($sqlhl, $dgz) or die(mysql_error());
	$totalhl = mysql_num_rows($resulthl);
	
	$hlamount = $totalhl + 3;
	$hlwidth = ($hlamount * 158) + 261 + 316;
	
	if ($totalhl > 0)	{
		echo '
		<div id="highlight">
		<span class="hlprev hl0"></span>
		<span class="hlnext hl2"></span>
		<div id="highlightarea">
		<div id="highlightboxarea" style="width:'.$hlwidth.'px;">
		';
		$hlnum = 1;
		while ($hl = mysql_fetch_array($resulthl))	{
			if ($hl[$hurl] != "") $hlpic = '<a href="'.$hl[$hurl].'"><img src="'.$hpath.'/'.$hl[hpic].'" alt="'.$hl[$htitle].'"/></a>';
			else $hlpic = '<img src="'.$hpath.'/'.$hl[hpic].'" alt="'.$hl[$htitle].'"/>';
			
			echo '
			<div class="highlightbox hlb'.$hlnum.'">
				<p class="highlightboxpic"><span class="hlcover hlth'.$hlnum.'"></span>'.$hlpic.'</p>
				<div class="highlightboxinfo"><h3>'.$hl[$htitle].'</h3><p>'.$hl[$hdetail].'</p></div>
				<div class="clearline"></div>
			</div>
			';
			$hlnum++;
		}
		
		echo '
		<div class="highlightbox hlcbox"><span class="hlclear hlc1"></span></div>
		<div class="highlightbox hlcbox"><span class="hlclear hlc2"></span></div>
		<div class="highlightbox hlcbox"><span class="hlclear hlc3"></span></div>
		<span class="hlamount hlm'.$totalhl.'"></span>
		<div class="clearline"></div>
		</div>
		';
		
		// Highlight bullets
		$sqlhlb = "select * from tb_home WHERE htype='0' AND hactive='1' order by abs(hsort)";
		$resulthlb = mysql_query($sqlhlb, $dgz) or die(mysql_error());
		$totalhlb = mysql_num_rows($resulthlb);
		if ($totalhlb > 0)	{
			$hlbwidth = $totalhlb * 13;
			$hlbmargin = 840 - $hlbwidth;
			$hlbnum = 1;
			echo '<div id="highlightbullet" style="width:'.$hlbwidth.'px; margin-left:'.$hlbmargin.'px;">';
			while ($hlb = mysql_fetch_array($resulthlb))	{
				echo '<span class="hlcover hlth'.$hlbnum.'"></span>';
				$hlbnum++;
			}
			echo '</div>';
		}
			
		echo '
		</div>
		</div>
		';
	}
	
	// Information + Gallery
	include("info.default.php");

	// Video
	$sqlvd = "select * from tb_home WHERE htype='1' AND hactive='1' order by abs(hsort)";
	$resultvd = mysql_query($sqlvd, $dgz) or die(mysql_error());
	$totalvd = mysql_num_rows($resultvd);
	
	if ($totalvd > 0)	{
		echo '
		<div id="video">
		<span class="vdprev"></span>
		<span class="vdnext"></span>
		<a href="#" class="prev"></a>
		<a href="#" class="next"></a>
		<div class="slides_container">
		';
		
		while ($vd = mysql_fetch_array($resultvd))	{
			$vdurlembed = str_replace("youtu.be","www.youtube.com/embed",$vd[$hurl]);
			echo '
			<div class="videobox">
				<div class="videoboxinfo">
					<h3>'.$vd[$htitle].'</h3>
					<p>'.$vd[$hdetail].'</p>
				</div>
				<p class="videoboxpic"><a href="'.$vdurlembed.'" class="vdopopup iframe"><span></span><img src="'.$hpath.'/'.$vd[hpic].'" alt="'.$vd[$htitle].'"/></a></p>
				<div class="clearline"></div>
			</div>
			';
		}
		echo '</div>';
	}
?>