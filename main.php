<?php
session_start();
require_once 'checkSession.php';
require_once 'database.php';
$user_name = strip_tags($_SESSION["user_name"]);
$result = $db->Query(" SELECT * FROM user WHERE username='$user_name'");
print_r($result);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>login system</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <div id="header">昵称：<?php echo $result['nickname']." " ?>|<a href="/updateuserinfo.php"> 修改个人信息 </a> | <a href="/logout.php"> 退出 </a></div>
        <div>
            <h2>登陆成功！</h2>
            <h1>:)</h1>
        </div>
    </body>
</html>
