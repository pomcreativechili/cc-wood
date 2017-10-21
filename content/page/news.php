<p id="newsnav">
	<a href="<?php echo $url.$lgurl.'/'.$purl.'#'.$purl.'/'.$sp[purl];?>">Archives</a> &nbsp;&gt;&nbsp; 
    <span><?php echo $nptopic;?></span>
</p>

<div id="infoarea">
<?php
	echo '<h2>'.$nptopic.'</h2>';
	if ($npdetail != "") echo '<div id="infodetail">'.$npdetail.'</div>';
	
	// News Gallery
	$sqlng = "select * from tb_gallery WHERE gtype='3' AND pid='$npid' AND gpage='$spid' order by abs(gsort)";
	$resultng = mysql_query($sqlng, $dgz) or die(mysql_error());
	$totalng = mysql_num_rows($resultng);
	$ngalt = "galt".$sess_lg;
	if ($totalng > 0)	{
		echo ' 
		<div id="newsgallery">
		<h3>Gallery</h3>
		<p>
		';
		while ($ng = mysql_fetch_array($resultng))	{
			echo '<a href="'.$nppath.'/gallery/'.$ng[glarge].'" class="enlarge"';
			if ($ng[$ngalt] != "") echo ' title="'.$ng[$ngalt].'"';
			echo '><img src="'.$nppath.'/gallery/'.$ng[gthumb].'" alt="'.$ng[$ngalt].'" /></a>';
		}
		echo '
		</p></div>
		';
	}
?>
</div>

<?php include("content/page/info.gallery.php");?>