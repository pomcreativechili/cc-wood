<?php
	include("../../config/chksession.php");
	require_once("../../../Connections/dgz.php");

	// Clear Session
	unset($_SESSION['sess_pid']);
	unset($_SESSION['sess_gtype']);
	unset($_SESSION['sess_gpage']);
	unset($_SESSION['sess_gid']);

	$pid = $_GET['pid'];
	$gtype = $_GET['gtype'];
	$gpage = $_GET['gpage'];
	if ($gtype == "5") $pdid = $_GET['pdid'];
	$_SESSION['sess_padmin'] = "site/gallery/index.php?pid=$pid&gtype=$gtype&gpage=$gpage&pdid=$pdid";

	// Page Content
	if ($gtype == "1" or $gtype == "2")	{
		include("../../config/page.info.php");
		$gpath = "../../resources/pages/gallery";
	}	else if ($gtype == "3")	{
		$gcss = " gnews";
		$gpath = "../../resources/list/gallery";
		$sqlls = "select * from tb_list WHERE lid='$pid' AND pid='$gpage' AND (ltype='3' OR ltype='4')";
		$resultls = mysql_query($sqlls, $dgz) or die(mysql_error());
		$ls = mysql_fetch_array($resultls);
	}	else if ($gtype == "4")	{
		$gcss = " gwork";
		$gpath = "../../resources/work/gallery";
		$sqlw = "select * from tb_work WHERE wid='$pid'";
		$resultw = mysql_query($sqlw, $dgz) or die(mysql_error());
		$w = mysql_fetch_array($resultw);
	}	else if ($gtype == "5")	{
		$pdsql = " AND pdid='$pdid'";
		$gcss = " gshowroom";
		$gpath = "../../resources/product/gallery";
		$sqlpd = "select * from tb_product WHERE pid='$pid' AND cid='$gpage' AND pdid='$pdid'";
		$resultpd = mysql_query($sqlpd, $dgz) or die(mysql_error());
		$pd = mysql_fetch_array($resultpd);
	}
	
	if ($gpage != "") $gpagesql = " AND gpage='$gpage'";

	$sqlg = "select * from tb_gallery WHERE gtype='$gtype' AND pid='$pid'".$gpagesql.$pdsql." order by abs(gsort)";
	$resultg = mysql_query($sqlg, $dgz) or die(mysql_error());
	$totalg = mysql_num_rows($resultg);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../css/default.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<?php include("../menu.php"); ?>
	<p id="nav">
    	<?php
			if ($gpage != "")	{
				if ($gtype == "3") echo '<a href="../list/update.php?pid='.$gpage.'&amp;lid='.$pid.'">'.$ls[ltopic_en].'</a> &nbsp;&gt;&nbsp; ';
				else if ($gtype == "4") echo '<a href="../work/update.php?wid='.$pid.'">'.$w[wtitle_en].'</a> &nbsp;&gt;&nbsp; ';
				else if ($gtype == "5") echo '<a href="../product/update.php?pid='.$pid.'&amp;cid='.$gpage.'&amp;pdid='.$pdid.'">'.$pd[pdtitle_en].'</a> &nbsp;&gt;&nbsp; ';
				else echo '<a href="../content/update.php?pid='.$pid.'">'.$p[ptopic_en].'</a> &nbsp;&gt;&nbsp; ';
			}
		?>
        <strong>All Pictures</strong>
	</p>

	<div id="content">
		<form action="conn/sort.php" method="post" name="form1" id="form1"> 
		<?php 
			if ($gtype == "3")	{
				$lid = $pid;
				$ltype = $ls[ltype];
			}	else if ($gtype == "4")	{
				$wid = $pid;
			}	else if ($gtype == "5")	{
				$cid = $gpage;
			}
			$pg = "gallery";
			include("../submenu.php");
		?>
		<table cellpadding="0" cellspacing="0" class="contentlist">
			<tr>
				<th class="thtitle">
                <input type="submit" name="Submit" value="Sort" class="butsort" />
                <input name="total" type="hidden" value="<?php echo $totalg;?>" />
                <input name="pid" type="hidden" value="<?php echo $pid;?>" />
                <input name="pdid" type="hidden" value="<?php echo $pdid;?>" />
                <input name="gpage" type="hidden" value="<?php echo $gpage;?>" />
                <input name="gtype" type="hidden" value="<?php echo $gtype;?>" /> &nbsp;
                <img src="../../images/tools/view.png" alt="" />&nbsp; Amount of Pictures :&nbsp; <strong><?php echo $totalg;?></strong> &nbsp;&nbsp;
                <?php if (($gtype != "4") or ($gtype == 4 and $totalg < 6)) { ?><img src="../../images/tools/add.png" alt="" />&nbsp; <a href="add.php?pid=<?php echo $pid;?>&amp;gtype=<?php echo $gtype;?>&amp;gpage=<?php echo $gpage;?>&amp;pdid=<?php echo $pdid;?>">Add new Picture</a><?php } ?>
				</th>
			</tr>
			<tr><th style="background-color:#d7d7d7;">All Pictures</th></tr>
            <tr><td style="padding-top:15px;">
			<?php
				$count = $totalg;
				while ($g = mysql_fetch_array($resultg))	{
					echo "
					<div class='gallerylist".$gcss."'>
						<p>"; 
						if ($g[gtype] == "2" or $g[gtype] == "5") echo "<a href='$gpath/$g[glarge]' title='$g[galt_en]' class='largepic' rel='group'>";
						echo "<img src='$gpath/$g[gthumb]' alt='' />";
						if ($g[gtype] == "2" or $g[gtype] == "5") echo "</a>";
						echo "</p>
						<p>
							<input name='num$count' type='text' class='boxsort' value='$g[gsort]' onclick='this.select();'/><input name='id$count' type='hidden' value='$g[gid]' /> 
							<a href='conn/del.php?pid=$pid&amp;gtype=$gtype&amp;gpage=$gpage&amp;gid=$g[gid]&amp;pdid=$pdid&amp;gthumb=$g[gthumb]&amp;glarge=$g[glarge]'' onclick=\"return confirm('Do you want to delete this picture ?')\"><img src='../../images/tools/del.png' alt='Delete' /></a>
						</p>
					</div>
					";
					$count--;
				}
			?>
            </td></tr>
		</table>
        </form>
	</div>
</body>
</html>
