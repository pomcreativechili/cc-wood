<?php 
	// Contact
	$chk1 = rand(0,9);
	$chk2 = rand(0,9);
	$chka = $chk1 + $chk2;

	$ans = $_POST['ans'];
	$chk = $_POST['chk'];
	if ($chk == "contact" and $ans != "")	{
		$chka = $_POST['chka'];
		
		// Send Message
		if ($ans == $chka)	{
			$name = $_POST['name'];
			$email = $_POST['email'];
			$reason = $_POST['reason'];
			$comment = $_POST['comment'];
			$date = date("Y-m-d H:i:s");
			
			$subject = "Thaweephan - Contact Message";
			$message = "
			<html>
			<body>
			<p><strong>$reason</strong></p>
			<p>".nl2br($comment)."</p>
			<p>
				From : <strong>$name</strong><br/>
				Email : $email<br/>
				Date : $date
			</p>
			</body>
			</html>	
			";
			
			$header = "MIME-Version: 1.0\r\n";
			$header .= "Content-type: text/html; charset=utf-8\r\n";
			$header .= "From: $name <$email>"."\r\n";
			$to = "marisa@thaweephan.co.th, jesper@thaweephan.co.th, admin@thaweephan.co.th";
			
			// Send to Thaweephan
			if (mail($to, $subject, $message, $header))	{
				
				$rsubject = "Thank you for contacting Thaweephan";
				$rmessage = "
				<html><body>
				<p>Thank you for contacting Thaweephan.</p>
				<p>A member of our team will get back to you shortly. If you do not receive a response within 24 hours please check your spam folder.</p>
				<p>This is an automated reply.</p>
				</body></html>	
				";
				
				$rheader = "MIME-Version: 1.0\r\n";
				$rheader .= "Content-type: text/html; charset=utf-8\r\n";
				$rheader .= "From: Thaweephan <noreply@thaweephan.co.th>"."\r\n";
				$rto = "$email";

				// Response to customer
				if (mail($rto, $rsubject, $rmessage, $rheader))	{ print "<meta http-equiv=\"refresh\"content=\"0; URL=".$url.$lgurl.'/'.$mntxt['10000']['url']."/success\">"; exit(); }
				else { print "<meta http-equiv=\"refresh\"content=\"0; URL=".$url.$lgurl.'/'.$mntxt['10000']['url']."/error\">"; exit(); }

			} else { print "<meta http-equiv=\"refresh\"content=\"0; URL=".$url.$lgurl.'/'.$mntxt['10000']['url']."/error\">"; exit(); }
		}
	}
?>