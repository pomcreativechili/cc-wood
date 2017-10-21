<?php
	include("../../config/chksession.php");
	require_once("../../../Connections/dgz.php");

	$egid = $_GET['egid'];
	$pn = $_GET['pn']; if ($pn == "") $pn = 0;
	$limit = 100;
	$start = $pn * $limit;
	$_SESSION['sess_padmin'] = "newsletter/account/index.php?egid=$egid&pn=$pn";

	$sqleg = "select * from tb_email_group WHERE egid='$egid'";
	$resulteg = mysql_query($sqleg, $dgz);
	$eg = mysql_fetch_array($resulteg);

	$sqlem = "select * from tb_email_account WHERE egid='$egid'";
	$resultem = mysql_query($sqlem, $dgz);
	$totalem = mysql_num_rows($resultem);
	$apage = $totalem / $limit;

	$sql = $sqlem." order by emname LIMIT $start,$limit";
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
	<p id="nav">
    	<a href="../group/update.php?egid=<?php echo $egid;?>"><?php echo $eg[egtitle];?></a> &nbsp;&gt;&nbsp; 
    	<a href="index.php?aid=<?php echo $aid;?>"><strong>All Accounts</strong></a>
    </p>

	<div id="content">
		<?php echo $error;?>
        <p class="contentmenu">
            <a href="../group/update.php?egid=<?php echo $egid;?>">Info</a> &nbsp;.&nbsp; 
            <a href="index.php?egid=<?php echo $egid;?>"><strong>Accounts</strong></a>
        </p>    
		<table cellpadding="0" cellspacing="0" class="contentlist">
			<tr>
            	<th class="thtitle" colspan="3">
                <img src="../../images/tools/view.png" alt="" />&nbsp; Amount of Accounts :&nbsp; <strong><?php echo $totalem;?></strong> &nbsp;&nbsp; 
                <img src="../../images/tools/add.png" alt="" />&nbsp; <a href="add.php?egid=<?php echo $egid;?>">Add new Account</a>
                </th>
                <th class="thtitle" colspan="3" style="text-align:right;">
                <img src="../../images/tools/excel.png" alt="" />&nbsp; <a href="import.php?egid=<?php echo $egid;?>">Import from Excel</a>
                </th>
         	</tr>
			<tr>
				<th style="background-color:#d7d7d7; width:120px;">#</th>
				<th style="background-color:#d7d7d7; width:140px; text-align:left;">Posted</th>
				<th style="background-color:#d7d7d7; text-align:left;">Name</th>
				<th style="background-color:#d7d7d7; text-align:left;">Email Address</th>
				<th style="background-color:#d7d7d7; width:60px;">Active</th>
				<th style="background-color:#d7d7d7; width:80px;">Order</th>
			</tr>
			<?php
				while ($rec = mysql_fetch_array($result))	{
					echo "
					<tr class='trc'>
						<td style='text-align:center'>$rec[emid]</td>
						<td>$rec[emdate]</td>
						<td><a href='update.php?aid=$aid&amp;lid=$rec[lid]'>$rec[emname]</a></td>
						<td><a href='mailto:$rec[ememail]' target='_blank'>$rec[ememail]</a></td>
						<td style='text-align:center'>";
						if ($rec[emactive] == "0") echo "<a href='conn/status.php?egid=$egid&amp;emid=$rec[emid]&amp;status=1'><img src='../../images/tools/red.png' alt=''/></a> ";
						else if ($rec[emactive] == "1") echo "<a href='conn/status.php?egid=$egid&amp;emid=$rec[emid]&amp;status=0'><img src='../../images/tools/green.png' alt=''/></a> ";
					echo "</td>
						<td style='text-align:center'>
							<a href='update.php?egid=$egid&amp;emid=$rec[emid]'><img src='../../images/tools/edit.png' alt='Update' /></a>
							<a href='conn/del.php?egid=$egid&amp;emid=$rec[emid]'' onclick=\"return confirm('Do you want to delete this account ?')\"><img src='../../images/tools/del.png' alt='Delete' /></a>
						</td>
					</tr>
					";
					$count--;
				}
			?>
		</table>
		<p class="pagenum">
		<?php 
			if ($totalem % $limit > 0)	{	
				$num = 0;
				while ($num <= $apage)	{
					$pnum = $num + 1;
					if ($num == $pn) echo "<a href='?egid=$egid&amp;pn=$num'><strong>$pnum</strong></a> | ";
					else echo "<a href='?egid=$egid&amp;pn=$num'>$pnum</a> | ";
					$num++;
				}
			}	else	{
				$num = 0;
				while ($num < $apage)	{
					$pnum = $num + 1;
					if ($num == $pn) echo "<a href='?egid=$egid&amp;pn=$num'><strong>$pnum</strong></a> | ";
					else echo "<a href='?egid=$egid&amp;pn=$num'>$pnum</a> | ";
					$num++;
				}
			}
		?>
        </p>
	</div>
</body>
</html>
