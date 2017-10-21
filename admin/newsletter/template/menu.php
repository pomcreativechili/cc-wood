<p class="contentmenu">
	<a href="update.php?nid=<?php echo $nid;?>"><?php if ($spg == "info") echo "<strong>Overview &amp; Info</strong>"; else echo "Overview &amp; Info";?></a> &nbsp;.&nbsp; 
	<a href="template.php?nid=<?php echo $nid;?>"><?php if ($spg == "template") echo "<strong>Template &amp; Details</strong>"; else echo "Template &amp; Details";?></a> &nbsp;.&nbsp;  
    <img src="resources/images/refresh.png" alt="" /> <a href="?nid=<?php echo $nid;?>">Refresh</a> &nbsp;.&nbsp; 
	<img src="resources/images/view.png" alt="" /> <a href="preview.php?nid=<?php echo $nid;?>"><?php if ($spg == "preview") echo "<strong>Preview &amp; Send</strong>"; else echo "Preview &amp; Send";?></a>
</p>