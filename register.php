<?php

session_start();
if (is_null($_POST['username']) || is_null($_POST['userpwd'])) {
    header("Location: /register.php");
    exit;
}
if(strlen($_POST['username']) < 1){
    echo "<script type='text/javascript'>";
    echo "alert ('用户名不能为空！')";
    echo "</script>";
    echo "<meta http-equiv='refresh' content='0;url=/register.html'>";
    exit;
}
    
if ($_POST['userpwd'] != $_POST['userpwd1']) {
    echo "<script type='text/javascript'>";
    echo "alert ('两次口令输入不一致！')";
    echo "</script>";
    echo "<meta http-equiv='refresh' content='0;url=/register.html'>";
} else {
    require_once 'database.php';
    $user_name = addslashes(strip_tags($_POST["username"]));
    $result = $db->Query(" SELECT id FROM user WHERE username='$user_name'");
    $nums = $db->Num_rows($result);
    if ($nums == 0) {
        $user_name = addslashes(strip_tags($_POST['username']));
        $salt = md5(rand());
        $user_pass = md5(md5(addslashes(strip_tags($_POST['userpwd']))) . $salt);
        $nick_name = addslashes(strip_tags($_POST['nickname']));
        $email = addslashes(strip_tags($_POST['email']));
        $db->Fn_Insert("user", "username, password, nickname,email, salt", "'$user_name','$user_pass','$nick_name','$email','$salt'");
        $_SESSION['user_name'] = $user_name;
        header("Location: /main.php");
    } else {
        echo "<script type='text/javascript'>";
        echo "alert ('该用户名已存在！')";
        echo "</script>";
        echo "<meta http-equiv='refresh' content='0;url=/register.html'>";
    }
}
?>
