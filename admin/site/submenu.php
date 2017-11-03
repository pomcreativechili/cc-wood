<?php if ($lid == "" and $wid == "" and $cid == "" and $pdid == "") { ?>
<p class="contentmenu">
	<?php
		if ($p[plist] == "W") {
			if (!isset($spid)) $spid = $p[pid];
	?>
	<a href="../content/update.php?pid=<?php echo $spid;?>"><?php if ($pg == "info") echo "<strong>Info</strong>"; else echo "Info";?></a> 
	<?php } else { ?>
	<a href="../content/update.php?pid=<?php echo $p[pid];?>"><?php if ($pg == "info") echo "<strong>Info</strong>"; else echo "Info";?></a> 
	<?php } ?> 
    
	<?php if ($p[pid] == "0000") { // Home ?>
	&nbsp;.&nbsp; <a href="../slide/index.php"><?php if ($pg == "slide") echo "<strong>Slide</strong>"; else echo "Slide";?></a>
	<?php } ?>    

	<?php if ($p[pgallery] != "0") { // Gallery ?>
	&nbsp;.&nbsp; <a href="../gallery/index.php?pid=<?php echo $p[pid];?>&amp;gtype=<?php echo $p[pgallery];?>&amp;gpage=<?php echo $p[pmp];?>"><?php if ($pg == "gallery") echo "<strong>Gallery</strong>"; else echo "Gallery";?></a>
    <?php } ?>

	<?php if ($p[plist] != "0" and $p[plist] != "S" and $p[plist] != "W") { // List ?>
	&nbsp;.&nbsp; <a href="../list/index.php?pid=<?php echo $p[pid];?>"><?php if ($pg == "list") echo "<strong>List</strong>"; else echo "List";?></a>
    <?php } ?>

	<?php if ($p[plist] == "S") { // Showroom ?>
	&nbsp;.&nbsp; <a href="../category/index.php?pid=<?php echo $p[pid];?>"><?php if ($pg == "showroom") echo "<strong>Categories</strong>"; else echo "Categories";?></a>
    <?php } ?>

	<?php if ($p[plist] == "W") { // Our Work ?>
	&nbsp;.&nbsp; <a href="../work/index.php?pid=<?php echo $spid;?>"><?php if ($pg == "work") echo "<strong>Work</strong>"; else echo "Work";?></a>
    <?php } ?>
</p>

<?php } else if ($lid != "" and $ltype == "3") { // News ?>
<p class="contentmenu">
	<a href="../list/update.php?pid=<?php if ($pg == "info") echo $pid; else if ($pg == "gallery") echo $gpage;?>&amp;lid=<?php echo $lid;?>"><?php if ($pg == "info") echo "<strong>Info</strong>"; else echo "Info";?></a> 
	&nbsp;.&nbsp; <a href="../gallery/index.php?pid=<?php echo $lid;?>&amp;gtype=3&amp;gpage=<?php if ($pg == "info") echo $pid; else if ($pg == "gallery") echo $gpage;?>"><?php if ($pg == "gallery") echo "<strong>Gallery</strong>"; else echo "Gallery";?></a>
</p>

<?php } else if ($wid != "") { // Our Work ?>
<p class="contentmenu">
	<a href="../work/update.php?wid=<?php echo $wid;?>"><?php if ($pg == "info") echo "<strong>Info</strong>"; else echo "Info";?></a> 
	&nbsp;.&nbsp; <a href="../gallery/index.php?pid=<?php echo $wid;?>&amp;gtype=4&amp;gpage=4000"><?php if ($pg == "gallery") echo "<strong>Gallery</strong>"; else echo "Gallery";?></a>
</p>

<?php } else if ($cid != "" and $pdid == "") { // Category ?>
<p class="contentmenu">
	<a href="../category/update.php?pid=<?php echo $pid;?>&amp;cid=<?php echo $cid;?>"><?php if ($pg == "info") echo "<strong>Info</strong>"; else echo "Info";?></a> 
	&nbsp;.&nbsp; <a href="../product/index.php?pid=<?php echo $pid;?>&amp;cid=<?php echo $cid;?>"><?php if ($pg == "product") echo "<strong>Products</strong>"; else echo "Products";?></a>
</p>

<?php } else if ($cid != "" and $pdid != "") { // Products ?>
<p class="contentmenu">
	<a href="../product/update.php?pid=<?php echo $pid;?>&amp;cid=<?php echo $cid;?>&amp;pdid=<?php echo $pdid;?>"><?php if ($pg == "info") echo "<strong>Info</strong>"; else echo "Info";?></a> 
	&nbsp;.&nbsp; <a href="../gallery/index.php?pid=<?php echo $pid;?>&amp;gtype=5&amp;gpage=<?php echo $cid;?>&amp;pdid=<?php echo $pdid;?>"><?php if ($pg == "gallery") echo "<strong>Gallery</strong>"; else echo "Gallery";?></a>
</p>

<?php } else if ($lid != "") { // Listing ?>
<p class="contentmenu">
	<a href="../list/update.php?lid=<?php echo $lid;?>"><?php if ($pg == "info") echo "<strong>Info</strong>"; else echo "Info";?></a> 
	&nbsp;.&nbsp; <a href="../gallery/index.php?pid=<?php echo $lid;?>&amp;gtype=3&amp;gpage=<?php echo $pid; ?>"><?php if ($pg == "gallery") echo "<strong>Gallery</strong>"; else echo "Gallery";?></a>
</p>
<?php } ?>