<?php
session_start();


include('mysqli_connect.php');
if(!$conn){
    die('Could not connect: '.mysqli_connect_error());
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>高大生活圈美食地圖</title>
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body background="https://buzzorange.com/vidaorange/app/uploads/2019/01/25075199_1772429162799458_291105505606266310_o-e1622690459652-800x400.jpeg" style="background-size:cover;">
    
    <nav>
        <ul class="menu">
            <li class="menu__item"><a href="./index.php">首頁</a></li>
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
        </ul>
    </nav>
    <div class="container">
        <div class="sidebar" style="flex-grow: 2;">
            <ul class="menu" style="flex-flow: column wrap;">
                <li class="menu__item" style="display: block;text-align: left"><a href="./update.php">會員資料更新</a></li>
                <li class="menu__item" style="display: block;text-align: left"><a href="./deleteAdmin.php">會員資料刪除</a></li>
                <li class="menu__item" style="display: block;text-align: left"><a href="./logout.php">登出</a></li>
            </ul>
        </div>
        <main style="flex-grow: 1">
            <h2>會員資料</h2><br>
            <?php
              $SQL="SELECT * FROM users";

              if($result=mysqli_query($conn,$SQL)){
                echo"<table border='4' width='800' height='250'>";
                echo "<tr><td><h4>會員帳號</h4></td><td><h4>會員郵件</h4></td><td><h4>會員密碼</h4></td><td>";
                while($row=mysqli_fetch_assoc($result)){
                  echo "<tr>";
                  echo "<td>".$row["Username"]."</td><td>".$row["Email"]."</td><td>".$row["Password"]."</td><td>";
                  echo "</tr>";
                }
              }
                echo "</table>";
            ?>
            </form>
        </main>
    </div>
</body>

</html>