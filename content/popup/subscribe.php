<?php
	include("../../includes/modules/subscribe.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $ptitle;?></title>
<link href="<?php echo $url;?>/css/popup/subscribe.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function chkpopup()	{
	if (document.form1.name.value == "")	{
		alert("Please fill in your name");
		document.form1.name.select();
		return false;
	}
	if(document.form1.email.value != ""){
		var str=document.form1.email.value;
		var filter=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;	
		if (!filter.test(str))	{
			alert("Please fill in correctly style of email address");
			document.form1.email.select();
			return false;
		}
	}	else	{
		if (document.form1.email.value == "")	{
			alert("Please fill in your email address");
			document.form1.email.select();
			return false;
		}
	}
	if (document.form1.ans.value == "")	{
		alert("Please fill the answer for spam checking");
		document.form1.ans.select();
		return false;
	}
	if (document.form1.ans.value != document.form1.chka.value )	{
		alert("The answer is incorrect, Please check again");
		document.form1.ans.select();
		return false;
	}
	return true;
}
</script>
</head>

<body>
<div id="subscribe">
	<div id="info-area">
    <?php 
		echo '<h2><span>'.$sptopic.'</span></h2>';
		if ($spdetail != "") echo '<div id="info-detail">'.$spdetail.'</div>';
	?>
    </div>
	<div id="form-area">
        <form name="form1" action="<?php echo $url.$lgurl.'/popup/'.$sp[purl];?>" method="post" onSubmit="return chkpopup();">
        <p class="formtopic">Your Name</p>
        <p><input name="name" type="text" class="box boxcol" value=""/></p>
        <p class="formtopic">Your Email Address</p>
        <p><input name="email" type="text" class="box boxcol" value=""/></p>
        <p class="formtopic">Spam Check</p>
        <p><input name="ans" type="text" class="box boxans" value="" size="" /> &nbsp; <span class="formspam"><?php echo $chk1." + ".$chk2." = ?"; ?></span></p>
        <p class="formtip">
        <?php 
            if ($_GET['err'] == "1")		echo '<span class="success">* Thank you for your email subscribe</span>'; 
            else if ($_GET['err'] == "2")	echo '<span class="error">* Can not subscribe your email address</span>';
            else if ($_GET['err'] == "3")	echo '<span class="error">* This email has already subscribed</span>';
            else							echo '* Please fill in all fields.';
        ?>
        </p>
        <p><input type="submit" name="Submit1" value="Subscribe" class="btsubscribe" /><input type="reset" name="Submit2" value="Reset" class="btreset" /><input name="chka" type="hidden" value="<?php echo $chka; ?>" /><input name="chk" type="hidden" value="popup" /></p>
        </form>
    </div>
</div>
</body>
</html>