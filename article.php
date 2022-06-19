<?php
session_start();


include('mysqli_connect.php');

mysqli_set_charset($conn,'utf8');


if(isset($_SESSION['valid_user']) && isset($_GET['count'])){
    $sql = 'insert ignore into search values
            ("'.$_SESSION['valid_user'].'","'.$_GET['restaurant'].'");';
    $result = mysqli_query($conn, $sql);
    if(!$result){
        die('Error: '.mysqli_error($conn));
    }

    
    $sql = 'select * from favorite 
            where Username="'.$_SESSION['valid_user'].'" and Resname="'.$_GET['restaurant'].'";';
    $result = mysqli_query($conn, $sql);
    if(!$result){
        die('Error: '.mysqli_error($conn));
    }
    $rows = mysqli_fetch_assoc($result);
    if($rows){
        $flag="t";
    }
    else{
        $flag="f";
    }
}


$sql = 'select * from restaurants
        where Resname="'.$_GET['restaurant'].'";';
$result = mysqli_query($conn, $sql);
if(!$result){
    die('Error: '.mysqli_error($conn));
}


$num = mysqli_num_rows($result);

$rows = mysqli_fetch_assoc($result);
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

<body background="https://djoz5lxnk7z2u.cloudfront.net/large/providers/hong-kong-catering-business-catering-kids-birthday-party/hong-kong-catering-business-catering-kids-birthday-party1.jpg" style="background-size:cover">
    
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
    <div class="container">
        <main style="flex-grow: 1">
            <h2 style="margin-bottom: 25px"><?php echo $_GET['restaurant']; ?></h2>
            <h3 style="margin-bottom: 15px">基本資料</h3><br>
            <p><b>電話：</b><?php echo $rows['Phone']; ?></p>
            <p><b>地址：</b><?php echo $rows['ResAddress']; ?></p>
            <p><b>類型：</b><?php echo $rows['ResType']; ?></p>
            <p><b>營業時間：</b><?php echo $rows['OpenTime']; ?></p>
            <br>
            
             
            <h3 style="margin-bottom: 15px">簡介</h3><br>
            <p style="text-indent: 2em;"><?php echo $rows['info']; ?></p>
            <br>
            
            <?php
            if(isset($_SESSION['valid_user'])){
                if(isset($_GET['flag'])){
                  $flag=$_GET['flag'];
                }
                
                if($flag=="t"){
                    echo '<form action="./article.php?restaurant='.$_GET['restaurant'].'&flag=f" method="POST">
                              <input type="submit" value="從我的最愛移除" id="deleteFavor" name="deleteFavor" style="margin-left: 0;padding: 5px" />
                          </form><br>';
                }
                if($flag=="f"){
                    echo '<form action="./article.php?restaurant='.$_GET['restaurant'].'&flag=t" method="POST">
                              <input type="submit" value="加入我的最愛" id="addFavor" name="addFavor" style="margin-left: 0;padding: 5px" />
                          </form><br>'; 
                }

                
                if(isset($_POST['deleteFavor'])){
                    $sql = 'delete from favorite 
                            where Username="'.$_SESSION['valid_user'].'" and Resname="'.$_GET['restaurant'].'";';
                    $result = mysqli_query($conn, $sql);
                    if(!$result){
                        die('Error: '.mysqli_error($conn));
                    }

                    $flag="f";
                }
                    
                
                if(isset($_POST['addFavor'])){
                    $sql = 'insert ignore into favorite values("'.$_SESSION['valid_user'].'","'.$_GET['restaurant'].'");';
                    $result = mysqli_query($conn, $sql);
                    if(!$result){
                        die('Error: '.mysqli_error($conn));
                    }

                    $flag="t";
                }
            }
            ?>
            <h3 style="margin-bottom: 15px">留言板</h3><br>
            <?php
            if(isset($_SESSION['valid_user'])){
                echo '<form action="./article.php?restaurant='.$_GET['restaurant'].'" method="POST">
                          <p><b>留言人： </b>'.$_SESSION['valid_user'].'</p>
                          <p><b>留言內容： </b></p>
                          <textarea name="msg" id="msg" cols="30" rows="10" required></textarea>
                          <br>
                          <p><b>星星數： </b></p>
                          <input type="number" id="star" name="star" min="0" max="5" required /><br>
                          <input type="submit" value="送出" name="comment" id="comment" style="margin-left: 0" />
                      </form><br>';
            }
            else {
                echo '<p>登入後才可以留言喔喔喔喔喔喔</p><br>';
            }

            
            if(isset($_POST['comment'])){
                $sql = 'insert ignore into comments values
                    ("'.$_SESSION['valid_user'].'","'.$_GET['restaurant'].'","'.$_POST['star'].'","'.$_POST['msg'].'")';
                $result = mysqli_query($conn, $sql);
                if(!$result){
                    die('Error: '.mysqli_error($conn));
                }
            }            

            
            $sql = 'select * from comments
                    where Resname="'.$_GET['restaurant'].'";';
            $result = mysqli_query($conn, $sql);
            if(!$result){
                die('Error: '.mysqli_error($conn));
            }
            
            
            $num = mysqli_num_rows($result);
            
            for($i=0; $i<$num; $i++){
                $rows = mysqli_fetch_assoc($result);

                echo '<div class="comment" style="background-color:lightpink;">
                          <div class="comment__content">
                              <h3>留言人:'.$rows['Username'].'</h3>
                              <p>星星:'.$rows['Star'].'</p><br>
                          </div>
                          <p>留言內容:'.$rows['Msg'].'</p>
                      </div>';
            }

            ?>           
        </main>
    </div>
</body>

</html>