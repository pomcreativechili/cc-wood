<?php
	require_once("../../Connections/dgz.php");
	include("../../includes/modules/language.php");
	include("../../includes/content/info.php");

	$wnum = 0;
	$wcount = 0;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="<?php echo $url;?>/favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $ptitle;?></title>
<link href="<?php echo $url;?>/css/popup/work.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $url;?>/js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function()	{
	// Display first image for slideshow
	if ($("#workpic .workpicfront").attr("src") == "#")	{
		var src = $("#workgallery p img:first-child").attr("src");
		pic = src.replace(/gallery\/th/g,"gallery/");
  		$("#workpic .workpicfront").attr("src", pic);
	}
	
	// Onclick each thumbnail
	$("#workgallery p img").click(function(){
		var src = $(this).attr("src");
		var pfront = $(".workpicfront").attr("src");
		var pback = $(".workpicback").attr("src");
		var pic = src.replace(/gallery\/th/g,"gallery/");
  		$("#workpic .workpicback").attr("src", pfront);
  		$("#workpic .workpicfront").hide();
  		$("#workpic .workpicfront").attr("src", pic);
  		$("#workpic .workpicfront").fadeIn(600);
	});
});
</script>
</head>

<body>
    <div id="work">
        <div id="workpic"><p><img src="#" alt="" class="workpicfront" /><img src="#" alt="" class="workpicback" /></p></div>
        <div id="workinfo">
            <div id="workdetail">
                <h2><?php echo $w[$wtitle];?></h2>
				<p class="workintro">
                <?php
					echo '<span class="wtopic">Project:</span> <span class="wtext">'.$w[$wtitle].'</span><br />';
					if ($w[$wtopic1] != "" and $w[$wtext1] != "") echo '<span class="wtopic">'.$w[$wtopic1].':</span> <span class="wtext">'.$w[$wtext1].'</span><br />';
					if ($w[$wtopic2] != "" and $w[$wtext2] != "") echo '<span class="wtopic">'.$w[$wtopic2].':</span> <span class="wtext">'.$w[$wtext2].'</span><br />';
					if ($w[$wtopic3] != "" and $w[$wtext3] != "") echo '<span class="wtopic">'.$w[$wtopic3].':</span> <span class="wtext">'.$w[$wtext3].'</span><br />';
					if ($w[$wtopic4] != "" and $w[$wtext4] != "") echo '<span class="wtopic">'.$w[$wtopic4].':</span> <span class="wtext">'.$w[$wtext4].'</span><br />';
				?>
				</p>
                <p>
                <?php 
                    $wdetail = $w[$wdetail];
                    $wdetail = str_replace("&quot;",'"',"$wdetail");
                    $wdetail = str_replace("&rsquo;","'","$wdetail");
                    echo $wdetail;
                ?>
                </p>
            </div>
            <?php if ($totalwg > 0) { ?>
            <div id="workgallery">
                <h3>Gallery</h3>
                <p>
                <?php
                    while ($wg = mysql_fetch_array($resultwg))	{
						$wnum++;
						$wcount++;
						if ($wcount == 1 or $wnum == 3) { $wclear = ' class="nomargin"'; $wnum = 0; }
						else $wclear = "";
                        echo '<img src="'.$wpath.'/'.$wg[gthumb].'" alt="'.$srg[$wgalt].'"'.$wclear.' />';
                    }
                ?>
                </p>
            </div>
            <?php } ?>
        </div>
        <div class="clearline"></div>
    </div>
</body>
</html>