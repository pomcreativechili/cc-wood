<?php
	include("../../config/chksession.php");
	require_once("../../../Connections/dgz.php");

	$_SESSION['sess_padmin'] = "site/slide/index.php";
	$slpath = "../../resources/slide";

	// Page Information
	$pid = "0000";
	include("../../config/page.info.php");
	
	$sql = "select * from tb_slide order by slsort";
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
	<?php include("../menu.php");?>
	<p id="nav"><a href="index.php"><strong>All Pictures</strong></a></p>

	<div id="content">
		<form action="conn/sort.php" method="post" name="form1" id="form1"> 
		<?php 
			$pg = "slide";
			include("../submenu.php");
		?>
		<table cellpadding="0" cellspacing="0" class="contentlist">
			<tr>
            	<th class="thtitle" colspan="7">
           		<input type="submit" name="Submit" value="Sort" class="butsort" />
				<input name="total" type="hidden" value="<?php echo $total;?>" /> &nbsp;
            	<img src="../../images/tools/view.png" alt="" />&nbsp; Amount of Pictures :&nbsp; <strong><?php echo $total;?></strong> &nbsp;&nbsp;
				<img src="../../images/tools/add.png" alt="" />&nbsp; <a href="add.php">Post new Slide</a>
                </th>
         	</tr>
			<tr>
				<th style="background-color:#d7d7d7; width:60px;">&nbsp;</th>
				<th style="background-color:#d7d7d7; width:80px;">#</th>
				<th style="background-color:#d7d7d7; width:140px;">Posted</th>
				<th style="background-color:#d7d7d7; text-align:left;">Title / Text</th>
				<th style="background-color:#d7d7d7; width:60px;">Picture</th>
				<th style="background-color:#d7d7d7; width:60px;">Active</th>
				<th style="background-color:#d7d7d7; width:80px;">Order</th>
			</tr>
			<?php
				$count = $total;
				while ($rec = mysql_fetch_array($result))	{
					echo "
					<tr class='trc'>
						<td style='text-align:center'><input name='num$count' type='text' class='boxsort' value='$rec[slsort]' onclick='this.select();'/><input name='id$count' type='hidden' value='$rec[slid]' /></td>
						<td style='text-align:center'>$rec[slid]</td>
						<td style='text-align:center'>$rec[slposted]</td>
						<td><a href='update.php?slid=$rec[slid]'>$rec[sltext1_en] / $rec[sltext2_en]</a></td>
						<td style='text-align:center'>"; 
						if ($rec[slpic] == "") echo "No";
						else echo "<a href='$slpath/$rec[slpic]' class='largepic'><img src='../../images/tools/pic.png' alt='' /></a>"; 
					echo "</td>
						<td style='text-align:center'>";
						if ($rec[slactive] == "0") echo "<a href='conn/status.php?slid=$rec[slid]&amp;status=1'><img src='../../images/tools/red.png' alt=''/></a> ";
						else if ($rec[slactive] == "1")	echo "<a href='conn/status.php?slid=$rec[slid]&amp;status=0'><img src='../../images/tools/green.png' alt=''/></a> ";
					echo "</td>
						<td style='text-align:center'>
							<a href='update.php?slid=$rec[slid]'><img src='../../images/tools/edit.png' alt='Update' /></a>
							<a href='conn/del.php?slid=$rec[slid]&amp;slpic=$rec[slpic]'' onclick=\"return confirm('Do you want to delete this slide ?')\"><img src='../../images/tools/del.png' alt='Delete' /></a>
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
