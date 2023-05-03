<?php
//小說狂人爬蟲

//異界之機關大師
$url = 'https://czbooks.net/n/ui01c/u5oip';
//全職高手
// $url = 'https://czbooks.net/n/u28b/ucpfc';

$novel_url=explode("//",$url);
$novel_url=explode("/",$novel_url[1]);
$novel_url="//".$novel_url[0]."/".$novel_url[1]."/".$novel_url[2];
echo "<h1>".$novel_url."</h1>";

$json = file_get_contents("https:".$novel_url);

//目錄使用
$first=explode('<li class="volume">正文</li>',$json);
$second=explode('</ul>',$first[1]);
$novel_list = explode('<li>',$second[0]);
$n = 0;
foreach($novel_list as $novel_chat){
    if($n==0){
        $n++;
        continue;
    }
    $novel_chat_name = explode('</a>',$novel_chat);
    $novel_chat_name = explode('">',$novel_chat_name[0]);
    $novel_chat_url = explode('="',$novel_chat_name[0]);
    $novel_chat_url = $novel_chat_url[1];
    $novel_chat_name_final = $novel_chat_name[1];
    echo "<h3><a href='".$novel_chat_url."'>".$novel_chat_name_final."</a></h3>";
    $n++;
}




/*章節使用
$first=explode("chapter-detail",$json);
$novel_name = explode($novel_url,$first[1]);
$novel_name = explode(" 《目錄》",$novel_name[1]);
$novel_name = str_replace('">','',$novel_name[0]);

echo "<h2>".$novel_name."</h2>";

$second=explode('<div class="content">',$first[1]);
$third=explode('</div>',$second[1]);
$final=$third[0];
echo $final;
*/

?>