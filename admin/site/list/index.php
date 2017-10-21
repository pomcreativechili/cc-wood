<?php
	include("../../config/chksession.php");
	require_once("../../../Connections/dgz.php");

	// Clear Session
	unset($_SESSION['sess_pid']);
	unset($_SESSION['sess_ltype']);
	unset($_SESSION['sess_lid']);
	
	$pid = $_GET['pid'];
	$pn = $_GET['pn'];
	if ($pn == "") $pn = 0;
	
	// Amount to display
	$limit = 30;
	$start = $pn * $limit;
	$_SESSION['sess_padmin'] = "site/list/index.php?pid=$pid&pn=$pn";
	$lpath = "../../resources/list";

	// Page Content
	include("../../config/page.info.php");

	// List Information
	$sqlls = "select * from tb_list WHERE pid='$pid' AND ltype='$p[plist]'";
	$resultls = mysql_query($sqlls, $dgz) or die(mysql_error());
	$totalls = mysql_num_rows($resultls);
	$apage = $totalls / $limit;

	$sql = $sqlls." order by lsort LIMIT $start,$limit";
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
    	<strong>All Informations</strong>
	</p>

	<div id="content">
		<form action="conn/sort.php" method="post" name="form1" id="form1"> 
		<?php 
			$pg = "list";
			include("../submenu.php");
		?>
		<table cellpadding="0" cellspacing="0" class="contentlist">
			<tr>
            	<th class="thtitle" colspan="7">
           		<input type="submit" name="Submit" value="Sort" class="butsort" />
				<input name="total" type="hidden" value="<?php echo $totalls;?>" />
				<input name="ltype" type="hidden" value="<?php echo $p[plist];?>" />
				<input name="pid" type="hidden" value="<?php echo $pid;?>" /> &nbsp;
            	<img src="../../images/tools/view.png" alt="" />&nbsp; Amount of Informations :&nbsp; <strong><?php echo $totalls;?></strong> &nbsp;&nbsp; 
                <img src="../../images/tools/add.png" alt="" />&nbsp; 
                <?php 
					if ($p[plist] == "1") echo '<a href="add.php?pid='.$pid.'">Post new Info</a>';
					else if ($p[plist] == "2" or $p[plist] == "3") echo '<a href="addth.php?pid='.$pid.'">Post new Info</a>';
				?>
                </th>
         	</tr>
			<tr>
				<th style="background-color:#d7d7d7; width:60px;">&nbsp;</th>
				<th style="background-color:#d7d7d7; width:80px;">#</th>
				<th style="background-color:#d7d7d7; width:140px;">Posted</th>
				<th style="background-color:#d7d7d7; text-align:left;">Topic</th>
				<th style="background-color:#d7d7d7; width:60px;">Picture</th>
				<th style="background-color:#d7d7d7; width:60px;">Active</th>
				<th style="background-color:#d7d7d7; width:60px;">Order</th>
			</tr>
			<?php
				$count = $totalls;
				while ($rec = mysql_fetch_array($result))	{
					echo "
					<tr class='trc'>
						<td style='text-align:center'><input name='num$count' type='text' class='boxsort' value='$rec[lsort]' onclick='this.select();'/><input name='id$count' type='hidden' value='$rec[lid]' /></td>
						<td style='text-align:center'>$rec[lid]</td>
						<td style='text-align:center'>$rec[lposted]</td>
						<td><a href='update.php?lid=$rec[lid]&amp;pid=$pid'>$rec[ltopic_en]</a></td>
						<td style='text-align:center'>"; if ($rec[lpic] == "") echo "No"; else echo "<a href='$lpath/$rec[lpic]' class='largepic'><img src='../../images/tools/pic.png' alt='' /></a>"; echo "</td>
						<td style='text-align:center'>";
						if ($rec[lactive] == "0") echo "<a href='conn/status.php?pid=$pid&amp;ltype=$p[plist]&amp;lid=$rec[lid]&amp;status=1'><img src='../../images/tools/red.png' alt=''/></a> ";
						else if ($rec[lactive] == "1") echo "<a href='conn/status.php?pid=$pid&amp;ltype=$p[plist]&amp;lid=$rec[lid]&amp;status=0'><img src='../../images/tools/green.png' alt=''/></a> ";
					echo "</td>
						<td style='text-align:center'>
							<a href='update.php?pid=$pid&amp;lid=$rec[lid]'><img src='../../images/tools/edit.png' alt='Update' /></a>
							<a href='conn/del.php?pid=$pid&amp;ltype=$p[plist]&amp;lid=$rec[lid]&amp;lpic=$rec[lpic]'' onclick=\"return confirm('Do you want to delete this information ?')\"><img src='../../images/tools/del.png' alt='Delete' /></a>
						</td>
					</tr>
					";
					$count--;
				}
			?>
		</table>
		<p class="pagenum">
		<?php 
			if ($totalls % $limit > 0)	{	
				$num = 0;
				while ($num <= $apage)	{
					$pnum = $num + 1;
					if ($num == $pn) { echo "<a href='?pid=$pid&amp;pn=$num'><strong>$pnum</strong></a> | "; }
					else { echo "<a href='?pid=$pid&amp;pn=$num'>$pnum</a> | "; }
					$num++;
				}
			}	else	{
				$num = 0;
				while ($num < $apage)	{
					$pnum = $num + 1;
					if ($num == $pn) { echo "<a href='?pid=$pid&amp;pn=$num'><strong>$pnum</strong></a> | "; }
					else { echo "<a href='?pid=$pid&amp;pn=$num'>$pnum</a> | "; }
					$num++;
				}
			}
		?>
        </p>
        </form>
	</div>
</body>
</html>
