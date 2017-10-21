<?php
	// Check for Mobile
	if (strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') or strstr($_SERVER['HTTP_USER_AGENT'],'iPod') or strstr($_SERVER['HTTP_USER_AGENT'],'Android') or strstr($_SERVER['HTTP_USER_AGENT'],'BlackBerry') or strstr($_SERVER['HTTP_USER_AGENT'],'webOS') or strpos($_SERVER['HTTP_USER_AGENT'], 'iPad'))	{
		$mobilecss = '<link href="'.$url.'/css/mobile.css" rel="stylesheet" type="text/css" />';
		$mobileareahead = '<div id="mobilearea">';
		$mobileareafoot = '</div>';
	}
?>
