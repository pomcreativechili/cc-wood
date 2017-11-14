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
			if ($spg == "" and $npg == "" and $sbpg == "")	{
				$mnspurl = $p[purl].'/';
			}	else if ($spg != "" or $npg != "" or $sbpg != "")	{
				if ($mnsp[plist] == "1") $mnspurl = $url.$lgurl.'/'.$p[purl].'/';
				else $mnspurl = $url.$lgurl.'/'.$p[purl].'#'.$p[purl].'/';
			}

			// List menu
			// if ($mnsp[plist] == "1") $plist_class = ''; else $plist_class = '';
   //          echo '<li>';
   //          if ($mnsp[pid] == $spid) echo '<h1 class="mnspselect tp'.$pid.$plist_class.'">'; else  echo '<a href="'.$url.$lgurl.'/'.$p[purl].'/'.$mnsp[purl].'" class="mnnormal tp'.$pid.$plist_class.'">';
			// echo $mnsp[$mnspmenu];
			// if ($mnsp[pid] == $spid) echo '</h1>'; else echo '</a>';
			if ($mnsp[pid] == $spid) $plist_class = ' mnspselect'; else $plist_class = '';
			echo '<li>';
			echo '<a href="'.$url.$lgurl.'/'.$p[purl].'/'.$mnsp[purl].'" class="mnnormal tp'.$pid.$plist_class.'">'.$mnsp[$mnspmenu].'</a>';

			$sublist = array();
			if ($mnsp[plist] != "0") {

				if ($splist == "1" or $splist == "4") {
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
				} else if ($splist == "W") {
					// Work
					$sqlls = "SELECT * FROM tb_work WHERE pid='{$mnsp[pid]}' AND wactive='1' ORDER BY wsort";
					$resultls = mysql_query($sqlls, $dgz) or die(mysql_error());
					$totalls = mysql_num_rows($resultls);
					
					$lprefix = "sr";
					$lid = "wid";
					$ltopic = "wtitle".$sess_lg;
					//$pdtitle = "pdtitle".$sess_lg;
					$lpath = $url."/admin/resources/work";
				}
				
				if ($totalls > 0)	{
					echo '<ul class="listacc">';
					$submenu = 0;
					while ($ls = mysql_fetch_array($resultls))	{
						$lsdetail = $ls[$ldetail];
						$lsdetail = str_replace("&quot;",'"',"$lsdetail");
						$lsdetail = str_replace("&rsquo;","'","$lsdetail");

						if ( $submenu == 0 and $spid == $mnsp[pid] ) $submenu_class = 'mnspselect'; else $submenu_class = '';

						//if ($spid != $ls[pid]) $suburl = $mnspurl.$mnsp[purl].'#ls'.$ls[lid]; else $suburl = 'javascript:;';

						if ( $lid == "wid" ) {
							echo '<li><a href="#projectgallery-'.$ls[$lid].'" name="'.$lprefix.$ls[$lid].'" class="'.$submenu_class.' listtopic">'.$ls[$ltopic].'</a></li>';
						} else {
							echo '<li><a href="javascript:;" name="'.$lprefix.$ls[$lid].'" class="'.$submenu_class.' listtopic">'.$ls[$ltopic].'</a></li>';
						}

						//$sublist[] = array( 'lid' => $ls[lid], 'ltopic' => $ltopic, 'ldetail' => $ldetail, 'lpath' => $lpath, 'lpic' => $ls[lpic], 'lbuttext' => $ls[$lbuttext], 'lbuturl' => $lbuturl );

						$submenu++;
					}
					echo '</ul>';
				}
			}

			echo '</li>';
        }
    ?>
    </ul>
</div>