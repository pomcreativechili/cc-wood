<div id="download">
<?php
	// Download
	$sqlsrc = "SELECT * FROM tb_list WHERE pid='11000' AND lactive='1' ORDER BY lsort";
	$resultsrc = mysql_query($sqlsrc, $dgz) or die(mysql_error());
	$totalsrc = mysql_num_rows($resultsrc);
	
	$dtitle = "ltopic".$sess_lg;
	$ddetail = "ldetail".$sess_lg;
	
	if ($totalsrc > 0)	{
		while ($src = mysql_fetch_array($resultsrc))	{
?>
	<div class="download-item">
		<div class="download-link"><a href="<?php echo $src[$dlink]; ?>" target="_blank">Download</a></div>
		<div class="download-text">
			<h2><?php echo $src[$dtitle]; ?></h2>
			<?php if ($src[$ddetail] != "") echo $src[$ddetail]; ?>
		</div>
		<div class="clearline"></div>
	</div>	
<?php
		}
	}
?>
</div>
<div class="clearline"></div>