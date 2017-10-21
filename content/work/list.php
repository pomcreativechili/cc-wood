<?php
	$pn = $_GET['pn'];
	if ($pn == "") $pn = 1;
	$pnnum = $pn - 1;
	$limit = 9;
	$start = $pnnum * $limit;

	// Our Work
	$sqlwa = "select * from tb_work WHERE wactive='1'";
	$resultwa = mysql_query($sqlwa, $dgz) or die(mysql_error());
	$totalwa = mysql_num_rows($resultwa);
	$wpg = ceil($totalwa/$limit); // Any decimals up "1"

	$sqlw = $sqlwa." order by abs(wsort) LIMIT $start,$limit";
	$resultw = mysql_query($sqlw, $dgz) or die(mysql_error());
	
	$wtitle = "wtitle".$sess_lg;
	$wtopic1 = "wtopic1".$sess_lg;
	$wtext1 = "wtext1".$sess_lg;
	$wtopic2 = "wtopic2".$sess_lg;
	$wtext2 = "wtext2".$sess_lg;
	$wtopic3 = "wtopic3".$sess_lg;
	$wtext3 = "wtext3".$sess_lg;
	$wtopic4 = "wtopic4".$sess_lg;
	$wtext4 = "wtext4".$sess_lg;
	$wpath = $url."/admin/resources/work";
	$wnum = 0;
	$wcount = 0;
	
	echo '<div id="listwork">';
	while ($w = mysql_fetch_array($resultw))	{
		$wnum++;
		$wcount++;
		if ($wcount == 1 or $wnum == 3) { $wclearbox = '<div class="clearline"></div>'; $wclear = " clearwork"; $wnum = 0; }
		else { $wclearbox = ""; $wclear = ""; }
		
		echo '
		'.$wclearbox.'
		<div class="workbox'.$wclear.'">
			<p class="workboxpic"><a href="'.$url.$lgurl.'/'.$purl.'/'.$w[wurl].'.html" class="popupwork"><img src="'.$wpath.'/'.$w[wpic].'" alt="'.$w[$wtitle].'" /></a></p>
			<div class="workboxdetail">
				<h3><span class="wtopic">Project:</span> <a href="'.$url.$lgurl.'/'.$purl.'/'.$w[wurl].'.html" class="wtext popupwork">'.$w[$wtitle].'</a></h3>
				<p>';
				if ($w[$wtopic1] != "" and $w[$wtext1] != "") echo '<span class="wtopic">'.$w[$wtopic1].':</span> <span class="wtext">'.$w[$wtext1].'</span><br />';
				if ($w[$wtopic2] != "" and $w[$wtext2] != "") echo '<span class="wtopic">'.$w[$wtopic2].':</span> <span class="wtext">'.$w[$wtext2].'</span><br />';
				if ($w[$wtopic3] != "" and $w[$wtext3] != "") echo '<span class="wtopic">'.$w[$wtopic3].':</span> <span class="wtext">'.$w[$wtext3].'</span><br />';
				if ($w[$wtopic4] != "" and $w[$wtext4] != "") echo '<span class="wtopic">'.$w[$wtopic4].':</span> <span class="wtext">'.$w[$wtext4].'</span><br />';
			echo '
				</p>
			</div>
		</div>
		';
	}
	echo '<div class="clearline"></div>';

	// Pagination
	$pnprev = $pn - 1;
	if ($pnprev < 1) $pnprev = 1;
		
	$pnnext = $pn + 1;
	if ($pnnext >= $wpg) $pnnext = $wpg;

	// Current Page
	$currentpn = $pnnum + 1;

	echo '
	<p id="pagination">
		<a href="'.$url.$lgurl.'/'.$purl.'/pages/'.$pnprev.'" class="pnprev">Previous</a>
		<span>'.$currentpn.' / '.$wpg.'</span>
		<a href="'.$url.$lgurl.'/'.$purl.'/pages/'.$pnnext.'" class="pnnext">Next</a>
	</p>
	';
	
	echo '</div>';
?>