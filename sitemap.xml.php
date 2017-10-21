<?php 
	include("Connections/dgz.php");

	// Header
	header("Content-type:text/xml; charset=UTF-8");                
	header("Cache-Control: no-store, no-cache, must-revalidate");               
	header("Cache-Control: post-check=0, pre-check=0", false); 
	echo '<?xml version="1.0" encoding="UTF-8"?>';
	echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" 
			xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
			xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

	echo '
	<url><loc>'.$url.'</loc></url>
	<url><loc>'.$url.'/th</loc></url>
	';

	// Main Page
	$sqlmp = "select * from tb_page WHERE pmp='' AND psp='' AND ptype!='0' ORDER BY pid";
	$resultmp = mysql_query($sqlmp, $dgz) or die(mysql_error());
	while ($mp = mysql_fetch_array($resultmp))	{
		echo '
		<url><loc>'.$url.'/'.$mp[purl].'</loc></url>
		<url><loc>'.$url.'/th/'.$mp[purl].'</loc></url>
		';

		// Content Page
		$sqlcp = "select * from tb_page WHERE pmp='$mp[pid]' AND psp='' ORDER BY abs(pid)";
		$resultcp = mysql_query($sqlcp, $dgz) or die(mysql_error());
		$totalcp = mysql_num_rows($resultcp);
		if ($totalcp > 0)	{
			while ($cp = mysql_fetch_array($resultcp))	{
				echo '
				<url><loc>'.$url.'/'.$mp[purl].'/'.$cp[purl].'</loc></url>
				<url><loc>'.$url.'/th/'.$mp[purl].'/'.$cp[purl].'</loc></url>
				';

				// Content - Sub Page
				$sqlscp = "select * from tb_page WHERE pmp='$mp[pid]' AND psp='$cp[pid]' ORDER BY abs(pid)";
				$resultscp = mysql_query($sqlscp, $dgz) or die(mysql_error());
				$totalscp = mysql_num_rows($resultscp);
				if ($totalscp > 0)	{
					while ($scp = mysql_fetch_array($resultscp))	{
						echo '
						<url><loc>'.$url.'/'.$mp[purl].'/'.$cp[purl].'/'.$scp[purl].'</loc></url>
						<url><loc>'.$url.'/th/'.$mp[purl].'/'.$cp[purl].'/'.$scp[purl].'</loc></url>
						';
					}
				}

				// Products - Category
				$sqlpdc = "select * from tb_category WHERE pid='$cp[pid]' AND cactive='1' ORDER BY abs(csort)";
				$resultpdc = mysql_query($sqlpdc, $dgz) or die(mysql_error());
				$totalpdc = mysql_num_rows($resultpdc);
				if ($totalpdc > 0)	{
					while ($pdc = mysql_fetch_array($resultpdc))	{
						// Products - List
						$sqlpdi = "select * from tb_product WHERE pid='$cp[pid]' AND cid='$pdc[cid]' AND pdactive='1' ORDER BY abs(pdsort)";
						$resultpdi = mysql_query($sqlpdi, $dgz) or die(mysql_error());
						$totalpdi = mysql_num_rows($resultpdi);
						if ($totalpdi > 0)	{
							while ($pdi = mysql_fetch_array($resultpdi))	{
								echo '
								<url><loc>'.$url.'/'.$mp[purl].'/'.$cp[purl].'/'.$pdc[curl].'/'.$pdi[pdurl].'.html</loc></url>
								<url><loc>'.$url.'/th/'.$mp[purl].'/'.$cp[purl].'/'.$pdc[curl].'/'.$pdi[pdurl].'.html</loc></url>
								';
							}
						}
					}
				}


				// News
				$sqln = "select * from tb_list WHERE pid='$cp[pid]' AND lactive='1' ORDER BY abs(lsort)";
				$resultn = mysql_query($sqln, $dgz) or die(mysql_error());
				$totaln = mysql_num_rows($resultn);
				if ($totaln > 0)	{
					while ($n = mysql_fetch_array($resultn))	{
						echo '
						<url><loc>'.$url.'/'.$mp[purl].'/'.$cp[purl].'/'.$n[lurl].'.html</loc></url>
						<url><loc>'.$url.'/th/'.$mp[purl].'/'.$cp[purl].'/'.$n[lurl].'.html</loc></url>
						';
					}
				}

			}
		}

		// Work
		if ($mp[pid] == "4000")	{
			$sqlw = "select * from tb_work WHERE wactive='1' ORDER BY abs(wsort)";
			$resultw = mysql_query($sqlw, $dgz) or die(mysql_error());
			while ($w = mysql_fetch_array($resultw))	{
				echo '
				<url><loc>'.$url.'/'.$mp[purl].'/'.$w[wurl].'.html</loc></url>
				<url><loc>'.$url.'/th/'.$mp[purl].'/'.$w[wurl].'.html</loc></url>
				';
			}
		}
	}

	// Close XML
	echo '</urlset>';
?>