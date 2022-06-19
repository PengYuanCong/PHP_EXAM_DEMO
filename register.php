<?php
ob_start();
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

<body background="https://angelala.tw/wp-content/uploads/2020/04/ex1.jpg" style="background-size:cover;">
    
    <nav>
        <ul class="menu">
            <li class="menu__item"><a href="./index.php">首頁</a></li>
            <li class="menu__item"><a href="./login.php">登入</a></li>
        </ul>
    </nav>
    <div class="container container--col" style="justify-content: center;align-items: center">
        <h2>註冊</h2>
        <form action="register.php" method="POST" style="width: 30%;">
            <label for="username">名稱</label>
            <input type="text" name="username" id="username" /><br>
            <label for="useremail">信箱</label>
            <input type="email" name="useremail" id="useremail" /><br>
            <label for="userpassword">密碼</label>
            <input type="password" name="userpassword" id="userpassword" /><br>
            <?php
            
            
            if(isset($_POST['username']) && isset($_POST['useremail']) && isset($_POST['userpassword'])){
                $name = $_POST['username'];
                $email = $_POST['useremail'];
                $userpassword = $_POST['userpassword'];

                
                include('mysqli_connect.php');
                if(!$conn){
                    die('Could not connect: '.mysqli_connect_error());
                }

                
                $sql = 'select * from users where Username="'.$name.'" or email="'.$email.'";';
                $result = mysqli_query($conn, $sql);
                if(!$result){
                    die('Error: '.mysqli_error($conn));
                }

                $rows = mysqli_fetch_assoc($result);
                if(!$rows){
                    
                    $sql = "Insert into users (Username, Email, Password, date) values('".$name."','".$email."','".$userpassword."','".date("Y-m-d")."');";
                    $result = mysqli_query($conn, $sql);
                    if(!$result){
                        die('Error: '.mysqli_error($conn));
                    }
                    
                    header('location:login.php');
                    ob_end_flush();
                    exit();
                }
                else{
                    echo '<p style="color: red">註冊失敗，請再試一次</p><br>';
                }
            }

            ?>
            <p>已經有帳戶？ <a href="./login.php" style="display: inline">登入</a></p>
            <input type="submit" id="register" name="register" value="註冊" />
        </form>
    </div>
</body>

</html>