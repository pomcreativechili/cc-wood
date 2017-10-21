<?php
	include("../../config/chksession.php");
	require_once("../../../Connections/dgz.php");

	$pn = $_GET['pn'];
	if ($pn == "") $pn = 0;
	$limit = 30;
	$start = $pn * $limit;
	$_SESSION['sess_padmin'] = "newsletter/group/index.php?pn=$pn";

	$sqleg = "select tb_email_group.*, ";
	$sqleg .= "(select count(tb_email_account.emid) FROM tb_email_account WHERE tb_email_account.egid=tb_email_group.egid) as amlist from tb_email_group";
	$resulteg = mysql_query($sqleg, $dgz) or die(mysql_error());
	$totaleg = mysql_num_rows($resulteg);
	$apage = $totaleg / $limit;

	$sql = $sqleg." ORDER BY egtitle LIMIT $start,$limit";
	$result = mysql_query($sql, $dgz) or die(mysql_error());
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../css/default.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<p id="nav"><a href="index.php"><strong>All Groups</strong></a></p>

	<div id="content">
		<table cellpadding="0" cellspacing="0" class="contentlist">
			<tr>
            	<th class="thtitle" colspan="6">
            	<img src="../../images/tools/view.png" alt="" />&nbsp; Amount of Groups :&nbsp; <strong><?php echo $totaleg;?></strong> &nbsp;&nbsp;
				<img src="../../images/tools/add.png" alt="" />&nbsp; <a href="add.php">Add new Group</a>
                </th>
         	</tr>
			<tr>
				<th style="background-color:#d7d7d7; width:120px;">#</th>
				<th style="background-color:#d7d7d7; width:140px; text-align:left;">Posted</th>
				<th style="background-color:#d7d7d7; text-align:left;">Title</th>
                <th style="background-color:#d7d7d7; width:120px;">Accounts</th>
				<th style="background-color:#d7d7d7; width:60px;">Active</th>
				<th style="background-color:#d7d7d7; width:80px;">Order</th>
			</tr>
			<?php
				while ($rec = mysql_fetch_array($result))	{
					echo "
					<tr class='trc'>
						<td style='text-align:center'>$rec[egid]</td>
						<td>$rec[egdate]</td>
						<td><a href='update.php?egid=$rec[egid]'>$rec[egtitle]</a></td>
						<td style='text-align:center'><a href='../account/index.php?egid=$rec[egid]'><img src='../../images/tools/view.png' alt='Accounts' /></a> ($rec[amlist])</td>
						<td style='text-align:center'>";
						if ($rec[egactive] == "0") echo "<a href='conn/status.php?egid=$rec[egid]&amp;status=1'><img src='../../images/tools/red.png' alt=''/></a> ";
						else if ($rec[egactive] == "1") echo "<a href='conn/status.php?egid=$rec[egid]&amp;status=0'><img src='../../images/tools/green.png' alt=''/></a> ";
					echo "</td>
						<td style='text-align:center'>
							<a href='update.php?egid=$rec[egid]'><img src='../../images/tools/edit.png' alt='Update' /></a>";
							if ($rec[egid] != "000000000000") echo " <a href='conn/del.php?egid=$rec[egid]'' onclick=\"return confirm('Do you want to delete this group ?')\"><img src='../../images/tools/del.png' alt='Delete' /></a>";
					echo "
						</td>
					</tr>
					";
				}
			?>
		</table>
		<p class="pagenum">
		<?php 
			if ($totaleg % $limit > 0)	{	
				$num = 0;
				while ($num <= $apage)	{
					$pnum = $num + 1;
					if ($num == $pn) echo "<a href='?pn=$num'><strong>$pnum</strong></a> | ";
					else echo "<a href='?pn=$num'>$pnum</a> | ";
					$num++;
				}
			}	else	{
				$num = 0;
				while ($num < $apage)	{
					$pnum = $num + 1;
					if ($num == $pn) echo "<a href='?pn=$num'><strong>$pnum</strong></a> | ";
					else echo "<a href='?pn=$num'>$pnum</a> | ";
					$num++;
				}
			}
		?>
        </p>
	</div>
</body>
</html>
