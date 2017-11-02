<div id="info"<?php if ($pid == "0000") echo ' class="infohome"';?>>
<?php
	// Menu sub pages
	if ($ptype == "1") include("info.menu.php");

	// Main + Sub pages
	if (($sbpg == "" or ($sbpg != "" and $pid == "2000")) and $npg == "" and $srcpg == "" and $srppg == "")	{
		// Topic
		if ($ptype == "2" or $ptype == "3") echo '<h2 class="infotopic"><span class="tp'.$pid.'">'.$ptopic.'</span></h2>';
		
		// Information loading area
		if ($ptype == "1" and $totalmnsp > 0) echo '<div id="infoload">';
		
		// Information Area
		if ($pgallery != "0" or ($spid != "8001" and $spid != "" and $spgallery != "0")) echo '<div id="infoarea">';
		else echo '<div id="infoarea" class="nogallery">';
		
		if ($ptype == "0")	{
			echo '<h2>'.$ptopic.'</h2>';
			if ($pdetail != "") echo '<div id="infodetail">'.$pdetail.'</div>';
		}	else if ($spg != "" or $ptype == "1")	{
			//echo '<h2>'.$ptopic.' | '.$sptopic.'</h2>';
			if ($spdetail != "") echo '<div id="infodetail">'.$spdetail.'</div>';
		}	else	{
			if ($pdetail != "") echo '<div id="infodetail">'.$pdetail.'</div>';
		}
		
		// Contact Form
		if ($pid == "10000") include("contact.php");
	
		// End Information Area
		echo '</div>';
		
		// Gallery
		if (($pgallery != "0" or ($spid != "8001" and $spid != "" and $spgallery != "0")) and $ptype != "1") include("content/page/info.gallery.php");
	
		// List
		if ($splist == "1") 						include("content/list/list.accordian.php");
		else if ($splist == "3") 					include("content/list/list.news.php");
		else if ($plist == "2" or $splist == "2") 	include("content/list/list.info.php");
		else if ($splist == "S") 					include("content/showroom/list.php");
		else if ($plist == "W") 					include("content/showroom/list.php");
		
		// Sub pages
		if ($spid == "5001") include("content/list/list.sub.php");
		
		// End information loading
		if ($ptype == "1" and $totalmnsp > 0) echo '</div>';
	
	// Sub of sub page
	}	else if ($sbpg != "" and $pid != "2000")	{
		include("content/page/sub.php");
		
	// News	
	}	else if ($npg != "")	{
		include("content/page/news.php");
	
	// Showroom
	}	else if ($srcpg != "" and $srppg != "")	{
		include("content/showroom/detail.php");
	}
?>
	<div class="clearline"></div>
</div>