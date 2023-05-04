<?php
include("mysql.php");

//小說狂人爬蟲 - 小說全章節的連結與名稱
function Get_novel_chat_name($url)//小說狂人爬蟲
{
    if (preg_match("/^https:\/\/czbooks.net/", $url)) {
        $novel_chat = array();
        $novel_url = explode("//", $url);
        $novel_url = explode("/", $novel_url[1]);
        $novel_url = "//" . $novel_url[0] . "/" . $novel_url[1] . "/" . $novel_url[2];

        $json = file_get_contents("https:" . $novel_url);

        //目錄使用
        $first = explode('<li class="volume">正文</li>', $json);
        $second = explode('</ul>', $first[1]);
        $novel_list = explode('<li>', $second[0]);
        $n = 0;
        foreach ($novel_list as $novel_chat_data) {
            if ($n == 0) {
                $n++;
                continue;
            }
            $novel_chat_name = explode('</a>', $novel_chat_data);
            $novel_chat_name = explode('">', $novel_chat_name[0]);
            $novel_chat_url = explode('="', $novel_chat_name[0]);
            $novel_chat_url = $novel_chat_url[1];
            $novel_chat_name_final = $novel_chat_name[1];
            // echo "<h3><a href='" . $novel_chat_url . "'>" . $novel_chat_name_final . "</a></h3>";
            $n++;
            $final = array("chat_name" => $novel_chat_name_final, "chat_url" => $novel_chat_url);
            array_push($novel_chat, $final);
        }
        return $novel_chat;
    } else {
        return false;
    }
}

//小說狂人爬蟲 - 小說章節內容
function Get_novel_chat_text($novel_chat)
{
    global $mysqli;
    $novel_text = array();
    $n = 0;
    foreach ($novel_chat as $chat_data) {
        $n++;
        if($n<919)continue;
        $json = file_get_contents("https:" . $chat_data["chat_url"]);

        $first = explode("chapter-detail", $json);
        // $novel_name = explode($novel_url, $first[1]);
        // $novel_name = explode(" 《目錄》", $novel_name[1]);
        // $novel_name = str_replace('">', '', $novel_name[0]);

        $second = explode('<div class="content">', $first[1]);
        $third = explode('</div>', $second[1]);
        $final = $third[0];
        echo "<h3>".$n."<a href='" . $chat_data['chat_url'] . "'>" . $chat_data['chat_name'] . "</a></h3>";
        echo "<h1>".$final."</h1>";
        array_push($novel_text,$final);
    }
    return $novel_text;
}

//異界之機關大師
$url = 'https://czbooks.net/n/ui01c/u5oip';
//全職高手
// $url = 'https://czbooks.net/n/u28b/ucpfc';
$novel_chat=Get_novel_chat_name($url);
Get_novel_chat_text($novel_chat);