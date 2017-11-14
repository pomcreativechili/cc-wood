<?php
	require_once("Connections/dgz.php");
	include("includes/modules/language.php");
	include("includes/modules/mobile.php");
	include("includes/content/info.php");
	include("includes/content/menu.php");
	include("includes/modules/contact.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo str_replace('_', '', $sess_lg); ?>">
<head>
<link rel="shortcut icon" href="<?php echo $url;?>/favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=1066">
<title><?php echo $ptitle;?></title>
<meta name="description" content="<?php echo $pdesc;?>" />
<meta name="keywords" content="<?php echo $pkeys;?>" />

<?php if ($sess_lg == '_th') { ?>
<link href="https://fonts.googleapis.com/css?family=Prompt:400,400i,600,600i,700" rel="stylesheet">
<?php } else { ?>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i,700" rel="stylesheet">
<?php } ?>
<link href="<?php echo $url;?>/css/default.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $url;?>/css/content/info.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $url;?>/css/content/list.accordian.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $url;?>/css/content/list.info.css" rel="stylesheet" type="text/css" />
<?php
	if ($pid == "0000")	{
		if (!strstr($_SERVER['HTTP_USER_AGENT'],'MSIE') or strstr($_SERVER['HTTP_USER_AGENT'],'MSIE 10.0'))	{
			echo '<link href="'.$url.'/css/script/parallax.css" rel="stylesheet" type="text/css" />';
		}	else if (strstr($_SERVER['HTTP_USER_AGENT'],'MSIE'))	{
			echo '<link href="'.$url.'/css/script/slide.css" rel="stylesheet" type="text/css" />';
		}
		echo '<link href="'.$url.'/css/home.css" rel="stylesheet" type="text/css" />';
	}
	if ($spid == "5001")	echo '<link href="'.$url.'/css/content/list.sub.css" rel="stylesheet" type="text/css" />';
	if ($pid == "2000")	{
		echo '
		<link href="'.$url.'/css/showroom.css" rel="stylesheet" type="text/css" />
		<link href="'.$url.'/css/script/zoomy.css" rel="stylesheet" type="text/css" />
		';
	}
	if ($pid == "4000")		echo '<link href="'.$url.'/css/work.css" rel="stylesheet" type="text/css" />';
	if ($pid == "8000")		echo '<link href="'.$url.'/css/content/list.news.css" rel="stylesheet" type="text/css" />';
	
	// Mobile
	echo $mobilecss;
?>

<script type="text/javascript" src="<?php echo $url;?>/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo $url;?>/js/action/topmenu.js"></script>
<script type="text/javascript" src="<?php echo $url;?>/js/smoothscroll.js"></script>
<script type="text/javascript" src="<?php echo $url;?>/js/slides.min.jquery.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo $url;?>/js/fancybox/jquery.fancybox.min.css" media="screen" />
<script type="text/javascript" src="<?php echo $url;?>/js/fancybox/jquery.fancybox.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo $url;?>/owlcarousel/assets/owl.carousel.min.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo $url;?>/owlcarousel/assets/owl.theme.default.min.css" media="screen" />
<script type="text/javascript" src="<?php echo $url;?>/owlcarousel/owl.carousel.min.js"></script>

<script type="text/javascript" src="<?php echo $url;?>/js/action/default.js"></script>
<?php 
	if ($pid == "0000")	{
		echo '
		<script type="text/javascript" src="'.$url.'/js/jquery.cslider.js"></script>
		<script type="text/javascript" src="'.$url.'/js/modernizr.custom.28468.js"></script>
		<script type="text/javascript" src="'.$url.'/js/action/home.js"></script>
		<script type="text/javascript" src="'.$url.'/js/action/highlight.js"></script>
		';
	}
	if ($spg == "")		echo '<script type="text/javascript" src="'.$url.'/js/action/menu.js"></script>';
	if ($pid == "2000")	{
		echo '
		<script type="text/javascript" src="'.$url.'/js/zoomy.min.js"></script>
		<script type="text/javascript" src="'.$url.'/js/action/showroom.js"></script>
		';
	}
	if ($pid == "4000")	echo '<script type="text/javascript" src="'.$url.'/js/action/work.js"></script>';
?>
<script type="text/javascript" src="<?php echo $url;?>/js/action/accordian.js"></script>
</head>

<body>
<?php
	// Begin mobile area
	echo $mobileareahead;

	include("content/default/header.php");
	
	if (!isset($pg)) include("content/page/home.php");
	else include("content/page/info.default.php");
	
	include("content/default/footer.php");

	// Ending mobile area
	echo $mobileareafoot;
?>
</body>
</html>