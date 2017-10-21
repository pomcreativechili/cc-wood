<script type="text/javascript">
$(document).ready(function()	{
	<?php if ($sbpg == "") { ?>
	$("#listshowroom .srtopic:nth-child(1)").addClass("mnsrselect mnsrclose");
	$("#listshowroom .srtopic:nth-child(1)").next().show();
	<?php } ?>
	
	$("#listshowroom .srtopic").click(function(){
		if ($(this).hasClass("mnsrclose")) {
			$(this).removeClass("mnsrclose mnsrselect");
			$(this).next().slideUp(400);
		}	else	{
			$(".srcbox").slideUp(400);
			$("#listshowroom .srtopic").removeClass("mnsrselect mnsrclose");
			$("#listshowroom .srtopic").next().removeClass("srselect");
			$(this).addClass("mnsrselect mnsrclose");
			$(this).next().slideToggle(400);
		}
	});
});
</script>

<?php
	// Showroom
	$sqlsrc = "select tb_category.*, ";
	$sqlsrc .= "(select count(tb_product.pdid) FROM tb_product WHERE tb_product.cid=tb_category.cid AND tb_product.pid='$spid' AND tb_product.pdactive='1') as pdamount from tb_category ";
	$sqlsrc .= "WHERE pid='$spid' AND cactive='1' order by abs(csort)";
	$resultsrc = mysql_query($sqlsrc, $dgz) or die(mysql_error());
	$totalsrc = mysql_num_rows($resultsrc);
	
	$ctitle = "ctitle".$sess_lg;
	$pdtitle = "pdtitle".$sess_lg;
	$pdpath = $url."/admin/resources/product";
	
	if ($totalsrc > 0)	{
		echo '<div id="listshowroom">';
		while ($src = mysql_fetch_array($resultsrc))	{
			if ($src[pdamount] > 0)	{
				if ($sbpg == $src[curl])	{
					$srtp = " mnsrselect mnsrclose";
					$srbox = " srselect";
				}	else	{
					$srtp = "";
					$srbox = "";
				}
				
				echo '
				<a href="#sr'.$src[cid].'" name="sr'.$src[cid].'" class="srtopic'.$srtp.'"><h3>'.$src[$ctitle].'</h3></a>
				<div class="srcbox'.$srbox.'">
				<span class="srpprev"></span>
				<span class="srpnext"></span>
				';
	
				// Product
				$sqlsrp = "select * from tb_product WHERE cid='$src[cid]' AND pid='$spid' AND pdactive='1' order by abs(pdsort)";
				$resultsrp = mysql_query($sqlsrp, $dgz) or die(mysql_error());
				$totalsrp = mysql_num_rows($resultsrp);
	
				if ($totalsrp > 0)	{
					$srpnum = 1;
					$srpcount = 1;
					if ($totalsrp > 5) echo '<a href="#" class="prev"></a><a href="#" class="next"></a>';
					
					echo '<div class="slides_container">';
					while ($srp = mysql_fetch_array($resultsrp))	{
						$srpurl = $url.$lgurl.'/'.$purl.'/'.$sp[purl].'/'.$src[curl].'/'.$srp[pdurl].'.html';
						if ($srpnum == "1") echo '<div class="srpboxarea">';
						echo '
						<div class="srpbox">
							<p><a href="'.$srpurl.'"><img src="'.$pdpath.'/'.$srp[pdpic].'" alt="'.$srp[$pdtitle].'"/></a></p>
							<p><a href="'.$srpurl.'">'.$srp[$pdtitle].'</a></p>
						</div>
						';
						if ($srpnum == 5 or $srpcount == $totalsrp) { echo '<div class="clearline"></div></div>'; $srpnum = 0; }
						$srpnum++;
						$srpcount++;
					}
					echo '</div>';
				}
				
				echo '</div>';
			}
		}
		echo '</div>';
	}
?>