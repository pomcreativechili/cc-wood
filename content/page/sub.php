<div id="infoarea" class="nogallery">
	<?php echo '<h2><a href="'.$url.$lgurl.'/'.$purl.'#'.$purl.'/'.$sp[purl].'">'.$sptopic.'</a> | '.$sbptopic.'</h2>'; ?>
    <div id="infodetail">
    <?php if ($sbpdetail != "") echo $sbpdetail; ?>
    </div>
</div>

<?php if ($sbplist == "1") include("content/list/list.accordian.php");?>