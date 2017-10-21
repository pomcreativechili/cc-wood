<?php
	include("../../config/chksession.php");
	require_once("../../../Connections/dgz.php");

	$pid = $_GET['pid'];
	$_SESSION['sess_padmin'] = "site/category/index.php?pid=$pid";

	// Page Information
	include("../../config/page.info.php");

	$sql = "select * from tb_category WHERE pid='$pid' order by csort";
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
    	<a href="index.php?pid=<?php echo $pid;?>"><strong>All Categories</strong></a>
    </p>

	<div id="content">
		<form action="conn/sort.php" method="post" name="form1" id="form1"> 
		<?php 
			$pg = "showroom";
			include("../submenu.php");
		?>
		<table cellpadding="0" cellspacing="0" class="contentlist">
			<tr>
            	<th class="thtitle" colspan="7">
           		<input type="submit" name="Submit" value="Sort" class="butsort" />
				<input name="pid" type="hidden" value="<?php echo $pid;?>" />
				<input name="total" type="hidden" value="<?php echo $total;?>" /> &nbsp;
            	<img src="../../images/tools/view.png" alt="" />&nbsp; Amount of Categories :&nbsp; <strong><?php echo $total;?></strong> &nbsp;&nbsp;
				<img src="../../images/tools/add.png" alt="" />&nbsp; <a href="add.php?pid=<?php echo $pid;?>">Post new Category</a>
                </th>
         	</tr>
			<tr>
				<th style="background-color:#d7d7d7; width:60px;">&nbsp;</th>
				<th style="background-color:#d7d7d7; width:80px;">#</th>
				<th style="background-color:#d7d7d7; width:120px;">Posted</th>
				<th style="background-color:#d7d7d7; text-align:left;">Title</th>
                <th style="background-color:#d7d7d7; width:60px;">Products</th>
				<th style="background-color:#d7d7d7; width:60px;">Active</th>
				<th style="background-color:#d7d7d7; width:80px;">Order</th>
			</tr>
			<?php
				$count = $total;
				while ($rec = mysql_fetch_array($result))	{
					// Product
					$sqlpd = "select * from tb_product WHERE pid='$pid' AND cid='$rec[cid]'";
					$resultpd = mysql_query($sqlpd, $dgz) or die(mysql_error());
					$totalpd = mysql_num_rows($resultpd);
					
					echo "
					<tr class='trc'>
						<td style='text-align:center'><input name='num$count' type='text' class='boxsort' value='$rec[csort]' onclick='this.select();'/><input name='id$count' type='hidden' value='$rec[cid]' /></td>
						<td style='text-align:center'>$rec[cid]</td>
						<td style='text-align:center'>$rec[cposted]</td>
						<td><a href='update.php?pid=$pid&amp;cid=$rec[cid]'>$rec[ctitle_en]</a></td>
						<td style='text-align:center'><a href='../product/index.php?pid=$pid&amp;cid=$rec[cid]'><img src='../../images/tools/view.png' alt='Products' /></a> ($totalpd)</td>
						<td style='text-align:center'>";
						if ($rec[cactive] == "0") echo "<a href='conn/status.php?pid=$pid&amp;cid=$rec[cid]&amp;status=1'><img src='../../images/tools/red.png' alt=''/></a> ";
						else if ($rec[cactive] == "1") echo "<a href='conn/status.php?pid=$pid&cid=$rec[cid]&amp;status=0'><img src='../../images/tools/green.png' alt=''/></a> ";
					echo "</td>
						<td style='text-align:center'>
						<a href='update.php?pid=$pid&amp;cid=$rec[cid]'><img src='../../images/tools/edit.png' alt='Update' /></a>
						<a href='conn/del.php?pid=$pid&amp;cid=$rec[cid]'' onclick=\"return confirm('Do you want to delete this category ?')\"><img src='../../images/tools/del.png' alt='Delete' /></a>
						</td>
					</tr>
					";
					$count--;
				}
			?>
		</table>
        </form>
	</div>
</body>
</html>
