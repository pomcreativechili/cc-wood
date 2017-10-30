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

			echo '
			<a id="ls'.$ls[lid].'" href="#ls'.$ls[lid].'" name="ls'.$ls[lid].'" class="listtopic"><h3>'.$ls[$ltopic].'</h3></a>
			<div class="listbox">
				<p class="listboxpic"><img src="'.$lpath.'/'.$ls[lpic].'" alt="'.$ls[$ltopic].'" /></p>
				<div class="listboxdetail flexcroll">'.$lsdetail;
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