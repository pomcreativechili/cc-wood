<?php
	$pn = $_GET['pn'];
	if ($pn == "") $pn = 1;
	$pnnum = $pn - 1;
	$limit = 4;
	$start = $pnnum * $limit;

	// News
	$sqllsa = "select * from tb_list WHERE pid='$spid' AND ltype='$splist' AND lactive='1'";
	$resultlsa = mysql_query($sqllsa, $dgz) or die(mysql_error());
	$totallsa = mysql_num_rows($resultlsa);
	$lspg = ceil($totallsa/$limit); // Any decimals up "1"

	$sqlls = $sqllsa." order by abs(lsort) LIMIT $start,$limit";
	$resultls = mysql_query($sqlls, $dgz) or die(mysql_error());
	
	$ltopic = "ltopic".$sess_lg;
	$lintro = "lintro".$sess_lg;
	$lpath = $url."/admin/resources/list";
	$lsnum = 0;
	
	if ($totallsa > 0)	{
		echo '<div id="listinfo">';
		while ($ls = mysql_fetch_array($resultls))	{
			$lsnum++;
			if ($lsnum % 2 == 0) $lseven = " listeven";
			else $lseven = "";
			
			echo '
			<div class="listbox'.$lseven.'">
				<p class="listboxthumb"><a href="'.$url.$lgurl.'/'.$purl.'/'.$sp[purl].'/'.$ls[lurl].'.html"><img src="'.$lpath.'/'.$ls[lpic].'" alt="'.$ls[$ltopic].'" /></a></p>
				<div class="listboxdetail">
					<h3>'.$ls[$ltopic].'</h3>
					<p>'.nl2br($ls[$lintro]).'</p>
					<p class="listbutton newsbutton"><a href="'.$url.$lgurl.'/'.$purl.'/'.$sp[purl].'/'.$ls[lurl].'.html"><span>Read More</span></a></p>
				</div>
				<div class="clearline"></div>
			</div>
			';
		}
		
		// Pagination
		$pnprev = $pn - 1;
		if ($pnprev < 1) $pnprev = 1;
			
		$pnnext = $pn + 1;
		if ($pnnext >= $lspg) $pnnext = $lspg;
	
		// Current Page
		$currentpn = $pnnum + 1;
	
		echo '
		<p id="pagination">
			<a href="'.$url.$lgurl.'/'.$purl.'/'.$sp[purl].'/pages/'.$pnprev.'" class="pnprev">Previous</a>
			<span>'.$currentpn.' / '.$lspg.'</span>
			<a href="'.$url.$lgurl.'/'.$purl.'/'.$sp[purl].'/pages/'.$pnnext.'" class="pnnext">Next</a>
		</p>
		';
		
		echo '</div>';
	}
?>