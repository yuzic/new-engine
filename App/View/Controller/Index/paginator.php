<!-- page navigator -->
<ul class="pagination">
<?php
$pages = ($newsCount / $pageCount) + 1;
for ($i= 1; $i <= $pages; $i++) { ?>
    <li><a href="/page/<?=$i;?>"> <?=$i;?> </a> </li>
<?php }?>
</ul>
