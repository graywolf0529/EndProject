<?php
$json = file_get_contents('https://czbooks.net/n/ui01c/u5oip');

$first=explode("chapter-detail",$json);
$second=explode('<div class="content">',$first[1]);
$third=explode('</div>',$second[1]);
$final=$third[0];
echo $final;
?>