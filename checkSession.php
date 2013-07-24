<?php

session_start();
if (!is_null($_SESSION['user_name'])) {
    $user_name = addslashes(strip_tags($_SESSION['user_name']));
    require_once 'database.php';
    // 在数据库中查找session中的用户名，成功 $nums 不为0；否则 $nums 为0，登录失败
    $result = $db->Query("SELECT id FROM user WHERE username='$user_name'");
    $nums = $db->Num_rows($result);

    if ($nums == 0) {
        echo "<script type='text/javascript'>";
        echo "alert ('当前用户登录信息错误，请重新登录！')";
        echo "</script>";
        echo "<meta http-equiv='refresh' content='0;url=/login.html'>";
    }
} else if (is_null($_SESSION['user_name'])) {

    header("Location: /login.html");
    exit;
}
?>
