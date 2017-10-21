<?php
	include("../../config/chksession.php");
	require_once("../../../Connections/dgz.php");

	// Clear Session
	unset($_SESSION['sess_pid']);
	unset($_SESSION['sess_ltype']);
	unset($_SESSION['sess_lid']);
	
	$pid = "4000";
	$pn = $_GET['pn']; if ($pn == "") $pn = 0;
	
	// Amount to display
	$limit = 30;
	$start = $pn * $limit;
	$_SESSION['sess_padmin'] = "site/work/index.php?pn=$pn";
	$wpath = "../../resources/work";

	// Page Content
	include("../../config/page.info.php");

	// Work Information
	$sqlw = "select * from tb_work";
	$resultw = mysql_query($sqlw, $dgz) or die(mysql_error());
	$totalw = mysql_num_rows($resultw);
	$apage = $totalw / $limit;

	$sql = $sqlw." order by wsort LIMIT $start,$limit";
	$result = mysql_query($sql, $dgz) or die(mysql_error());
	$total = mysql_num_rows($result);
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
		<a href="../content/update.php?pid=<?php echo $pid;?>"><?php echo $p[ptopic_en];?></a> &nbsp;&gt;&nbsp; 
    	<strong>All Works</strong>
	</p>

	<div id="content">
		<form action="conn/sort.php" method="post" name="form1" id="form1"> 
		<?php 
			$pg = "work";
			include("../submenu.php");
		?>
		<table cellpadding="0" cellspacing="0" class="contentlist">
			<tr>
            	<th class="thtitle" colspan="7">
           		<input type="submit" name="Submit" value="Sort" class="butsort" />
				<input name="total" type="hidden" value="<?php echo $totalw;?>" /> &nbsp;
            	<img src="../../images/tools/view.png" alt="" />&nbsp; Amount of Works :&nbsp; <strong><?php echo $totalw;?></strong> &nbsp;&nbsp; 
                <img src="../../images/tools/add.png" alt="" />&nbsp; <a href="add.php">Post new Work</a>
                </th>
         	</tr>
			<tr>
				<th style="background-color:#d7d7d7; width:60px;">&nbsp;</th>
				<th style="background-color:#d7d7d7; width:80px;">#</th>
				<th style="background-color:#d7d7d7; width:140px;">Posted</th>
				<th style="background-color:#d7d7d7; text-align:left;">Title</th>
				<th style="background-color:#d7d7d7; width:60px;">Picture</th>
				<th style="background-color:#d7d7d7; width:60px;">Active</th>
				<th style="background-color:#d7d7d7; width:60px;">Order</th>
			</tr>
			<?php
				$count = $totalw;
				while ($rec = mysql_fetch_array($result))	{
					echo "
					<tr class='trc'>
						<td style='text-align:center'><input name='num$count' type='text' class='boxsort' value='$rec[wsort]' onclick='this.select();'/><input name='id$count' type='hidden' value='$rec[wid]' /></td>
						<td style='text-align:center'>$rec[wid]</td>
						<td style='text-align:center'>$rec[wposted]</td>
						<td><a href='update.php?wid=$rec[wid]'>$rec[wtitle_en]</a></td>
						<td style='text-align:center'>"; if ($rec[wpic] == "") echo "No"; else echo "<a href='$wpath/$rec[wpic]' class='largepic'><img src='../../images/tools/pic.png' alt='' /></a>"; echo "</td>
						<td style='text-align:center'>";
						if ($rec[wactive] == "0") echo "<a href='conn/status.php?wid=$rec[wid]&amp;status=1'><img src='../../images/tools/red.png' alt=''/></a> ";
						else if ($rec[wactive] == "1") echo "<a href='conn/status.php?wid=$rec[wid]&amp;status=0'><img src='../../images/tools/green.png' alt=''/></a> ";
					echo "</td>
						<td style='text-align:center'>
							<a href='update.php?wid=$rec[wid]'><img src='../../images/tools/edit.png' alt='Update' /></a>
							<a href='conn/del.php?wid=$rec[wid]&amp;wpic=$rec[wpic]'' onclick=\"return confirm('Do you want to delete this work ?')\"><img src='../../images/tools/del.png' alt='Delete' /></a>
						</td>
					</tr>
					";
					$count--;
				}
			?>
		</table>
		<p class="pagenum">
		<?php 
			if ($totalw % $limit > 0)	{	
				$num = 0;
				while ($num <= $apage)	{
					$pnum = $num + 1;
					if ($num == $pn) { echo "<a href='?pn=$num'><strong>$pnum</strong></a> | "; }
					else { echo "<a href='?pn=$num'>$pnum</a> | "; }
					$num++;
				}
			}	else	{
				$num = 0;
				while ($num < $apage)	{
					$pnum = $num + 1;
					if ($num == $pn) { echo "<a href='?pn=$num'><strong>$pnum</strong></a> | "; }
					else { echo "<a href='?pn=$num'>$pnum</a> | "; }
					$num++;
				}
			}
		?>
        </p>
        </form>
	</div>
</body>
</html>
