<?php
	include("../../config/chksession.php");
	require_once("../../../Connections/dgz.php");

	$pn = $_GET['pn'];
	if ($pn == "") $pn = 0;
	
	// Amount to display
	$limit = 30;
	$start = $pn * $limit;
	$_SESSION['sess_padmin'] = "newsletter/template/index.php?pn=$pn";
	
	// Template List
	$sqln= "select * from tb_newsletter_info";
	$resultn = mysql_query($sqln, $dgz) or die(mysql_error());
	$totaln = mysql_num_rows($resultn);
	$apage = $totaln / $limit;

	$sql= $sqln." order by nid DESC LIMIT $start,$limit";
	$result = mysql_query($sql, $dgz) or die(mysql_error());
	$total = mysql_num_rows($result);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../css/default.css" rel="stylesheet" type="text/css" />
<link href="../../css/newsletter.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<p id="nav"><strong>All Templates</strong></p>
	<div id="content">
		<table cellpadding="0" cellspacing="0" class="contentlist">
			<tr>
				<th class="thtitle" colspan="6">
                <img src="resources/images/view.png" alt="" />&nbsp; Amount of Templates :&nbsp; <strong><?php echo $totaln;?></strong> &nbsp;&nbsp; 
                <img src="resources/images/add.png" alt="" />&nbsp; <a href="add.php">Create new Template</a>
                </th>
			</tr>
			<tr>
				<th style="background-color:#d7d7d7; width:120px;">#</th>
				<th style="background-color:#d7d7d7; width:140px; text-align:left;">Created</th>
				<th style="background-color:#d7d7d7; text-align:left;">Subject</th>
				<th style="background-color:#d7d7d7; width:120px;">Online Version</th>
				<th style="background-color:#d7d7d7; width:120px;">External (URL)</th>
				<th style="background-color:#d7d7d7; width:80px;">Order</th>
			</tr>
			<?php
				while ($rec = mysql_fetch_array($result))	{
					// External URL
					if ($rec[nurl] == "") $nurl = "No";
					else $nurl = "<a href='$rec[nurl]' target='_blank'>View</a>";
					
					echo "
					<tr class='trc'>
						<td style='text-align:center'>$rec[nid]</td>
						<td>$rec[ndate]</td>
						<td><a href='update.php?nid=$rec[nid]'>$rec[nsubject]</a></td>
						<td style='text-align:center'><a href='$url/newsletter/index.php?nid=$rec[nid]' target='_blank'>View</a></td>
						<td style='text-align:center'>$nurl</td>
						<td style='text-align:center'>
							<a href='update.php?nid=$rec[nid]'><img src='resources/images/edit.png' alt='Update' /></a> 
							<a href='conn/delnewsletter.php?nid=$rec[nid]'' onclick=\"return confirm('Do you want to delete this template ?')\"><img src='resources/images/del.png' alt='Delete' /></a>
						</td>
					</tr>
					";
				}
			?>
		</table>

		<p class="pagenum">
		<?php 
			if ($totaln % $limit > 0)	{	
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
