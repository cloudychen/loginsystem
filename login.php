<?php

//header("Location: /login.html");
session_start();
require_once 'database.php';
if (!is_null($_POST['username']) && !is_null($_POST['userpwd'])) {
    $user_name = strip_tags($_POST['username']);
    $salt = $db->Query("SELECT salt FROM user WHERE username='$user_name'");
    $user_pass = md5(md5(strip_tags($_POST['userpwd']).$salt));
    // 在数据库中对输入的用户名和密码进行匹配，成功 $nums 不为0；否则 $nums 为0，登录失败
    $result = $db->Query("SELECT id FROM user WHERE username='$user_name' and password='$user_pass'");
    $nums = $db->Num_rows($result);

    if ($nums == 0) {
        echo "<script type='text/javascript'>";
        echo "alert ('输入的用户名或者密码错误！')";
        echo "</script>";
        echo "<meta http-equiv='refresh' content='0;url=/login.html'>";
    } else {
        $_SESSION['user_name'] = $user_name;
        header("Location: /main.php");
    }
}
?>
