<?php
	include("../../config/chksession.php");
	require_once("../../../Connections/dgz.php");

	// Clear Session
	unset($_SESSION['sess_hid']);

	$htype = $_GET['htype'];
	$pn = $_GET['pn']; if ($pn == "") $pn = 0;

	$limit = 30;
	$start = $pn * $limit;
	$_SESSION['sess_padmin'] = "site/home/index.php?htype=$htype&pn=$pn";

	// Page Information
	$pid = "0000";
	include("../../config/page.info.php");

	$sqlh = "select * from tb_home WHERE htype='$htype'";
	$resulth = mysql_query($sqlh, $dgz) or die(mysql_error());
	$totalh = mysql_num_rows($resulth);
	$apage = $totalh / $limit;

	$sql = $sqlh." order by hsort LIMIT $start,$limit";
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
	<p id="nav"><strong>All <?php echo $htext;?>s</strong></p>

	<div id="content">
		<form action="conn/sort.php" method="post" name="form1" id="form1"> 
		<table cellpadding="0" cellspacing="0" class="contentlist">
			<tr>
            	<th class="thtitle" colspan="6">
           		<input type="submit" name="Submit" value="Sort" class="butsort" />
				<input name="htype" type="hidden" value="<?php echo $htype;?>" />
				<input name="total" type="hidden" value="<?php echo $total;?>" /> &nbsp;
            	<img src="../../images/tools/view.png" alt="" />&nbsp; Amount of <?php echo $htext;?>s :&nbsp; <strong><?php echo $totalh;?></strong> &nbsp;&nbsp;
                <img src="../../images/tools/add.png" alt="" />&nbsp; <a href="add.php?htype=<?php echo $htype;?>">Post new <?php echo $htext;?></a>
                </th>
         	</tr>
			<tr>
				<th style="background-color:#d7d7d7; width:60px;">&nbsp;</th>
				<th style="background-color:#d7d7d7; width:80px;">#</th>
				<th style="background-color:#d7d7d7; width:140px;">Posted</th>
				<th style="background-color:#d7d7d7; text-align:left;">Title</th>
				<th style="background-color:#d7d7d7; width:60px;">Active</th>
				<th style="background-color:#d7d7d7; width:60px;">Order</th>
			</tr>
			<?php
				$count = $total;
				while ($rec = mysql_fetch_array($result))	{
					echo "
					<tr class='trc'>
						<td style='text-align:center'><input name='num$count' type='text' class='boxsort' value='$rec[hsort]' onclick='this.select();'/><input name='id$count' type='hidden' value='$rec[hid]' /></td>
						<td style='text-align:center'>$rec[hid]</td>
						<td style='text-align:center'>$rec[hposted]</td>
						<td><a href='update.php?htype=$htype&amp;hid=$rec[hid]'>$rec[htitle_en]</a></td>
						<td style='text-align:center'>";
						if ($rec[hactive] == "0") echo "<a href='conn/status.php?htype=$htype&amp;hid=$rec[hid]&amp;status=1'><img src='../../images/tools/red.png' alt=''/></a>";
						else if ($rec[hactive] == "1") echo "<a href='conn/status.php?htype=$htype&amp;hid=$rec[hid]&amp;status=0'><img src='../../images/tools/green.png' alt=''/></a>";
					echo "</td>
						<td style='text-align:center'>
							<a href='update.php?htype=$htype&amp;hid=$rec[hid]'><img src='../../images/tools/edit.png' alt='Update' /></a>
							<a href='conn/del.php?htype=$htype&amp;hid=$rec[hid]&amp;hpic=$rec[hpic]'' onclick=\"return confirm('Do you want to delete this ".$htext." ?')\"><img src='../../images/tools/del.png' alt='Delete' /></a>
						</td>
					</tr>
					";
					$count--;
				}
			?>
		</table>
		<p class="pagenum">
		<?php 
			if ($totalh % $limit > 0)	{	
				$num = 0;
				while ($num <= $apage)	{
					$pnum = $num + 1;
					if ($num == $pn) echo "<a href='?htype=$htype&amp;pn=$num'><strong>$pnum</strong></a> | ";
					else echo "<a href='?htype=$htype&amp;pn=$num'>$pnum</a> | ";
					$num++;
				}
			}	else	{
				$num = 0;
				while ($num < $apage)	{
					$pnum = $num + 1;
					if ($num == $pn) echo "<a href='?htype=$htype&amp;pn=$num'><strong>$pnum</strong></a> | ";
					else echo "<a href='?htype=$htype&amp;pn=$num'>$pnum</a> | ";
					$num++;
				}
			}
		?>
        </p>
        </form>
	</div>
</body>
</html>
