<?php
	include("../../config/chksession.php");
	require_once("../../../Connections/dgz.php");

	$_SESSION['sess_padmin'] = "site/content/index.php";
	$ppath = "../../resources/pages";
	
	$sql = "select * from tb_page WHERE ptype != '6' order by abs(pid) asc";
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
	<p id="nav"><a href="index.php"><strong>All Pages</strong></a></p>

	<div id="content">
		<table cellpadding="0" cellspacing="0" class="contentlist">
			<tr><th class="thtitle" colspan="5"><img src="../../images/tools/view.png" alt="" />&nbsp; Amount of Pages :&nbsp; <strong><?php echo $total;?></strong></th>
         	</tr>
			<tr>
				<th style="background-color:#d7d7d7; width:80px;">#</th>
				<th style="background-color:#d7d7d7; width:140px; text-align:left;">Updated</th>
				<th style="background-color:#d7d7d7; width:200px; text-align:left;">Page</th>
				<th style="background-color:#d7d7d7; text-align:left;">Title</th>
				<th style="background-color:#d7d7d7; width:60px;">Order</th>
			</tr>
			<?php
				while ($rec = mysql_fetch_array($result))	{
					// Page title
					$ppage = $rec[pmp];
					if ($ppage == "") { $ppage = $rec[pid]; }
					include("../../config/chkpage.php");
					
					if ($rec[ptype] != "4" and $rec[ptype] != "5" and $rec[ptype] != "6") {
						echo "
						<tr class='trc'>
							<td style='text-align:center;'>$rec[pid]</td>
							<td>$rec[pupdated]</td>
							<td><strong>$ppagetitle</strong></td>
							<td><a href='update.php?pid=$rec[pid]'>$rec[ptopic_en]</a></td>
							<td style='text-align:center'><a href='update.php?pid=$rec[pid]'><img src='../../images/tools/edit.png' alt='Update' /></a></td>
						</tr>
						";
					}	else	{
						echo "
						<tr class='trc'>
							<td colspan='3'>&nbsp;</td>
							<td><a href='update.php?pid=$rec[pid]'>$rec[ptopic_en]</a></td>
							<td style='text-align:center'><a href='update.php?pid=$rec[pid]'><img src='../../images/tools/edit.png' alt='Update' /></a></td>
						</tr>
						";

						// Sub of Sub pages
						$sqlpss = "select * from tb_page WHERE ptype='6' AND psp='$rec[pid]' order by abs(pid) asc";
						$resultpss = mysql_query($sqlpss, $dgz) or die(mysql_error());
						$totalpss = mysql_num_rows($resultpss);
						if ($totalpss > 0)	{
							while ($pss = mysql_fetch_array($resultpss))	{
								echo "
								<tr class='trc'>
									<td colspan='3'>&nbsp;</td>
									<td style='font-style:italic;'>- <a href='update.php?pid=$pss[pid]'>$pss[ptopic_en]</a></td>
									<td style='text-align:center'><a href='update.php?pid=$pss[pid]'><img src='../../images/tools/edit.png' alt='Update' /></a></td>
								</tr>
								";
							}
						}
						
					}
				}
			?>
		</table>
	</div>
</body>
</html>
