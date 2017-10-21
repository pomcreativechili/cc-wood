<script type="text/javascript">
function chkcontact()	{
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
	if (document.form1.reason.value == "")	{
		alert("Please fill in reason for contacting");
		document.form1.reason.select();
		return false;
	}
	if (document.form1.comment.value == "")	{
		alert("Please fill in comments / questions");
		document.form1.comment.select();
		return false;
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

<div id="contact">
    <h3>Contact Form</h3>
    <form name="form1" action="<?php echo $url.$lgurl.'/'.$mntxt['10000']['url'];?>" method="post" onSubmit="return chkcontact();">
    <?php 
		if ($_GET['err'] == "1") echo '<p class="success">Thank you for contacting Thaweephan</p>'; 
		else if ($_GET['err'] == "2") echo '<p class="error">ERROR - Can not post your message to us</p>'; 
	?>
    <p class="formtopic">Your Name</p>
    <p><input name="name" type="text" class="box" value=""/></p>
    <p class="formtopic">Your Email Address</p>
    <p><input name="email" type="text" class="box" value=""/></p>
    <p class="formtopic">Reason for Contacting</p>
    <p><input name="reason" type="text" class="box" value=""/></p>
    <p class="formtopic">Comments / Questions</p>
    <p><textarea name="comment" class="box" rows="8"></textarea></p>
	<p class="formtopic">Spam Check</p>
	<p><input name="ans" type="text" class="box boxans" value="" size="" /> &nbsp; <span class="formspam"><?php echo $chk1." + ".$chk2." = ?"; ?></span></p>
    <p class="formbutton">
    <input type="submit" name="Submit1" value="Send" class="btsend" />
    <input type="reset" name="Submit2" value="Reset" class="btreset" />
    <input name="pg" type="hidden" value="<?php echo $pg; ?>" />
    <input name="chka" type="hidden" value="<?php echo $chka; ?>" />
    <input name="chk" type="hidden" value="contact" />
	</p>
    </form>
</div>
