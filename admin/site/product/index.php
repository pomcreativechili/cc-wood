<?php
	include("../../config/chksession.php");
	require_once("../../../Connections/dgz.php");

	// Clear Session
	unset($_SESSION['sess_pid']);
	unset($_SESSION['sess_cid']);
	unset($_SESSION['sess_srid']);
	
	$pid = $_GET['pid'];
	$cid = $_GET['cid'];
	$pn = $_GET['pn'];
	if ($pn == "") $pn = 0;

	// Amount to display
	$limit = 30;
	$start = $pn * $limit;
	$_SESSION['sess_padmin'] = "site/product/index.php?pid=$pid&cid=$cid";
	$pdpath = "../../resources/product";

	$sqlc = "select * from tb_category WHERE cid='$cid' AND pid='$pid'";
	$resultc = mysql_query($sqlc, $dgz) or die(mysql_error());
	$c = mysql_fetch_array($resultc);

	// List Information
	$sqlpd = "select * from tb_product WHERE pid=$pid AND cid='$cid'";
	$resultpd = mysql_query($sqlpd, $dgz) or die(mysql_error());
	$totalpd = mysql_num_rows($resultpd);
	$apage = $totalpd / $limit;

	$sql = $sqlpd." order by pdsort";
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
		<a href="../category/update.php?pid=<?php echo $pid;?>&amp;cid=<?php echo $cid;?>"><?php echo $c[ctitle_en];?></a> &nbsp;&gt;&nbsp; 
    	<strong>All Products</strong>
	</p>

	<div id="content">
		<form action="conn/sort.php" method="post" name="form1" id="form1"> 
		<?php 
			$pg = "product";
			include("../submenu.php");
		?>
		<table cellpadding="0" cellspacing="0" class="contentlist">
			<tr>
            	<th class="thtitle" colspan="8">
           		<input type="submit" name="Submit" value="Sort" class="butsort" />
				<input name="total" type="hidden" value="<?php echo $total;?>" />
				<input name="pid" type="hidden" value="<?php echo $pid;?>" />
				<input name="cid" type="hidden" value="<?php echo $cid;?>" /> &nbsp;
            	<img src="../../images/tools/view.png" alt="" />&nbsp; Amount of Products :&nbsp; <strong><?php echo $total;?></strong> &nbsp;&nbsp;
				<img src="../../images/tools/add.png" alt="" />&nbsp; <a href="add.php?pid=<?php echo $pid;?>&amp;cid=<?php echo $cid;?>">Post new Product</a>
                </th>
         	</tr>
			<tr>
				<th style="background-color:#d7d7d7; width:60px;">&nbsp;</th>
				<th style="background-color:#d7d7d7; width:80px;">#</th>
				<th style="background-color:#d7d7d7; width:120px;">Posted</th>
				<th style="background-color:#d7d7d7; text-align:left;">Title</th>
				<th style="background-color:#d7d7d7; width:60px;">Picture</th>
				<th style="background-color:#d7d7d7; width:60px;">Active</th>
				<th style="background-color:#d7d7d7; width:60px;">Order</th>
			</tr>
			<?php
				$count = $total;
				while ($rec = mysql_fetch_array($result))	{
					echo "
					<tr class='trc'>
						<td style='text-align:center'><input name='num$count' type='text' class='boxsort' value='$rec[pdsort]' onclick='this.select();'/><input name='id$count' type='hidden' value='$rec[pdid]' /></td>
						<td style='text-align:center'>$rec[pdid]</td>
						<td style='text-align:center'>$rec[pdposted]</td>
						<td><a href='update.php?pid=$pid&amp;cid=$cid&amp;pdid=$rec[pdid]'>$rec[pdtitle_en]</a></td>
						<td style='text-align:center'>"; 
						if ($rec[pdpic] == "") echo "No"; 
						else echo "<a href='$pdpath/".str_replace('th','',$rec[pdpic])."' class='largepic'><img src='../../images/tools/pic.png' alt='' /></a>"; 
					echo "</td>
						<td style='text-align:center'>";
						if ($rec[pdactive] == "0") echo "<a href='conn/status.php?pid=$pid&amp;cid=$cid&amp;pdid=$rec[pdid]&amp;status=1'><img src='../../images/tools/red.png' alt=''/></a> ";
						else if ($rec[pdactive] == "1") echo "<a href='conn/status.php?pid=$pid&amp;cid=$cid&amp;pdid=$rec[pdid]&amp;status=0'><img src='../../images/tools/green.png' alt=''/></a> ";
					echo "</td>
						<td style='text-align:center'>
							<a href='update.php?pid=$pid&amp;cid=$cid&amp;pdid=$rec[pdid]'><img src='../../images/tools/edit.png' alt='Update' /></a>
							<a href='conn/del.php?pid=$pid&amp;cid=$cid&amp;pdid=$rec[pdid]&amp;pdpic=$rec[pdpic]'' onclick=\"return confirm('Do you want to delete this product ?')\"><img src='../../images/tools/del.png' alt='Delete' /></a>
						</td>
					</tr>
					";
					$count--;
				}
			?>
		</table>
		<p class="pagenum">
		<?php 
			if ($totalpd % $limit > 0)	{	
				$num = 0;
				while ($num <= $apage)	{
					$pnum = $num + 1;
					if ($num == $pn) { echo "<a href='?pid=$pid&amp;cid=$cid&amp;pn=$num'><strong>$pnum</strong></a> | "; }
					else { echo "<a href='?pid=$pid&amp;cid=$cid&amp;pn=$num'>$pnum</a> | "; }
					$num++;
				}
			}	else	{
				$num = 0;
				while ($num < $apage)	{
					$pnum = $num + 1;
					if ($num == $pn) { echo "<a href='?pid=$pid&amp;cid=$cid&amp;pn=$num'><strong>$pnum</strong></a> | "; }
					else { echo "<a href='?pid=$pid&amp;cid=$cid&amp;pn=$num'>$pnum</a> | "; }
					$num++;
				}
			}
		?>
        </p>
        </form>
	</div>
</body>
</html>
