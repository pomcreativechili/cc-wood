<?php
	include('../../config/chksession.php');
	require_once('../../../Connections/dgz.php');
	
	$nid = $_REQUEST['nid'];
	$chk = $_REQUEST['chk'];
	$egid = $_REQUEST['egid'];
	if ($egid != "") $egsql = " AND egid='$egid'";

	$sqlem = "select * from tb_email_account WHERE emactive='1'".$egsql;
	$resultem = mysql_query($sqlem, $dgz) or die(mysql_error());
	$totalem = mysql_num_rows($resultem);
	$max = $totalem;

	$err = $_GET['err'];
	if ($err == "1") $error = "<p class='success'><img src='resources/images/success.png' alt='' />&nbsp; Send message to all email address successfully.</p>";
	else if ($err == "2") $error = "<p class='err'><img src='resources/images/err.png' alt='' />&nbsp; ERROR : Can not send message to all email address.</p>";
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
	<div id="popuparea">
	<form action="send.php" method="post" name="form1" id="form1" onsubmit="return confirm('Do you confirm to send this message?');">
		<?php echo $error; ?>
		<h3><img src="resources/images/add.png" alt="" />&nbsp; Send Message</h3>	
		<table cellpadding="0" cellspacing="0" class="popuptable">
			<tr>
				<td style="width:140px; padding-top:25px; font-size:16px;">Choose Group : </td>
				<td style="width:400px; padding-top:25px; font-size:16px;">
                <select name="egid" class="box" style="min-width:200px; font-size:16px;">
                    <option value="">All Groups ...</option>
                    <?php
						$sqleg = "select tb_email_group.*, ";
						$sqleg .= "(select count(tb_email_account.emid) FROM tb_email_account WHERE tb_email_account.egid=tb_email_group.egid AND tb_email_account.emactive='1') as amlist from tb_email_group WHERE tb_email_group.egactive='1' ORDER BY egtitle";
						$resulteg = mysql_query($sqleg, $dgz) or die(mysql_error());
						while ($eg = mysql_fetch_array($resulteg))	{
							echo '<option value="'.$eg[egid].'"'; if ($egid == $eg[egid]) echo ' selected="selected"'; echo '>'.$eg[egtitle].' ('.$eg[amlist].' Accounts)</option>';
						}
					?>
                </select>
                </td>
			</tr>
            <?php
				$limit = 30;
				$num = $_GET['num']; if ($num == "") $num = 0;
				$errnum = $_GET['errnum']; if ($errnum == "") $errnum = 0;
				if ($chk == "1")	{
					include("conn/sendmessage.php");
					$subject = $nsubject;
					$header = "MIME-Version: 1.0\r\n";
					$header .= "Content-type: text/html; charset=utf-8\r\n";
					$header .= "From: Thaweephan <noreply@thaweephan.co.th>"; // From sender
				
					echo "
					<tr><td>Successfully Sent :</td><td>$num / $max &nbsp; (Errors $errnum)</td></tr>
					<tr><td>&nbsp;</td><td><img src='resources/images/loading.gif' alt='' /></td></tr>
					";

					$sql = $sqlem." order by emname LIMIT $num,$limit";
					$result = mysql_query($sql, $dgz) or die(mysql_error());
					while ($rec = mysql_fetch_array($result))	{
						$to = $rec[ememail]; // Email Reciever
						$num++;
						if (mail($to, $subject, $message, $header))	 {
							if ($num % $limit == 0 or $num % $max == 0)	{
								sleep(1);
								if ($num != $max) { print "<meta http-equiv=\"refresh\"content=\"0; URL=send.php?nid=$nid&egid=$egid&errnum=$errnum&num=$num&chk=1\">"; exit(); }
								else { echo "<meta http-equiv=\"refresh\"content=\"0; URL=send.php?nid=$nid&egid=$egid&errnum=$errnum&num=$num&err=1\">"; exit(); }
							}	else	{
								continue;
							}
						}	else	{
							$errnum++;
							continue;
						}
					}
				}	else if ($err == "1")	{
					echo "<tr><td>Successfully sent :</td><td>$num / $max &nbsp; (Errors $errnum)</td></tr>"; 
				}
			?>            
            <tr>
            	<td>&nbsp;</td>
            	<td class="tip">^ The message will send to all email address in group when you click send.</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
                <input type="submit" name="Submit1" value="Send" class="but"/>
                <input type="reset" name="Reset" value="Reset" class="but" onclick="document.location.reload(true)"/>
                <input name="chk" type="hidden" value="1" />
                <input name="nid" type="hidden" value="<?php echo $nid;?>" />
				</td>
			</tr>
		</table>
	</form>
	</div>
</body>
</html>
