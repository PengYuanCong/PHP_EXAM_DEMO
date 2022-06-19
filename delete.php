<?php
    require("mysqli_connect.php");
    $email=@$_GET["Email"];
    $SQL="DELETE FROM users WHERE Email='$email'";
    

    if(mysqli_query($conn,$SQL)){
        echo "<script type='text/javascript'>";
        echo "alert('刪除ok');";
        echo "</script>";
        echo "<meta http-equiv='Refresh' content='0; url=admin_modify.php'>";
    }else{
        echo "<script type='text/javascript'>";
        echo "alert('刪除失敗');";
        echo "</script>";
        echo "<meta http-equiv='Refresh' content='0; url=admin_modify.php'>";
    }
?>