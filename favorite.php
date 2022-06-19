<?php
session_start();
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
    <!-- TODO: nav -->
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
        </ul>
    </nav>
    <div class="container">
        <div class="sidebar" style="flex-grow: 1;">
            <ul class="menu" style="flex-flow: column wrap;">
                <li class="menu__item" style="display: block;text-align: left"><a href="./history.php">搜尋紀錄</a></li>
                <li class="menu__item" style="display: block;text-align: left"><a href="./favorite.php">我的最愛</a></li>
                <li class="menu__item" style="display: block;text-align: left"><a href="./modify.php">資料修改</a></li>
                <li class="menu__item" style="display: block;text-align: left"><a href="./logout.php">登出</a></li>
            </ul>
        </div>
        <main style="flex-grow: 10">
            <h2>我的最愛</h2><br>
            <article>
            <?php
            
            include('mysqli_connect.php');
            if(!$conn){
                die('Could not connect: '.mysqli_connect_error());
            }
            
            mysqli_set_charset($conn,'utf8');

            $sql = 'select R.Resname, R.ResAddress, R.Phone
                    from favorite as F,restaurants as R 
                    where Username="'.$_SESSION['valid_user'].'" and R.Resname=F.Resname;';
            $result = mysqli_query($conn, $sql);
            if(!$result){
                die('Error: '.mysqli_error($conn));
            }
            
            $num = mysqli_num_rows($result);
            
            
            for($i=0; $i<$num; $i++){
                $rows = mysqli_fetch_assoc($result);
                
                if($rows){                    
                    echo '<a href="./article.php?restaurant='.$rows['Resname'].'&count=yes">
                              <div>
                                  <h3>'.$rows['Resname'].'</h3><br>
                                  <p>'.$rows['Phone'].'</p>
                                  <p>'.$rows['ResAddress'].'</p>
                              </div>
                          </a><hr>';
                }
            }
            
            ?>
            </article>
        </main>
    </div>
</body>

</html>