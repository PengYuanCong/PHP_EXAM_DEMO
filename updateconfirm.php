<?php
require("mysqli_connect.php");

$email=$_POST["Email"];
$userpassword=$_POST["Password"];

$SQL="SELECT * FROM users";

if($result=mysqli_query($conn,$SQL)){
    while($row=mysqli_fetch_assoc($result)){
        $email=$row['Email'];
        $userpassword=$row['Password'];
    }
}

$SQL="UPDATE users SET password='$userpassword'";

if(mysqli_query($conn, $SQL)){
    echo "<script type='text/javascript'>";
    echo "alert('會員資料更新成功')";
    echo "</script>";
    echo "<meta http-equiv='Refresh' content='0; url=admin_modify.php'>";
}else{
    echo "<script type='text/javascript'>";
    echo "alert('會員資料更新失敗')";
    echo "</script>";
    echo "<meta http-equiv='Refresh' content='0; url=admin_modify.php'>";
}


?>