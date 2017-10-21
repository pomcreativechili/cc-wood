<div id="infoarea" class="nogallery">
    <div id="infodetail">
    <?php
        echo '<h2><a href="'.$url.$lgurl.'/'.$purl.'#'.$purl.'/'.$sp[purl].'">'.$sptopic.'</a> &nbsp;&gt;&nbsp; <span>'.$sbptopic.'</span></h2>';
        if ($sbpdetail != "") echo $sbpdetail;
    ?>
    </div>
</div>

<?php if ($sbplist == "1") include("content/list/list.accordian.php");?>