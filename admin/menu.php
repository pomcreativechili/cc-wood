<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="<?php echo $_SESSION['sess_url'];?>/js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("a").click(function(){
		$("a").css({"background":"#999999","color":"#e7e7e7"});
		$(this).css({"background":"#ffffff","color":"#000000"});
	});
});
</script>

<style type="text/css">
*			{ padding:0px; margin:0px; }
@font-face {
    font-family: 'ralewayextralight';
    src: url('../font/raleway-extralight-webfont.eot');
    src: url('../font/raleway-extralight-webfont.eot?#iefix') format('embedded-opentype'),
         url('../font/raleway-extralight-webfont.woff') format('woff'),
         url('../font/raleway-extralight-webfont.ttf') format('truetype'),
         url('../font/raleway-extralight-webfont.svg#ralewayextralight') format('svg');
    font-weight: normal;
    font-style: normal;
}
body		{ padding:0px; margin:0px; font-family:ralewayextralight; font-size:17px; color:#fff; background:#666; }
a			{ display:block; padding:6px 20px 6px 20px; color: #e7e7e7; text-decoration: none; }
#menuarea	{ margin:auto; width:1000px; position:absolute; bottom:0px; left:0px; right:0px; }
table		{ border-top:1px solid #666; background:#666; }
td			{ text-align:center; background:#999; border-right:8px solid #666; text-transform:uppercase; }
.aselect	{ background:#fff; color:#000; }
</style>
</head>

<body>
<div id="menuarea">
	<table cellpadding="0" cellspacing="0">
	<tr>
		<td><a href="site/content/index.php?chkmenu=site" target="admin"<?php if ($_SESSION['sess_chkmenu'] == "site") echo ' class="aselect"';?>>Site</a></td>
		<td><a href="site/home/index.php?htype=0&amp;chkmenu=highlight" target="admin"<?php if ($_SESSION['sess_chkmenu'] == "highlight") echo ' class="aselect"';?>>Highlight</a></td>
		<td><a href="site/home/index.php?htype=1&amp;chkmenu=clip" target="admin"<?php if ($_SESSION['sess_chkmenu'] == "clip") echo ' class="aselect"';?>>Clip / Video</a></td>
		<td><a href="site/work/index.php?chkmenu=work" target="admin"<?php if ($_SESSION['sess_chkmenu'] == "work") echo ' class="aselect"';?>>Work</a></td>
		<td><a href="newsletter/template/index.php?chkmenu=newsletter" target="admin" <?php if ($_SESSION['sess_chkmenu'] == "newsletter") echo 'class="aselect"';?>>Newsletter</a></td>
		<td><a href="newsletter/group/index.php?chkmenu=email" target="admin" <?php if ($_SESSION['sess_chkmenu'] == "email") echo 'class="aselect"';?>>Email Address</a></td>
		<td><a href="config/logout.php" target="_top" onclick="return confirm('Do you want to logout the system ?');"><strong>Logout</strong></a></td>
    </tr>
	</table>
</div>
</body>
</html>