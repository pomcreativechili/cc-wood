<?php 
	$sltext1 = 	"sltext1".$sess_lg;
	$sltext2 = 	"sltext2".$sess_lg;
	$sltext3 = 	"sltext3".$sess_lg;
	$slurl = 	"slurl".$sess_lg;
	$slpath =	$url."/admin/resources/slide";
	
	// Banner picture
	if ($pg != "")	{
		echo '<p id="bannerpage" style="background-image: url('.$ppic.');" /></p>';
		
	// Parallax Slideshow
	}	else if (!strstr($_SERVER['HTTP_USER_AGENT'],'MSIE') or strstr($_SERVER['HTTP_USER_AGENT'],'MSIE 10.0'))	{
		echo '
		<div id="slide">
		<div id="da-slider" class="da-slider">
		';

		$sqlsl = "select * from tb_slide WHERE slactive='1' order by abs(slsort)";
		$resultsl = mysql_query($sqlsl, $dgz) or die(mysql_error());
		while ($sl = mysql_fetch_array($resultsl))	{
			echo '
			<div class="da-slide">
				<p class="slide-bg" style="background-image: url('.$slpath.'/'.$sl[slpic].');"></p>
			</div>
			';
		}
		
		echo '
		</div>
		</div>
		';
		
	// Fade In/Out Slideshow
	}	else if (strstr($_SERVER['HTTP_USER_AGENT'],'MSIE'))	{
		echo '
		<script type="text/javascript">
		$(function() {
			$("#slide").slides({
				play: 5000,
				pause: 5000,
				fadeSpeed: 900,
				effect: "fade",
				crossfade: true,
				pagination: true,
				hoverPause: false
			});
		});
		</script>
		<div id="slide">
		<div class="slides_container">
		';
		
		$sqlsl = "select * from tb_slide WHERE slactive='1' order by abs(slsort)";
		$resultsl = mysql_query($sqlsl, $dgz) or die(mysql_error());
		while ($sl = mysql_fetch_array($resultsl))	{
			echo '
			<div class="slidebox">
				<h3 class="slide-text1">'.$sl[$sltext1].'</h3>
				<h3 class="slide-text2">'.$sl[$sltext2].'</h3>
				<p class="slide-url"><a href="'.$sl[$slurl].'"><span>'.$sl[$sltext3].'</span></a></p>
				<p class="slide-bg"><img src="'.$slpath.'/'.$sl[slpic].'" alt="" /></p>
			</div>
			';
		}
		
		echo '
		</div>
		</div>
		';
	}
?>