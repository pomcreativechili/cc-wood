<div id="wrapper"></div>
<!-- <h2 class="infomenutopic"><?php echo $ptopic;?></h2> -->

<div id="infomenu"<?php if ($npg != "") echo ' class="nomargin"';?>>
    <ul>
    <?php
        $sqlmnsp = "select * from tb_page WHERE pmp='$pid' order by abs(pid)";
        $resultmnsp = mysql_query($sqlmnsp, $dgz) or die(mysql_error());
		$totalmnsp = mysql_num_rows($resultmnsp);

        $mnspmenu = "pmenu".$sess_lg;
	
        while ($mnsp = mysql_fetch_array($resultmnsp))	{
			// URL
			if ($spg == "" and $npg == "" and $sbpg == "")	{
				$mnspurl = $p[purl].'/';
			}	else if ($spg != "" or $npg != "" or $sbpg != "")	{
				if ($mnsp[plist] == "1") $mnspurl = $url.$lgurl.'/'.$p[purl].'/';
				else $mnspurl = $url.$lgurl.'/'.$p[purl].'#'.$p[purl].'/';
			}

			// List menu
            echo '<li><a href="'.$mnspurl.$mnsp[purl].'"'; 
			if ($mnsp[plist] == "1") echo ' class="'; else echo ' class="mnnormal ';
			if ($mnsp[pid] == $spid) echo 'mnspselect tp'.$pid.'"'; else echo 'tp'.$pid.'"';
			echo '">'.$mnsp[$mnspmenu].'</a></li>';
        }
    ?>
    </ul>
</div>