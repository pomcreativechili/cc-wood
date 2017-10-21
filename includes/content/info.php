<?php 
	$pg = 		$_GET['pg'];	// Main page
	$spg = 		$_GET['spg'];	// Sub page
	$sbpg = 	$_GET['sbpg'];	// Sub of sub page
	$npg = 		$_GET['npg']; 	// News
	$srcpg = 	$_GET['srcpg'];	// Showroom - Category
	$srppg = 	$_GET['srppg'];	// Showroom - Product
	$wpg = 		$_GET['wpg'];	// Work

	// Main page information
	if ($pg != "")	{
		$sqlp = "select * from tb_page WHERE purl like '$pg'";
		$headercss = ' class="headerpage"';
	}	else	{
		$sqlp = "select * from tb_page WHERE pid = '0000'";
		$headercss = '';
	}
	$resultp = mysql_query($sqlp, $dgz) or die(mysql_error());
	$totalp = mysql_num_rows($resultp);
	$p = mysql_fetch_array($resultp);
	
	if ($totalp == 0) { echo "<meta http-equiv=\"refresh\"content=\"0; URL=".$url."\">"; exit(); }

	$ptitle =	"ptitle".$sess_lg;
	$pdesc = 	"pdesc".$sess_lg;
	$pkeys = 	"pkeys".$sess_lg;
	$ptopic = 	"ptopic".$sess_lg;
	$pintro = 	"pintro".$sess_lg;
	$pdetail = 	"pdetail".$sess_lg;
	$ppath =	$url."/admin/resources/pages";

	$pid = 		$p[pid];
	$purl = 	$p[purl];
	$ptype = 	$p[ptype];
	$plist = 	$p[plist];
	$pgallery =	$p[pgallery];
	$ptitle = 	$p[$ptitle];
	$pdesc = 	$p[$pdesc];
	$pkeys = 	$p[$pkeys];
	$ptopic = 	$p[$ptopic];
	$ppic = 	$ppath.'/'.$p[ppic];
	$pdetail = 	$p[$pdetail];
	$pdetail = 	str_replace("&quot;",'"',"$pdetail");
	$pdetail = 	str_replace("&rsquo;","'","$pdetail");
	
	// Sub page information
	if ($spg != "" or ($spg == "" and $ptype == "1"))	{
		if ($spg != "") $sqlsp = "select * from tb_page WHERE pmp='$pid' AND purl like '$spg'";
		else $sqlsp = "select * from tb_page WHERE pmp='$pid' ORDER BY pid";
		$resultsp = mysql_query($sqlsp, $dgz) or die(mysql_error());
		$totalsp = mysql_num_rows($resultsp);
		$sp = mysql_fetch_array($resultsp);
		
		if ($totalsp == 0) { echo "<meta http-equiv=\"refresh\"content=\"0; URL=".$url."/".$purl."\">"; exit(); }

		$spmenu = 	"pmenu".$sess_lg;
		$sptopic = 	"ptopic".$sess_lg;
		$spdetail = "pdetail".$sess_lg;
	
		$spid =			$sp[pid];
		$sptype =		$sp[ptype];
		$splist = 		$sp[plist];
		$spgallery =	$sp[pgallery];
		$sptopic = 		$sp[$sptopic];
		$spdetail = 	$sp[$spdetail];
		$spdetail = 	str_replace("&quot;",'"',"$spdetail");
		$spdetail = 	str_replace("&rsquo;","'","$spdetail");

		if ($spg != "" and $sptype != "5") $ptitle = $sp[$spmenu].' | '.$ptitle;
		else $ptitle = $sptopic.' | '.$ptitle;
	}
	
	// Sub of sub page information
	if ($sbpg != "" and $pid != "2000")	{
		$sqlsbp = "select * from tb_page WHERE pmp='$pid' AND psp='$spid' AND purl like '$sbpg'";
		$resultsbp = mysql_query($sqlsbp, $dgz) or die(mysql_error());
		$totalsbp = mysql_num_rows($resultsbp);
		$sbp = mysql_fetch_array($resultsbp);
		
		if ($totalsbp == 0) { echo "<meta http-equiv=\"refresh\"content=\"0; URL=".$url."/".$purl."#".$purl.$sp[purl]."\">"; exit(); }

		$sbptopic = 	"ptopic".$sess_lg;
		$sbpdetail = 	"pdetail".$sess_lg;
	
		$sbpid = 		$sbp[pid];
		$sbplist = 		$sbp[plist];
		$sbptopic =		$sbp[$sbptopic];
		$sbpdetail = 	$sbp[$sbpdetail];
		$sbpdetail = 	str_replace("&quot;",'"',"$sbpdetail");
		$sbpdetail = 	str_replace("&rsquo;","'","$sbpdetail");
		$ptitle = 		$sbptopic." - ".$ptitle;
	}

	// News
	if ($npg != "")	{
		$sqlnp = "select * from tb_list WHERE lurl like '$npg' AND pid='$spid' AND ltype='$splist'";
		$resultnp = mysql_query($sqlnp, $dgz) or die(mysql_error());
		$totalnp = mysql_num_rows($resultnp);
		$np = mysql_fetch_array($resultnp);
		
		if ($totalnp == 0) { echo "<meta http-equiv=\"refresh\"content=\"0; URL=".$url."/".$purl."#".$purl.$sp[purl]."\">"; exit(); }

		$nptopic = 	"ltopic".$sess_lg;
		$npdetail = "ldetail".$sess_lg;
		$nppath =	$url."/admin/resources/list";
	
		$npid =		$np[lid];
		$nptopic =  $np[$nptopic];
		$npdetail = $np[$npdetail];
		$npdetail = str_replace("&quot;",'"',"$npdetail");
		$npdetail = str_replace("&rsquo;","'","$npdetail");
		$ptitle = 	$nptopic." - ".$ptitle;
	}
	
	// Showroom
	if ($srcpg != "" and $srppg != "")	{
		// Category
		$sqlsrc = "select * from tb_category WHERE curl like '$srcpg' AND pid='$spid'";
		$resultsrc = mysql_query($sqlsrc, $dgz) or die(mysql_error());
		$src = mysql_fetch_array($resultsrc);

		$ctitle = "ctitle".$sess_lg;
		$cdetail = "cdetail".$sess_lg;

		// Product
		$sqlsrp = "select * from tb_product WHERE pdurl like '$srppg' AND cid='$src[cid]' AND pid='$spid'";
		$resultsrp = mysql_query($sqlsrp, $dgz) or die(mysql_error());
		$srp = mysql_fetch_array($resultsrp);
		$pdtitle = "pdtitle".$sess_lg;
		$pddetail = "pddetail".$sess_lg;
		$pdpath = $url."/admin/resources/product";
		$ptitle = 	$srp[$pdtitle]." - ".$src[$ctitle]." - ".$ptitle;
	}
	
	// Work
	if ($wpg != "")	{
		$sqlw = "select * from tb_work WHERE wurl like '$wpg'";
		$resultw = mysql_query($sqlw, $dgz) or die(mysql_error());
		$w = mysql_fetch_array($resultw);
		
		$wtitle = "wtitle".$sess_lg;
		$wtopic1 = "wtopic1".$sess_lg;
		$wtext1 = "wtext1".$sess_lg;
		$wtopic2 = "wtopic2".$sess_lg;
		$wtext2 = "wtext2".$sess_lg;
		$wtopic3 = "wtopic3".$sess_lg;
		$wtext3 = "wtext3".$sess_lg;
		$wtopic4 = "wtopic4".$sess_lg;
		$wtext4 = "wtext4".$sess_lg;
		$wdetail = "wdetail".$sess_lg;
		$wpath = $url."/admin/resources/work/gallery";
		
		$ptitle = 	$w[$wtitle]." - ".$ptitle;

		$sqlwg = "select * from tb_gallery WHERE pid='$w[wid]' AND gtype='4' AND gpage='$pid' order by abs(gsort)";
		$resultwg = mysql_query($sqlwg, $dgz) or die(mysql_error());
		$totalwg = mysql_num_rows($resultwg);

		$wgalt = "galt".$sess_lg;
	}
?>