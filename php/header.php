<?php
    session_start();
    // if (!isset($_SESSION['username'])){
    //     header('Location: login.php');
    // }
?>

<header id="menu">
    <!-- ****section 1******* -->
    <section class="bg-secondary" id="section1">
        <div class="container text-end">
            <a href="https://zh-tw.facebook.com/" target="_blank"><i
                    class="fa-brands fa-square-facebook text-white"></i></a>
            <a href="https://twitter.com/?lang=zh-Hant" target="_blank"><i
                    class="fa-brands fa-square-twitter text-white"></i></a>
            <a href="https://www.youtube.com/" target="_blank"><i
                    class="fa-brands fa-square-youtube text-white"></i></a>
            <a href="https://www.instagram.com/" target="_blank"><i
                    class="fa-brands fa-square-instagram text-white"></i></a>
        </div>
    </section>
    <!-- ****section time******* -->
    <section class="bg-dark text-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6 fs-3 text-center" id="now_date">2023-05-12</div>
                <div class="col-md-6 fs-3 text-center" id="now_time">02:48</div>
            </div>
        </div>
    </section>
    <!-- ****section 2******* -->
    <section class="bg-dark">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <i class="fa-solid fa-gamepad text-danger fa-2x"></i>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="true" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="navbar-collapse collapse show" id="navbarSupportedContent" style="">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php">首頁</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#section6" id="section6_link">關於本站</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    其他功能
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="novel.php">小說狂人爬蟲</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="ToDoList.php">To Do List</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item disabled" href="#">遊戲攻略(敬請期待)</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="game.php">電腦遊戲</a></li>
                                    <li id="section7_link"><a class="dropdown-item text-danger" href="#section7">最新上架</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="d-flex" role="search">
                            <form action="login.php" method="POST">
                                <input type="submit" class="btn btn-outline-danger me-1" value="登出" name="logout" id="logout">
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </section>
</header>

<div id="gotop"><i class="fa-solid fa-arrow-turn-up"></i><div class="fs-6" id="now_time2">02:48</div></div>