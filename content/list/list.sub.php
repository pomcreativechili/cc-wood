<?php
	// Sub pages
	$sqlsbp = "select * from tb_page WHERE pmp='$pid' AND psp='$spid' order by abs(pid)";
	$resultsbp = mysql_query($sqlsbp, $dgz) or die(mysql_error());
	$totalsbp = mysql_num_rows($resultsbp);
	
	$sbptopic = "ptopic".$sess_lg;
	$sbpintro = "pintro".$sess_lg;
	
	echo '<div id="listsub">';
	while ($sbp = mysql_fetch_array($resultsbp))	{
		echo '
		<div class="subbox">
			<p class="subboxpic"><a href="'.$url.$lgurl.'/'.$purl.'/'.$sp[purl].'/'.$sbp[purl].'"><img src="'.$ppath.'/'.$sbp[ppic].'" alt="'.$sbp[$ptopic].'" /></a></p>
			<h3><a href="'.$url.$lgurl.'/'.$purl.'/'.$sp[purl].'/'.$sbp[purl].'">'.$sbp[$sbptopic].'</a></h3>
			<p class="subboxintro">'.nl2br($sbp[$sbpintro]).'</p>
		</div>
		';
	}
	echo '<div class="clearline"></div>
	</div>
	';
?>