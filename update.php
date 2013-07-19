<?php

session_start();
require_once 'checkSession.php';
require_once 'database.php';
$user_name = strip_tags($_SESSION["user_name"]);
$result = $db->Query(' SELECT * FROM user WHERE username="' . $user_name . '"');
$info = $db->Fetch_array($result);

$nick_name = $_POST['nickname'];
$email = $_POST['email'];

if (is_null($_POST['olduserpwd'])) {
    $db->Query('update user set nickname ="' . $nick_name . '" where username="' . $user_name . '"');
    $db->Query('update user set email ="' . $email . '" where username="' . $user_name . '"');
    header("Location: /main.php");
    exit;
} else {
    if ($_POST['userpwd'] != $_POST['userpwd1']) {
        echo "<script type='text/javascript'>";
        echo "alert ('两次口令输入不一致！')";
        echo "</script>";
        echo "<meta http-equiv='refresh' content='0;url=/updateuserinfo.php'>";
    } else {
        if (md5(md5(strip_tags($_POST['olduserpwd'])) . $info['salt']) == $info['password']) {
            $db->Query('update user set nickname ="' . $nick_name . '" where username="' . $user_name . '"');
            $db->Query('update user set email ="' . $email . '" where username="' . $user_name . '"');
            $salt = md5(rand());
            $user_pass = md5(md5(strip_tags($_POST['userpwd'])) . $salt);
            $db->Query('update user set password ="' . $user_pass . '" where username="' . $user_name . '"');
            $db->Query('update user set salt ="' . $salt . '" where username="' . $user_name . '"');
            session_destroy();
            header("Location: /login.html");
            exit;
        } else {
            echo "<script type='text/javascript'>";
            echo "alert ('原口令不正确，请重新输入！')";
            echo "</script>";
            echo "<meta http-equiv='refresh' content='0;url=/updateuserinfo.php'>";
        }
    }
}
?>
