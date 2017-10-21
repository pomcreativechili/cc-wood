<div id="infoarea" class="nogallery">
    <div id="infodetail">
    <?php
        echo '<h2><a href="'.$url.'/'.$purl.'/'.$sp[purl].'/'.$src[curl].'">'.$sptopic.'</a> &nbsp;&gt;&nbsp; <span>'.$src[$ctitle].'</span></h2>';
        if ($src[$cdetail] != "") echo $src[$cdetail];
    ?>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function()	{
	$("#productgallery .slides_container img").click(function(){
  		$("#productpic a").css("opacity","0.5");
		var src = $(this).attr("src");
		pic = src.replace(/gallery\/th/g,"gallery/");
		var srpurl = "<?php echo $url;?>/includes/content/showroom.php";
		$.ajax({
			type: "GET",
			url: srpurl,
			data: {'gfile':pic},
			success: function(results){$('#productpic').html(results);}
		});
	});
});
</script>

<div id="product">
	<p id="productpic"><a href="<?php echo $pdpath.'/'.str_replace('th','',$srp[pdpic]);?>" class="productzoom"><img src="<?php echo $pdpath.'/'.str_replace('th','',$srp[pdpic]);?>" alt="<?php echo $srp[$pdtitle];?>" /></a></p>
    <div id="productinfo">
    	<div id="productdetail">
        <?php 
			echo '<h2>'.$srp[$pdtitle].'</h2>';
			if ($srp[$pddetail] != "") echo $srp[$pddetail];
		?>
        </div>
        <?php
			$sqlsrg = "select * from tb_gallery WHERE pdid='$srp[pdid]' AND pid='$spid' AND gtype='5' AND gpage='$src[cid]' order by abs(gsort)";
			$resultsrg = mysql_query($sqlsrg, $dgz) or die(mysql_error());
			$totalsrg = mysql_num_rows($resultsrg);
		?>
        <?php if ($totalsrg > 0) { ?>
        <div id="productgallery">
        	<h3>Gallery</h3>
            <span class="pdprev"></span>
            <span class="pdnext"></span>
            <?php if ($totalsrg > 5) { ?>
            <a href="#" class="prev"></a>
            <a href="#" class="next"></a>
            <?php } ?>
            <div class="slides_container">
            <?php 
				$srgnum = 1;
				$srgalt = "galt".$sess_lg;
				while ($srg = mysql_fetch_array($resultsrg))	{
					if ($srgnum == 1) echo '<p>';
					echo '<img src="'.$pdpath.'/gallery/'.$srg[gthumb].'" alt="'.$srg[$srgalt].'" />';
					if ($srgnum == 5) { echo '</p>'; $srgnum = 0; }
					$srgnum++;
				}
			?>
            </div>
        </div>
        <?php } ?>
    </div>
    <div id="productpage">
	<?php 
        // Previouse
        $sqlpdpv = "select * from tb_product WHERE cid='$src[cid]' AND pid='$spid' AND pdid < '$srp[pdid]'  AND pdactive='1' ORDER BY pdid desc LIMIT 1";
        $resultpdpv = mysql_query($sqlpdpv, $dgz) or die(mysql_error());
        $totalpdpv = mysql_num_rows($resultpdpv);
        $pdpv = mysql_fetch_array($resultpdpv);

        // Next
        $sqlpdn = "select * from tb_product WHERE cid='$src[cid]' AND pid='$spid' AND pdid > '$srp[pdid]' AND pdactive='1' ORDER BY pdid LIMIT 1";
        $resultpdn = mysql_query($sqlpdn, $dgz) or die(mysql_error());
        $totalpdn = mysql_num_rows($resultpdn);
        $pdn = mysql_fetch_array($resultpdn);

		if ($totalpdpv > 0 and $totalpdn > 0) echo '<p class="productprev"><a href="'.$url.'/'.$purl.'/'.$sp[purl].'/'.$src[curl].'/'.$pdpv[pdurl].'.html">&lt; Previous</a></p>';
		else if ($totalpdpv == 0) echo '<p class="productnext nopage"><a href="'.$url.'/'.$purl.'/'.$sp[purl].'/'.$src[curl].'/'.$pdn[pdurl].'.html">Next &gt;</a></p>';

		if ($totalpdpv > 0 and $totalpdn > 0) echo '<p class="productnext"><a href="'.$url.'/'.$purl.'/'.$sp[purl].'/'.$src[curl].'/'.$pdn[pdurl].'.html">Next &gt;</a></p>';
		else if ($totalpdn == 0) echo '<p class="productprev nopage"><a href="'.$url.'/'.$purl.'/'.$sp[purl].'/'.$src[curl].'/'.$pdpv[pdurl].'.html">&lt; Previous</a></p>';
    ?>
	<div class="clearline"></div>
    </div>
</div>