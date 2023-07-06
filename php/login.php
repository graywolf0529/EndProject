<!DOCTYPE html>
<!-- 11200149295005 -->
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入頁面</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <style>
        body {
            background-color: black;
        }
    </style>
</head>
<body>
    <?php
    include("mysql.php");
    if (isset($_POST["login"])) {
        /*
        $login_check=login_check($_POST["username"],$_POST["password"]);
        if($login_check){
            echo "<h1>登入成功</h1>";
            session_start();
            $_SESSION["username"] = $login_check[0]["username"];
            $_SESSION["permissions"] = $login_check[0]["permissions"];
            header('Location: index.php');
        }else{
            echo "<h1>登入失敗</h1>";
        }
        */
        $sql = "SELECT * FROM user_account WHERE username='" . $_POST["username"] . "' AND password='" . $_POST["password"] . "'";
        $sql_result = $mysqli->query($sql);
        if (mysqli_num_rows($sql_result) != 0) {
            $user_data = array();
            while ($row = $sql_result->fetch_assoc()) {
                array_push($user_data, $row);
            }
            echo "<h1>登入成功</h1>";
            session_start();
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["permissions"] = $user_data[0]["permissions"];
            header('Location: index.php');
        } else {
            echo "<h1>登入失敗</h1>";
        }
    }
    ?>
    <div class="login_body">
        <form action="" method="post">
            <div class="login_box row w-75 align-items-center">
                <div class="col-md-6 col-sm-12 mt-2 mb-2 text-center">
                    <label for="username">帳號(Account)：</label>
                </div>
                <div class="col-md-6 col-sm-12 mb-2">
                    <input class="form-control" type="text" id="username" name="username">
                </div>
                <div class="col-md-6 col-sm-12 mb-2 text-center">
                    <label for="password">密碼(Password)：</label>
                </div>
                <div class="col-md-6 col-sm-12 mb-2">
                    <input class="form-control" type="password" id="password" name="password">
                </div>
                <div class="col-12 mt-2 mb-2 text-center">
                    <button class="btn btn-success btn-lg" type="submit" id="login" name="login" value="login">登入</button>
                </div>
            </div>
        </form>
    </div>
    <div class="respone"></div>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.6.4.min.js"></script>
    <script>

    </script>
</body>

</html>