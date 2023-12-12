<?php
// include("mysql.php");

header("Access-Control-Allow-Origin: *");

set_time_limit(500);

//小說狂人爬蟲 - 小說全章節的連結與名稱
function Get_novel_chat_name($url) //小說狂人爬蟲
{
    if (preg_match("/^https:\/\/czbooks.net/", $url)) {
        $novel_chat = array();
        $novel_url = explode("//", $url);
        $novel_url = explode("/", $novel_url[1]);
        $novel_url = "//" . $novel_url[0] . "/" . $novel_url[1] . "/" . $novel_url[2];

        $json = file_get_contents("https:".$novel_url);

        //目錄使用
        $first = explode('id="chapter-list">', $json);
        $second = explode('</ul>', $first[1]);
        $novel_list = explode('<li>', $second[0]);
        $n = 0;
        // echo $novel_list[1];
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
function Get_novel_chat_text($novel_chat,$start_chat = 0,$end_chat = 150)
{
    global $mysqli;
    $novel_List = array();
    $n = 0;
    $total = count($novel_chat);
    foreach ($novel_chat as $chat_data) {
        $novel_data = array();
        $n++;
        $e = 820;
        if ($n < $start_chat)
            continue;
        if ($n > ($end_chat))
            break;

        $json = file_get_contents("https:" . $chat_data["chat_url"]);

        $first = explode("chapter-detail", $json);
        // $novel_name = explode($novel_url, $first[1]);
        // $novel_name = explode(" 《目錄》", $novel_name[1]);
        // $novel_name = str_replace('">', '', $novel_name[0]);

        $second = explode('<div class="content">', $first[1]);
        $third = explode('</div>', $second[1]);
        $final = $third[0];
        // echo "<h3>" . $n . "<a href='" . $chat_data['chat_url'] . "'>" . $chat_data['chat_name'] . "</a></h3>";
        // echo "<h1>" . $final . "</h1>";
        $novel_data["chat_no"] = $n;
        $novel_data["chat_url"] = $chat_data['chat_url'];
        $novel_data["chat_name"] = $chat_data['chat_name'];
        $novel_data["chat_txt"] = $final;
        array_push($novel_List, $novel_data);
    }
    return $novel_List;
}

// function Login_check($username, $password)
// {
//     global $mysqli;
//     $sql = "SELECT * FROM user_account WHERE username='" . $username . "' AND password='" . $password . "'";
//     $sql_result = $mysqli->query($sql);
//     if (mysqli_num_rows($sql_result) != 0) {
//         $user_data = array();
//         while ($row = $sql_result->fetch_assoc()) {
//             array_push($user_data, $row);
//         }
//         // echo "<h1>登入成功</h1>";
//         return $user_data;
//     } else {
//         // echo "<h1>登入失敗</h1>";
//         return false;
//     }
// }

// 異界之機關大師
// $url = 'https://czbooks.net/n/ui01c/u5oip';
// 全職高手
// $url = 'https://czbooks.net/n/u28b/ucpfc';
// 庶女
// $url = 'https://czbooks.net/n/cajf9h';
// 醜霸三國
// $url = 'https://czbooks.net/n/c5i48n';
// 王者時刻
// $url = 'https://czbooks.net/n/u3n01';
// 噩盡島一
// $url = 'https://czbooks.net/n/cjk908';
// 噩盡島二
// $url = 'https://czbooks.net/n/ca6g28';
// 詭秘之主
// $url = 'https://czbooks.net/n/u3h23';
// 第一序列
// $url = 'https://czbooks.net/n/ujceb';

$respond_arr = array();
if(isset($_POST["type"])){
    switch ($_POST["type"]) {
        case "Login": // 登入
            $user_data = Login_check($_POST["username"], $_POST["password"]);
            if(Login_check($_POST["username"], $_POST["password"])){
                $respond_arr["result"] = "登入成功";
                $respond_arr["user_data"] = $user_data;
            }else{
                $respond_arr["result"] = "登入失敗";
            }
            break;
        case "Get_Novel": // 獲取小說
            $novel_chat = Get_novel_chat_name($_POST["url"]);
            $novel_data = Get_novel_chat_text($novel_chat,$_POST["start_chat"],$_POST["end_chat"]);
            $respond_arr["result"] = "取得小說成功";
			$respond_arr["novel_data"] = $novel_data;
            break;
        case "GameData":
            if($_POST["action"]=="List"){
                $sql = "SELECT * FROM game_data";
            }elseif($_POST["action"]=="Search"){
                $sql = "SELECT * FROM game_data WHERE p_name LIKE '%".$_POST["Search_keyword"]."%' OR p_note LIKE '%".$_POST["Search_keyword"]."%'";
            }elseif($_POST["action"]=="New"){
                $sql = "INSERT INTO game_data (p_name,p_price,p_number,p_note,img_src) VALUES ('".$_POST["n_p_name"]."','".$_POST["n_p_price"]."','".$_POST["n_p_number"]."','".$_POST["n_p_note"]."','0302.jpg')";
            }
            $sql_result = $mysqli->query($sql);
            if($_POST["type"]=="New"){
                $respond_arr["result"] = "新增完成";
            }else{
                if (mysqli_num_rows($sql_result) != 0) {
                    $respond_arr["result"] = "Select Game Data Success";
                    $game_data = array();
                    while ($row = $sql_result->fetch_assoc()) {
                        // echo "<tr><td>".$row["sn"]."</td><td>".$row["p_name"]."</td><td>".$row["p_price"]."</td><td>".$row["p_number"]."</td><td>".$row["p_note"]."</td><td>".$row["Create_time"]."</td></tr>";
                        array_push($game_data,$row);
                    }
                    $respond_arr["game_data"] = $game_data;
                }else{
                    $respond_arr["result"] = "Select Game Data False";
                }
            }
            break;
        default:
            $respond_arr["result"] = "請輸入正確類型";
            break;
    }
}

echo json_encode($respond_arr,JSON_UNESCAPED_UNICODE); // 將結果轉為json編碼