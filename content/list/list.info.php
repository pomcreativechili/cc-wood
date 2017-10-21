<?php
	if ($spid == "") $sqlls = "select * from tb_list WHERE pid='$pid' AND ltype='$plist' AND lactive='1' order by abs(lsort)";
	else $sqlls = "select * from tb_list WHERE pid='$spid' AND ltype='$splist' AND lactive='1' order by abs(lsort)";
	$resultls = mysql_query($sqlls, $dgz) or die(mysql_error());
	$totalls = mysql_num_rows($resultls);
	
	$ltopic = "ltopic".$sess_lg;
	$ldetail = "ldetail".$sess_lg;
	$lbuttext = "lbuttext".$sess_lg;
	$lbuturl = "lbuturl".$sess_lg;
	$lpath = $url."/admin/resources/list";
	
	if ($totalls > 0)	{
		echo '<div id="listinfo">';
		$lsnum = 0;
		while ($ls = mysql_fetch_array($resultls))	{
			$lsnum++;
			if ($lsnum % 2 == 0) $lseven = " listeven";
			else $lseven = "";
			
			echo '
			<div class="listbox'.$lseven.'">
				<p class="listboxthumb"><img src="'.$lpath.'/'.$ls[lpic].'" alt="'.$ls[$ltopic].'" /></p>
				<div class="listboxdetail">
					<h3>'.$ls[$ltopic].'</h3>
					<p>'.nl2br($ls[$ldetail]).'</p>';
					if ($ls[$lbuttext] != "" and $ls[$lbuturl] != "") echo '<p class="listbutton"><a href="'.$ls[$lbuturl].'" target="_blank"><span>'.$ls[$lbuttext].'</span></a></p>';				
			echo '
				</div>
				<div class="clearline"></div>
			</div>
			';
		}
		echo '</div>';
	}
?>