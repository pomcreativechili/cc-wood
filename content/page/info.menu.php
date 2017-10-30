<div id="wrapper"></div>
<div id="infomenu"<?php if ($npg != "") echo ' class="nomargin"';?>>
    <ul>
    <?php
        $sqlmnsp = "select *, IF (psp = '', pid, psp) AS page_sorting from tb_page WHERE pmp='$pid' order by page_sorting";
        $resultmnsp = mysql_query($sqlmnsp, $dgz) or die(mysql_error());
		$totalmnsp = mysql_num_rows($resultmnsp);

        $mnspmenu = "ptopic".$sess_lg;
	
        while ($mnsp = mysql_fetch_array($resultmnsp))	{
			// URL
			// if ($spg == "" and $npg == "" and $sbpg == "")	{
			// 	$mnspurl = $p[purl].'/';
			// }	else if ($spg != "" or $npg != "" or $sbpg != "")	{
			// 	if ($mnsp[plist] == "1") $mnspurl = $url.$lgurl.'/'.$p[purl].'/';
			// 	else $mnspurl = $url.$lgurl.'/'.$p[purl].'#'.$p[purl].'/';
			// }

			// List menu
            echo '<li><a href="'.$url.$lgurl.'/'.$p[purl].'/'.$mnsp[purl].'"'; 
			if ($mnsp[plist] == "1") echo ' class="'; else echo ' class="mnnormal ';
			if ($mnsp[pid] == $spid) echo 'mnspselect tp'.$pid.'"'; else echo 'tp'.$pid.'"';
			echo '">'.$mnsp[$mnspmenu].'</a>';

			$sublist = array();
			if ($mnsp[plist] != "0" and $spid == $mnsp[pid]) {

				if ($splist == "1") {
					//Sublist
					if ($sbpid != "") $sqlls = "select * from tb_list WHERE pid='{$mnsp[pid]}' AND ltype='{$mnsp[plist]}' AND lactive='1' order by abs(lsort)";
					else $sqlls = "select * from tb_list WHERE pid='{$mnsp[pid]}' AND ltype='{$mnsp[plist]}' AND lactive='1' order by abs(lsort)";
					$resultls = mysql_query($sqlls, $dgz) or die(mysql_error());
					$totalls = mysql_num_rows($resultls);
					
					$lprefix = "ls";
					$lid = "lid";
					$ltopic = "ltopic".$sess_lg;
					$ldetail = "ldetail".$sess_lg;
					$lbuttext = "lbuttext".$sess_lg;
					$lbuturl = "lbuturl".$sess_lg;
					$lpath = $url."/admin/resources/list";
				} else if ($splist == "S") {
					// Showroom
					$sqlls = "select tb_category.*, ";
					$sqlls .= "(select count(tb_product.pdid) FROM tb_product WHERE tb_product.cid=tb_category.cid AND tb_product.pid='{$mnsp[pid]}' AND tb_product.pdactive='1') as pdamount from tb_category ";
					$sqlls .= "WHERE pid='{$mnsp[pid]}' AND cactive='1' order by abs(csort)";
					$resultls = mysql_query($sqlls, $dgz) or die(mysql_error());
					$totalls = mysql_num_rows($resultls);
					
					$lprefix = "sr";
					$lid = "cid";
					$ltopic = "ctitle".$sess_lg;
					//$pdtitle = "pdtitle".$sess_lg;
					$lpath = $url."/admin/resources/product";
				}
				
				if ($totalls > 0)	{
					echo '<ul class="listacc">';
					while ($ls = mysql_fetch_array($resultls))	{
						$lsdetail = $ls[$ldetail];
						$lsdetail = str_replace("&quot;",'"',"$lsdetail");
						$lsdetail = str_replace("&rsquo;","'","$lsdetail");

						//if ($spid != $ls[pid]) $suburl = $mnspurl.$mnsp[purl].'#ls'.$ls[lid]; else $suburl = 'javascript:;';


						echo '<li><a href="javascript:;" name="'.$lprefix.$ls[$lid].'" class="listtopic">'.$ls[$ltopic].'</a></li>';

						//$sublist[] = array( 'lid' => $ls[lid], 'ltopic' => $ltopic, 'ldetail' => $ldetail, 'lpath' => $lpath, 'lpic' => $ls[lpic], 'lbuttext' => $ls[$lbuttext], 'lbuturl' => $lbuturl );
					}
					echo '</ul>';
				}
			}

			echo '</li>';
        }
    ?>
    </ul>
</div>