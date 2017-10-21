<?php 
	// List of all top and footer menus
	$sqlmn = "select * from tb_page WHERE psp='' ORDER BY abs(pid)";
	$resultmn = mysql_query($sqlmn, $dgz);
	$mnmenu = "pmenu".$sess_lg;
	while ($mn = mysql_fetch_array($resultmn))	{
		$mntxt[$mn[pid]]['url'] = $mn['purl'];
		$mntxt[$mn[pid]]['text'] = $mn[$mnmenu];
	}
?>