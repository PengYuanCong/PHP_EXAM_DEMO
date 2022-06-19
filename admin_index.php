<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<font color="white"> 
<font face="標楷體">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>美食地圖</title>
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body background="https://angelala.tw/wp-content/uploads/2020/04/ex1.jpg" style="background-size:cover;">
    <!-- TODO: nav -->
    <nav>
        <ul class="menu">
            <li class="menu__item"><a href="./index.php">首頁</a></li>
            <?php
            if(isset($_SESSION['valid_user'])){
            ?>
                <li class="menu__item"><a href="#">會員</a>
                    <ul class="submenu submenu--block">
                        <li><a href="./history.php">搜尋紀錄</a></li>
                        <li><a href="./favorite.php">我的最愛</a></li>
                        <li><a href="./modify.php">資料修改</a></li>
                        <li><a href="./logout.php">登出</a></li>
                    </ul>
                </li>
                <li class="menu__item"><a href="#">會員管理</a>
                    <ul class="submenu submenu--block">
                        <li><a href="./admin_modify.php">會員資料管理</a></li>
                        <li><a href="./update.php">會員資料更新</a></li>
                        <li><a href="./deleteAdmin.php">會員資料刪除</a></li>
                        <li><a href="./logout.php">登出</a></li>
                    </ul>
                </li>
        </ui>        
            <?php
            }
            else{
            ?>
                <li class="menu__item"><a href="./login.php">登入</a></li>
            <?php
            }
            ?>
        </ul>
    </nav>
    <header style="background-color: transparent">
        <div class="banner">   
            <div style="text-align: center">
                <h1>高大生活圈美食地圖</h1>
                <h3>走過路過不要錯過!高大生活圈美食等你~~</h3>
           
            </div>
            <form action="./search.php" method="POST">
                <div style="display: flex;justify-content: space-between;">
                    <input type="text" name="search" style="width: 90%;" placeholder="請輸入關鍵字" />
                    <input type="submit" value="送出" />
                </div>
                <div style="display: flex;justify-content: flex-start">
                    <label for="restaurant">
                        <input type="radio" name="type" value="restaurant" id="restaurant" checked>餐廳名
                    </label>
                    <label for="BUS">
                        <input type="radio" name="type" value="BUS" id="BUS">公車站                      
                </div>
            </form>
        </div>
    </header>
</body>
</font>
</font>

</html>