<p id="infogallery">
<?php	
	if ($spg == "" and $spid == "")	$sqlg = "select * from tb_gallery WHERE gtype='$pgallery' AND pid='$pid' order by abs(gsort)";
	else $sqlg = "select * from tb_gallery WHERE gtype='$spgallery' AND pid='$spid' order by abs(gsort)";
	$resultg = mysql_query($sqlg, $dgz) or die(mysql_error());
	$galt = "galt".$sess_lg;
	while ($g = mysql_fetch_array($resultg))	{
		if ($pgallery == "2" or $spgallery == "2")	{
			echo '<a href="'.$ppath.'/gallery/'.$g[glarge].'" class="enlarge"';
			if ($g[$galt] != "") echo ' title="'.$g[$galt].'"';
			echo '>';
		}
		echo '<img src="'.$ppath.'/gallery/'.$g[gthumb].'" alt="'.$g[$galt].'" />';
		if ($pgallery == "2" or $spgallery == "2") echo '</a>';
	}
?>
</p>
<div class="clearline"></div>