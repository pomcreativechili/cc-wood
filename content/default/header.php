<div id="header">
	<div id="logo">
        <div id="logoarea">
            <h1>
                <a href="<?php echo $url."/".$lgurl;?>">
                    <img src="<?php echo $url;?>/images/default/thaweephan-logo.png" />
                    <span>Thaweephan</span>
                </a>
            </h1>
            <h2>
                <div class="motto">the architectural woodworking company</div>
                <div class="tagline">
                    <span>product</span>
                    <span>design</span>
                    <span>carpentry</span>
                </div>
            </h2>
            <ul id="language">
                <li><a href="<?php echo $url.'/en';?>" class="mnen<?php if ($sess_lg == "_en") echo " mnlgselect";?>">Eng</a></li>
                <li><a href="<?php echo $url.'/th';?>" class="mnth<?php if ($sess_lg == "_th") echo " mnlgselect";?>">Tha</a></li>
            </ul>
        </div>
	</div>
    <?php 
    if ($pg == "" || end(explode('resources/pages/', $ppic)) != "") { ?>
    <div id="banner"><?php include("banner.php");?></div>
    <?php } else { ?>
    <div class="header-line"></div>
    <?php } ?>
    <div id="menuarea">
        <ul id="topmenu">
            <li><a href="<?php echo $url.$lgurl;?>"<?php if ($pid == "0000") echo ' class="mnselect"';?>>Home</a></li>
            <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['1000']['url'];?>"<?php if ($pid == "1000") echo ' class="mnselect"';?>>About Us</a>
                <ul class="submenu">
                    <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['1000']['url'].'/'.$mntxt['1001']['url'];?>"><?php echo $mntxt['1001']['text'];?></a></li>
                    <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['1000']['url'].'/'.$mntxt['1002']['url'];?>"><?php echo $mntxt['1002']['text'];?></a></li>
                    <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['1000']['url'].'/'.$mntxt['1003']['url'];?>"><?php echo $mntxt['1003']['text'];?></a></li>
                    <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['1000']['url'].'/'.$mntxt['1004']['url'];?>"><?php echo $mntxt['1004']['text'];?></a></li>
                </ul>
            </li>
            <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['2000']['url'];?>"<?php if ($pid == "2000") echo ' class="mnselect"';?>>Products</a>
                <ul class="submenu">
                    <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['2000']['url'].'/'.$mntxt['2001']['url'];?>"><?php echo $mntxt['2001']['text'];?></a></li>
                    <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['2000']['url'].'/'.$mntxt['2002']['url'];?>"><?php echo $mntxt['2002']['text'];?></a></li>
                    <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['2000']['url'].'/'.$mntxt['2003']['url'];?>"><?php echo $mntxt['2003']['text'];?></a></li>
                    <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['2000']['url'].'/'.$mntxt['2004']['url'];?>"><?php echo $mntxt['2004']['text'];?></a></li>
                    <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['2000']['url'].'/'.$mntxt['2005']['url'];?>"><?php echo $mntxt['2005']['text'];?></a></li>
                    <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['2000']['url'].'/'.$mntxt['2006']['url'];?>"><?php echo $mntxt['2006']['text'];?></a></li>
                </ul>
            </li>
            <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['3000']['url'];?>"<?php if ($pid == "3000") echo ' class="mnselect"';?>>Services</a>
                <ul class="submenu">
                    <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['3000']['url'].'/'.$mntxt['3001']['url'];?>"><?php echo $mntxt['3001']['text'];?></a></li>
                    <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['3000']['url'].'/'.$mntxt['3002']['url'];?>"><?php echo $mntxt['3002']['text'];?></a></li>
                </ul>
            </li>
            <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['4000']['url'];?>"<?php if ($pid == "4000") echo ' class="mnselect"';?>>Projects</a></li>
            <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['5000']['url'];?>"<?php if ($pid == "5000") echo ' class="mnselect"';?>>Quality &amp; Care</a>
                <ul class="submenu">
                    <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['5000']['url'].'/'.$mntxt['5001']['url'];?>"><?php echo $mntxt['5001']['text'];?></a></li>
                    <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['5000']['url'].'/'.$mntxt['5002']['url'];?>"><?php echo $mntxt['5002']['text'];?></a></li>
                    <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['5000']['url'].'/'.$mntxt['5003']['url'];?>"><?php echo $mntxt['5003']['text'];?></a></li>
                    <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['5000']['url'].'/'.$mntxt['5004']['url'];?>"><?php echo $mntxt['5004']['text'];?></a></li>
                    <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['5000']['url'].'/'.$mntxt['5005']['url'];?>"><?php echo $mntxt['5005']['text'];?></a></li>
                </ul>
            </li>
            <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['6000']['url'];?>"<?php if ($pid == "6000") echo ' class="mnselect"';?>>Work with Us</a>
                <ul class="submenu">
                    <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['6000']['url'].'/'.$mntxt['6001']['url'];?>"><?php echo $mntxt['6001']['text'];?></a></li>
                    <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['6000']['url'].'/'.$mntxt['6002']['url'];?>"><?php echo $mntxt['6002']['text'];?></a></li>
                    <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['6000']['url'].'/'.$mntxt['6003']['url'];?>"><?php echo $mntxt['6003']['text'];?></a></li>
                    <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['6000']['url'].'/'.$mntxt['6004']['url'];?>"><?php echo $mntxt['6004']['text'];?></a></li>
                    <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['6000']['url'].'/'.$mntxt['6005']['url'];?>"><?php echo $mntxt['6005']['text'];?></a></li>
                </ul>
            </li>
            <li><a href="<?php echo $url.$lgurl.'/'.$mntxt['7000']['url'];?>"<?php if ($pid == "7000") echo ' class="mnselect"';?>>International</a></li>
        </ul>
	</div>
    <ul id="social">
        <li><a href="https://www.facebook.com/thaweephanwood" target="_blank" class="mnfacebook">Facebook</a></li>
        <li><a href="http://www.linkedin.com/company/thaweephan-wood-products" target="_blank" class="mnlinkedin">LinkedIn</a></li>
        <!-- <li><a href="mailto:admin@thaweephan.co.th" target="_blank" class="mnemail">Email to Thaweephan</a></li> -->
        <li><a href="<?php echo $url.$lgurl.'/popup/'.$mntxt['0001']['url'];?>" class="mncontact popupcontact">Contact Us</a></li>
        <li><a href="<?php echo $url."/pdf/Thaweephan_Brochure".$sess_lg.".pdf";?>" target="_blank" class="mndownload">Download E-Brochure</a></li>
    </ul>
</div>

<div id="content">
<div id="contentarea">