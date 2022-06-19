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
        <h2>登入</h2>
        <form action="login.php" method="POST" style="width: 30%;">
            <label for="useremail">信箱</label>
            <input type="email" name="useremail" id="useremail" /><br>
            <label for="userpassword">密碼</label>
            <input type="password" name="userpassword" id="userpassword" /><br>
            <?php
            
            if(isset($_POST['useremail']) && isset($_POST['userpassword'])){
                $email = $_POST['useremail'];
                $userpassword = $_POST['userpassword'];

                
                include('mysqli_connect.php');
               
                $sql = 'select * from users where Email="'.$email.'" and Password="'.$userpassword.'";';
                $sql_admin = 'select * from users where Email="'.$email.'" and Password="'.$userpassword.'" and Username="admin";';
                $result = mysqli_query($conn, $sql);
                $result_admin= mysqli_query($conn, $sql_admin);
                if(!$result){
                    die('Error: '.mysqli_error($conn));
                }

                $rows = mysqli_fetch_assoc($result);
                $row_admin=mysqli_fetch_assoc($result_admin);
                if($row_admin){                    
                    $_SESSION['valid_user']=$row_admin['Username'];
                    
                    header('location:admin_index.php');
                    ob_end_flush();
                    exit();
                }
                
                else if($rows){
                    $_SESSION['valid_user']=$rows['Username'];
                    
                    header('location:index.php');
                    ob_end_flush();
                    exit();
                }
                
                
                else{
                    echo '<p style="color: red">登入失敗，請再試一次</p><br>';
                }
            }

            ?>
            <p>還沒有帳戶嗎？ <a href="./register.php" style="display: inline">註冊</a></p>
            <input type="submit" id="login" name="login" value="登入" />
        </form>
        
    </div>
</body>

</html>