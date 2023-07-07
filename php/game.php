<!DOCTYPE html>
<!-- 11200149295005 -->
<html lang="zh-Hant-TW">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Data</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body{
            background-image: linear-gradient(180deg, rgba(5, 93, 194, 0.247),rgba(69, 8, 235, 0.849));
        }
        .card-hover:hover{
            background-image: linear-gradient(180deg, rgba(221, 66, 5, 0.247),rgba(235, 212, 8, 0.849));;
        }
    </style>
</head>

<body>
    <?php include("header.php")?>
    <div class="container">
        <div class="row">
            <div class="col-md-2 mt-2 offset-md-2">
                <button id="List" value="List" class="btn btn-success">列出所有</button>
            </div>
            <div class="col-md-4 mt-2">
                <div class="d-inline"><label for="Search_keyword" class="form-label">搜尋：</label><input type="text"
                        class="form-control" placeholder="搜尋關鍵字" id="Search_keyword"></div>
            </div>
            <div class="col-md-2 mt-2">
                <button id="Search" value="Search" class="btn btn-info">搜尋</button>
            </div>
            <div class="col-md-8 offset-md-2 mt-2">
                <table class="table table-bordered text-center" id="data_table">
                    <thead>
                        <tr>
                            <th>編碼</th>
                            <th>產品名稱</th>
                            <th>價格</th>
                            <th>庫存</th>
                            <th>備註</th>
                            <th>建檔時間</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="col-md-8 offset-md-2 mt-2">
                <label for="n_p_name" class="fs-3">新增商品：</label>
                <input type="text" class="form-control" id="n_p_name">
                <label for="n_p_price" class="fs-3">價格：</label>
                <input type="number" class="form-control" id="n_p_price">
                <label for="n_p_number" class="fs-3">庫存：</label>
                <input type="number" class="form-control" id="n_p_number">
                <label for="n_p_note" class="fs-3">平台：</label>
                <input type="text" class="form-control" id="n_p_note">
                <input type="button" class="btn btn-lg btn-success mt-2" value="新增" id="new_p">
            </div>
            <!-- <div class="col-md-2 offset-md-2 mt-2" id="Other">
                <button id="Api" value="Api" class="btn btn-warning">串接</button>
            </div>
            <div class="col-md-6 mt-2">
                <input type="text" class="form-control" placeholder="串接來源" id="Api_url"
                    value="http://192.168.60.40/web202302/20230526_R.php">
            </div>
            <div class="col-md-8 offset-md-2 mt-2" id="Other">
                <ol class="list-group list-group-numbered" id="ListGroup">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Subheading</div>
                            Content for list item
                        </div>
                        <span class="badge bg-primary rounded-pill">14</span>
                    </li>
                </ol>
            </div> -->
        </div>
        <div class="row" id="card_list">
            <!-- <div class="col-md-3 mt-2">
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div> -->
        </div>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.6.4.min.js"></script>
    <script src="../js/time.js"></script>
    <script>
        $("#section6_link").css("display", "none");
        $("#section7_link").css("display", "none");

        function showData(data) {
            console.log(data);
            if(data.result == "Select Game Data False"){
                var html_str = "<tr><td colspan='6'>查無資料</td></tr>";
                $("#data_table tbody").append(html_str);
            }else{
                $.each(data.game_data, function () {
                    var html_str = "<tr><td>" + this.sn + "</td><td>" + this.p_name + "</td><td>" + this.p_price + "</td><td>" + this.p_number + "</td><td>" + this.p_note + "</td><td>" + this.Create_time + "</td></tr>";
                    var html_card = '<div class="col-md-3 mt-2"><div class="card h-100 card-hover" style="width: 18rem;"><img src="../images/' + this.img_src + '" class="card-img-top card_img_size"><div class="card-body d-flex flex-column"><h5 class="card-title mt-auto">'+ this.p_name +'</h5><p class="card-text">'+ this.p_note +'</p><p>立即訂購 只要'+this.p_price+'元</p><p>剩餘數量：'+ this.p_number +'</p><a href="#" class="btn btn-danger">訂購</a></div></div>';
                    $("#data_table tbody").append(html_str);
                    $("#card_list").append(html_card);
                })
            }
        }

        function alertData(data) {
            console.log(data);
        }

        $("#List").click(function () {
            $("#card_list").empty();
            $("#data_table tbody").empty();
            let formData = new FormData();
            formData.append('type', 'GameData');
            formData.append('action', 'List');
            $.ajax({
                type: "POST",
                url: "function.php",
                dataType: "json",
                // 告訴jQuery不要去處理髮送的資料
                processData: false,
                // 告訴jQuery不要去設定Content-Type請求頭
                contentType: false,
                data: formData,
                success: showData,
                error: function () {
                    console.log("error")
                }
            })
        });
        
        $("#Search").click(function () {
            // console.log($("#Search_keyword").val());
            if ($("#Search_keyword").val() == "") {
                alert("請輸入關鍵字再搜尋!");
            } else {
                $("#card_list").empty();
                $("#data_table tbody").empty();
                var formData = new FormData();
                formData.append('type', 'GameData');
                formData.append('action', 'Search');
                formData.append('Search_keyword', $("#Search_keyword").val());
                $.ajax({
                    type: "POST",
                    url: "function.php",
                    dataType: "json",
                    // 告訴jQuery不要去處理髮送的資料
                    processData: false,
                    // 告訴jQuery不要去設定Content-Type請求頭
                    contentType: false,
                    data: formData,
                    success: showData,
                    error: function () {
                        console.log("error");
                    }
                })
            }
        });

        $("#new_p").click(function () {
            // console.log($("#Search_keyword").val());
            if ($("#n_p_name").val() == "" || $("#n_p_price").val() == "" || $("#n_p_number").val() == "" || $("#n_p_note").val() == "") {
                alert("請輸入完整資料!");
            } else {
                var formData = new FormData();
                formData.append('type', 'GameData');
                formData.append('action', 'New');
                formData.append('n_p_name', $("#n_p_name").val());
                formData.append('n_p_price', $("#n_p_price").val());
                formData.append('n_p_number', $("#n_p_number").val());
                formData.append('n_p_note', $("#n_p_note").val());
                $.ajax({
                    type: "POST",
                    url: "function.php",
                    dataType: "json",
                    // 告訴jQuery不要去處理髮送的資料
                    processData: false,
                    // 告訴jQuery不要去設定Content-Type請求頭
                    contentType: false,
                    data: formData,
                    success: alertData,
                    error: function () {
                        console.log("error");
                    }
                })
            }
        });

        function showApi(data) {
            console.log(data);
            $("#ListGroup").empty();
            var n = 0;
            $.each(data, function () {
                n++;
                if (this.type == "error") {
                    var html_str = "<tr><td colspan='6'>查無資料</td></tr>"
                } else {
                    var html_str = '<li class="list-group-item d-flex justify-content-between align-items-start"><div class="ms-2 me-auto"><div class="fw-bold">第' + n + '筆</div><hr>';
                    $.each(this, function (key, value) {
                        // console.log('索引值為:'+key+'，值為:'+value);
                        html_str += key + '：' + value + '<hr>';
                    });
                    html_str += '</div><span class="badge bg-primary rounded-pill">' + n + '</span></li>';
                }
                $("#ListGroup").append(html_str);
            });
        }

        // $("#Api").click(function () {
        //     // console.log($("#Search_keyword").val());
        //     var Api_url = $("#Api_url").val();
        //     $.ajax({
        //         type: "POST",
        //         url: Api_url,
        //         dataType: "json",
        //         // 告訴jQuery不要去處理髮送的資料
        //         processData: false,
        //         // 告訴jQuery不要去設定Content-Type請求頭
        //         contentType: false,
        //         success: showApi,
        //         error: function () {
        //             console.log("error");
        //         }
        //     })
        // });
    </script>
</body>

</html>