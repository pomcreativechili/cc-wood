<link href="../../css/zoomy.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../js/jquery.js"></script>
<script type="text/javascript" src="../../js/zoomy.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(".productzoom").hide();
	$(".productzoom").fadeIn(200);
	$(".productzoom").zoomy({ border:"3px solid #fff" }); 
});
</script>
<?php
	$gfile = $_GET['gfile'];
	echo '<a href="'.$gfile.'" class="productzoom"><img src="'.$gfile.'" alt="" /></a>';
?>