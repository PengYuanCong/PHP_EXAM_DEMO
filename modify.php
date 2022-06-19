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
            <h2>資料修改</h2><br>
            <form action="./modify.php" method="POST">
                <label for="username">名稱</label>
                <input type="text" name="username" id="username" value="<?php echo $_SESSION['valid_user']; ?>" disabled/><br>
                <label for="useremail">信箱</label>
                <input type="email" name="useremail" id="useremail" required /><br>
                <label for="userOldpsw">舊密碼</label>
                <input type="password" name="userOldpsw" id="userOldpsw" required /><br>
                <label for="userNewpsw">新密碼</label>
                <input type="password" name="userNewpsw" id="userNewpsw" required /><br>
                <?php
                
                if(isset($_POST['modify'])){
                    if(isset($_POST['useremail']) && isset($_POST['userOldpsw']) && isset($_POST['userNewpsw'])){
                        $sql = 'select * from users where Email="'.$_POST['useremail'].'";';
                        $result = mysqli_query($conn, $sql);
                        if(!$result){
                            die('Error: '.mysqli_error($conn));
                        }
                        $num = mysqli_num_rows($result);
                        if($num!=0){
                            
                            if($_POST['userOldpsw']!=$_POST['userNewpsw']){
                                $sql = 'update users set Email="'.$_POST['useremail'].'",Password="'.$_POST['userNewpsw'].'"
                                        where Username="'.$_SESSION['valid_user'].'";';
                                $result = mysqli_query($conn, $sql);
                                if(!$result){
                                    die('Error: '.mysqli_error($conn));
                                }
                                
                                echo '<p style="color: green">修改成功</p>';
                            }
                            else{
                                echo '<p style="color: red">修改失敗~</p>';
                            }
                        }
                        else{
                            echo '<p style="color: red">修改失敗!</p>';
                        }
                    }
                }
                ?>
                <input type="submit" value="修改" name="modify" id="modify" />
            </form>
        </main>
    </div>
</body>

</html>