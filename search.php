<?php
session_start();

$type = $_POST['type'];
$search = $_POST['search'];


include('mysqli_connect.php');

mysqli_set_charset($conn,'utf8');


switch($type){
    case 'restaurant':
      $sql = 'select * from restaurants as R, nearby as N
              where R.Resname like "%'.$search.'%" and R.Resname=N.Resname;';    
      break;
    case 'BUS':
      $sql = 'select * from restaurants as R, nearby as N
              where R.BUS like "%'.$search.'%" and R.Resname=N.Resname;';
      break;
}
$result = mysqli_query($conn, $sql);
if(!$result){
    die('Error: '.mysqli_error($conn));
}

$num = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<font face="標楷體">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>高大生活圈美食地圖</title>
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body background="https://shijuecanyin.com/editpic/image/20200619/20200619134944734473.jpg" style="background-size:cover;">
    
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
    <div class="container ">
        <main style="flex-grow: 1">
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
                    </label>
                </div>
            </form>
            <br>
            <article>
            <?php
            
            if($num==0){
                echo '<p>沒有 <b>'.$search.'</b> 的相關結果</p><br>';
            }
            else{
                echo '<p>查詢 <b>'.$search.'</b> 的相關結果：</p><br>';
                for($i=0; $i<$num; $i++){
                    $rows = mysqli_fetch_assoc($result);

                    if($rows){                    
                        echo '<a href="./article.php?restaurant='.$rows['Resname'].'&count=yes" target="_blank">
                                  <div style="color:red;">
                                      <h3>'.$rows['Resname'].'</h3><br>
                                      <p>電話：'.$rows['Phone'].'</p>
                                      <p>地址：'.$rows['ResAddress'].'</p>
                                      <p>附近公車站：'.$rows['BUS'].'</p>
                                  </div>
                              </a><hr>';
                    }
                }
            }

            ?>
            </article>
        </main>
    </div>
</body>

</font>
</font>

</html>