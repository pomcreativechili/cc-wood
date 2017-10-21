<?php 
	// Email Subscribe
	$chk1 = rand(0,9);
	$chk2 = rand(0,9);
	$chka = $chk1 + $chk2;

	$ans = $_POST['ans'];
	$chk = $_POST['chk'];
	if ($chk == "popup" and $ans != "")	{
		$chka = $_POST['chka'];
		if ($ans == $chka)	{
			$name = $_POST['name'];
			$email = $_POST['email'];
			$date = date("Y-m-d H:i:s");
			$egid = "000000000000";

			// Check email address
			$sqlckem = "select * from tb_email_account WHERE egid='$egid' AND ememail like '$email'";
			$resultckem = mysql_query($sqlckem, $dgz);
			$totalckem = mysql_num_rows($resultckem);
			if ($totalckem == 0)	{
				$emid = date("ymdHis");
				
				$sql = "INSERT INTO tb_email_account VALUES ('$emid','','$egid','$name','$email','$date','1')";
				$result = mysql_query($sql,$dgz);
				if ($result) { print "<meta http-equiv=\"refresh\"content=\"0; URL=".$url.$lgurl.'/popup/'.$sp[purl]."/success\">"; exit(); }
				else { print "<meta http-equiv=\"refresh\"content=\"0; URL=".$url.$lgurl.'/popup/'.$sp[purl]."/error\">"; exit(); }

			} else { print "<meta http-equiv=\"refresh\"content=\"0; URL=".$url.$lgurl.'/popup/'.$sp[purl]."/already\">"; exit(); }
		}
	}
?>