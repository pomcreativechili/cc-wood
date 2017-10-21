<?php
	require_once("../../Connections/dgz.php");
	include("../../includes/modules/language.php");
	
	$hlid = 	str_replace('hl','',$_GET['hlid']);
	$hlprev =	$_GET['hlprev'];
	$hlnext = 	$_GET['hlnext'];
	$htitle =	"htitle".$sess_lg;
	$hdetail =	"hdetail".$sess_lg;
	$hurl = 	"hurl".$sess_lg;
	$hpath = 	$url."/admin/resources/home";

	// Select Highlight
	if ($hlid != "")	{
		$sqlhl = "select * from tb_home WHERE htype='0' AND hid='$hlid'";
		$resulthl = mysql_query($sqlhl, $dgz) or die(mysql_error());
		$hl = mysql_fetch_array($resulthl);
		
		echo '
		<p class="highlightboxpic"><a href="'.$hl[$hurl].'"><img src="'.$hpath.'/'.$hl[hpic].'" alt="'.$hl[$htitle].'"/></a></p>
		<div class="highlightboxinfo"><h3>'.$hl[$htitle].'</h3><p>'.$hl[$hdetail].'</p></div>
		<div class="clearline"></div>
		';
		
	// Page Highlight
	}	else	{

		echo '
		<script type="text/javascript">
		$(document).ready(function()	{
			
			$(".highlightbox, .highlightload, .highlightboxpiclist img").hide();
			$(".highlightbox").show();
			$(".highlightload").fadeIn(600);
			$(".highlightboxpiclist img:first-child").delay(300).fadeIn(600);
			$(".highlightboxpiclist img:nth-child(2)").delay(600).fadeIn(600);
			$(".highlightboxpiclist img:nth-child(3)").delay(900).fadeIn(600);

			$(".highlightboxpiclist img").click(function(){
  				$(".highlightboxpic, .highlightboxinfo").css("opacity","0.3");
				var hl = $(this).attr("class");
				var hlurl = "'.$url.'/includes/content/highlight.php";
				$.ajax({
					type: "GET",
					url: hlurl,
					data: {"hlid":hl},
					success: function(results){$(".highlightload").html(results);}
				});
			});
		
			$(".hlprev").click(function(){
				$(".highlightbox").fadeOut(600);
				var hl = $(this).attr("class");
				var hlurl = "'.$url.'/includes/content/highlight.php";
				$.ajax({
					type: "GET",
					url: hlurl,
					data: {"hlprev":hl},
					success: function(results){$("#highlight").html(results);}
				});
			});

			$(".hlnext").click(function(){
				$(".highlightbox").animate({"left":"-840px"},400);
				$(".highlightbox").fadeOut(600);
				var hl = $(this).attr("class");
				var hlurl = "'.$url.'/includes/content/highlight.php";
				$.ajax({
					type: "GET",
					url: hlurl,
					data: {"hlnext":hl},
					success: function(results){$("#highlight").html(results);}
				});
			});
		});
		</script>
        ';
		
		// Amount of Highlight / Another for loop
		$sqlhla = "select * from tb_home WHERE htype='0' AND hactive='1' order by abs(hsort)";
		$resulthla = mysql_query($sqlhla, $dgz) or die(mysql_error());
		$totalhla = mysql_num_rows($resulthla);

		if ($hlprev != "")	$hlnum = str_replace('hlprev hl','',$hlprev);
		if ($hlnext != "")	$hlnum = str_replace('hlnext hl','',$hlnext);
		if ($hlnum < 0)		$hlnum = $totalhla - 1;
		
		$sqlhl = "select * from tb_home WHERE htype='0' AND hactive='1' order by abs(hsort) LIMIT $hlnum,4";
		$resulthl = mysql_query($sqlhl, $dgz) or die(mysql_error());
		$totalhl = mysql_num_rows($resulthl);
		
		if ($totalhl > 0)	{
			if ($hlnum == 0) $hlprev = $totalhla - 1;
			else $hlprev = $hlnum - 1;
			$hlchknext = $totalhla - 1;
			if ($hlnum == $hlchknext) $hlnext = 0;
			else $hlnext = $hlnum + 1;
			echo '
			<span class="hlprev hl'.$hlprev.'"></span>
			<span class="hlnext hl'.$hlnext.'"></span>
			<div id="highlightarea">
			';
			
			$hlcount = 1;
			while ($hl = mysql_fetch_array($resulthl))	{
				// Begin of highlight
				if ($hlcount == 1)	{
					echo '
					<div class="highlightbox">
					<div class="highlightload">
						<p class="highlightboxpic"><a href="'.$hl[$hurl].'"><img src="'.$hpath.'/'.$hl[hpic].'" alt="'.$hl[$htitle].'"/></a></p>
						<div class="highlightboxinfo"><h3>'.$hl[$htitle].'</h3><p>'.$hl[$hdetail].'</p></div>
						<div class="clearline"></div>
					</div>
					';
				}
				if ($hlcount == 1) echo '<p class="highlightboxpiclist">';
				if ($hlcount > 1 and $hlcount <= 4) echo '<img src="'.$hpath.'/'.$hl[hpic].'" alt="'.$hl[$htitle].'" class="hl'.$hl[hid].'"/>';
				
				// Loop for hightlight
				if ($hlcount == $totalhl)	{
					while ($hla = mysql_fetch_array($resulthla) and $hlcount <= 4)	{
						echo '<img src="'.$hpath.'/'.$hla[hpic].'" alt="'.$hla[$htitle].'" class="hl'.$hla[hid].'"/>';
						$hlcount++;
					}
				}

				// End of highlight set
				if ($hlcount == 4) { 
					echo '</p><div class="clearline"></div></div>';
					$hlcount = 0;
				}
				$hlcount++;
			}
			echo '</div>';
		}
	}
?>