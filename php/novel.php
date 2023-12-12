<!DOCTYPE html>
<!-- 11200149295005 -->
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>小說</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="novel_body">
    <?php include("header.php")?>
    <div class="container">
        <div class="row novel_menu fs-5">
            <div class="col-12 fs-2 text-center">小說狂人爬蟲</div>
            <div class="col-md-6 text-center">
                <label for="url">小說網址</label>
                <input class="form-control" type="text" id="url" placeholder="https://czbooks.net/n/ujceb" value='https://czbooks.net/n/ujceb'>
            </div>
            <div class="col-md-2 text-center">
                <label for="start_chat">開始章節</label>
                <input class="form-control" type="number" id="start_chat" value=1 min=1>
            </div>
            <div class="col-md-2 text-center mb-2">
                <label for="end_chat">結束章節</label>
                <input class="form-control" type="number" id="end_chat" value=2 min=2>
            </div>
            <div class="col-md-2 text-center">
                <button id="Get_Novel" class="btn btn-success">取得小說</button>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row" id="NovelList">
            <div class="col-12 fs-2 text-center chat_name">
                推薦小說
            </div>
            <div class="col-12 text-center chat_txt">
            全職高手
            <p>https://czbooks.net/n/u28b/ucpfc</p>
            醜霸三國
            <p>https://czbooks.net/n/c5i48n</p>
            第一序列
            <p>https://czbooks.net/n/ujceb</p>
            賊警
            <p>https://czbooks.net/n/s6bedg</p>
            獵網
            <p>https://czbooks.net/n/u6hk</p>
            噩盡島一
            <p>https://czbooks.net/n/cjk908</p>
            噩盡島二
            <p>https://czbooks.net/n/ca6g28</p>
            王者時刻
            <p>https://czbooks.net/n/u3n01</p>
            庶女攻略
            <p>https://czbooks.net/n/cajf9h</p>
            詭秘之主
            <p>https://czbooks.net/n/u3h23</p>
            異界之機關大師
            <p>https://czbooks.net/n/ui01c/u5oip</p>
            重生之賊行天下
            <p>https://czbooks.net/n/s6181</p>          
            </div>
        </div>
        <div class="text-center mt-2">
            <button id="Next_chat" class="btn btn-info mb-3">看下一章</button>
        </div>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.6.4.min.js"></script>
    <script src="../js/time.js"></script>
    <script>
        $("#section6_link").css("display", "none");
        $("#section7_link").css("display", "none");

        function showNovel(data) {
            // console.log(data);
            $("#NovelList").empty();
			var obj = JSON.parse(data); // 解析json字串為json物件形式
			if(obj.result == "取得小說成功"){
				obj.novel_data.forEach(novel_chat => {
                    var novel_html = '<div class="col-12 fs-2 text-center chat_name"><a href="' + novel_chat.chat_url + '">' + novel_chat.chat_name + '</a></div><div class="col-12 text-center chat_txt fs-2">' + novel_chat.chat_txt + '</div>';
                    $("#NovelList").append(novel_html);
                });
                window.location.href = '#top';
			}else{
                alert("取得小說失敗");
            }
        }

        var chat_num = -1;
        $("#Next_chat").click(function () {
            chat_num =parseInt($("#end_chat").val()) + 1;
            $("#start_chat").val(chat_num);
            $("#end_chat").val(chat_num);
            var url = $("#url").val();
            var start_chat = $("#start_chat").val();
            var end_chat = $("#end_chat").val();
            if(url === "" || start_chat === "" || end_chat === ""){
                alert("缺少參數");
            }else if(url.indexOf("https://czbooks.net/") === -1){
                alert("此為專爬小說狂人的爬蟲，請重新確認網址");
            }else{
                var formData = new FormData();
				formData.append('type','Get_Novel');
				formData.append('url',url);
				formData.append('start_chat',start_chat);
				formData.append('end_chat',end_chat);
				$.ajax({
					url:'function.php',
					type : 'POST',
					mimeType: 'multipart/form-data',
					data : formData,
					contentType: false,
					cache: false,
					processData: false,
					success : showNovel,
                    error: function(data)
					{
						alert('資料傳輸異常');
					}
				})
            }
        });

        $("#Get_Novel").click(function () {
            // console.log($("#Search_keyword").val());
            var url = $("#url").val();
            var start_chat = parseInt($("#start_chat").val());
            var end_chat = parseInt($("#end_chat").val());
            if(url === "" || start_chat === "" || end_chat === ""){
                alert("缺少參數");
            }else if(url.indexOf("https://czbooks.net/") === -1){
                alert("此為專爬小說狂人的爬蟲，請重新確認網址");
            }else if(Number(start_chat) > Number(end_chat)){
                alert("開始章節不能比結束章節大");
            }else{
                var formData = new FormData();
				formData.append('type','Get_Novel');
				formData.append('url',url);
				formData.append('start_chat',start_chat);
				formData.append('end_chat',end_chat);
				$.ajax({
					url:'function.php',
					type : 'POST',
					mimeType: 'multipart/form-data',
					data : formData,
					contentType: false,
					cache: false,
					processData: false,
					success : showNovel,
                    error: function(data)
					{
						alert('資料傳輸異常');
					}
				})
            }
        });
        
        function keyFunction() {
	        // alert("Key code = " + event.keyCode);
            if(event.keyCode == "39"){
                chat_num =parseInt($("#end_chat").val()) + 1;
                $("#start_chat").val(chat_num);
                $("#end_chat").val(chat_num);
                var url = $("#url").val();
                var start_chat = $("#start_chat").val();
                var end_chat = $("#end_chat").val();
                if(url === "" || start_chat === "" || end_chat === ""){
                    alert("缺少參數");
                }else if(url.indexOf("https://czbooks.net/") === -1){
                    alert("此為專爬小說狂人的爬蟲，請重新確認網址");
                }else{
                    var formData = new FormData();
                    formData.append('type','Get_Novel');
                    formData.append('url',url);
                    formData.append('start_chat',start_chat);
                    formData.append('end_chat',end_chat);
                    $.ajax({
                        url:'function.php',
                        type : 'POST',
                        mimeType: 'multipart/form-data',
                        data : formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success : showNovel,
                        error: function(data)
                        {
                            alert('資料傳輸異常');
                        }
                    })
                }
            }else if(event.keyCode == "37"){
                chat_num =parseInt($("#end_chat").val()) - 1;
                $("#start_chat").val(chat_num);
                $("#end_chat").val(chat_num);
                var url = $("#url").val();
                var start_chat = $("#start_chat").val();
                var end_chat = $("#end_chat").val();
                if(url === "" || start_chat === "" || end_chat === ""){
                    alert("缺少參數");
                }else if(url.indexOf("https://czbooks.net/") === -1){
                    alert("此為專爬小說狂人的爬蟲，請重新確認網址");
                }else{
                    var formData = new FormData();
                    formData.append('type','Get_Novel');
                    formData.append('url',url);
                    formData.append('start_chat',start_chat);
                    formData.append('end_chat',end_chat);
                    $.ajax({
                        url:'function.php',
                        type : 'POST',
                        mimeType: 'multipart/form-data',
                        data : formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success : showNovel,
                        error: function(data)
                        {
                            alert('資料傳輸異常');
                        }
                    })
                }

            }
        }
        document.onkeydown=keyFunction;
    </script>
</body>
</html>