<?php
	// Accordian
	if ($sbpid != "") $sqlls = "select * from tb_list WHERE pid='$sbpid' AND ltype='$sbplist' AND lactive='1' order by abs(lsort)";
	else $sqlls = "select * from tb_list WHERE pid='$spid' AND ltype='$splist' AND lactive='1' order by abs(lsort)";
	$resultls = mysql_query($sqlls, $dgz) or die(mysql_error());
	$totalls = mysql_num_rows($resultls);
	
	$ltopic = "ltopic".$sess_lg;
	$ldetail = "ldetail".$sess_lg;
	$lbuttext = "lbuttext".$sess_lg;
	$lbuturl = "lbuturl".$sess_lg;
	$lpath = $url."/admin/resources/list";
	
	if ($totalls > 0)	{
		echo '<div id="listacc">';
		while ($ls = mysql_fetch_array($resultls))	{
			$lsdetail = $ls[$ldetail];
			$lsdetail = str_replace("&quot;",'"',"$lsdetail");
			$lsdetail = str_replace("&rsquo;","'","$lsdetail");

			if ($ls[$lbuttext] != "" and $ls[$lbuturl] != "") $lslink = '<p class="listbutton"><a href="'.$ls[$lbuturl].'" target="_blank"><span>'.$ls[$lbuttext].'</span></a></p>'; else $lslink =  '';

			echo '
			<a id="ls'.$ls[lid].'" href="#ls'.$ls[lid].'" name="ls'.$ls[lid].'" class="listtopic"><h3>'.$ls[$ltopic].'</h3></a>
			<div class="listbox">
				<div class="slider-normal owl-carousel owl-theme">';

				$sqlg = "SELECT * FROM tb_gallery WHERE pid='{$ls[lid]}' AND gpage='{$ls[pid]}' order by abs(gsort)";
				$resultg = mysql_query($sqlg, $dgz) or die(mysql_error());
				$totalg = mysql_num_rows($resultg);
				if ($totalg > 0)	{
					while ($gs = mysql_fetch_array($resultg))	{
						$gtopic = "galt".$sess_lg;
		?>
					<div class="listboxpic item"><img src="<?php echo $lpath; ?>/gallery/<?php echo str_replace('th', '', $gs[gthumb]); ?>" alt="<?php echo $gs[$gtopic]; ?>" /></div>
		<?php
					}
				} else {
		?>
					<div class="listboxpic item"><img src="<?php echo $lpath.'/'.$ls[lpic]; ?>" alt="<?php echo $ls[$ltopic]; ?>" /></div>
		<?php
				}
			echo '</div>
				<div class="listboxdetail">'.$lsdetail.$lslink.'</div>
				<div class="clearline"></div>
			</div>';
		}
		echo '</div>';
	}
?>