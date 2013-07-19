<?php
session_start();
require_once 'checkSession.php';
require_once 'database.php';
$user_name = strip_tags($_SESSION["user_name"]);
$result = $db->Query(' SELECT * FROM user WHERE username="' . $user_name . '"');
$info = $db->Fetch_array($result);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>login system</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="/style.css" />
    </head>
    <body>
        <div id="header"><div class="top" id="mainnickname">昵称：<?php echo $info['nickname'] . " " ?>|</div><a class="top" id="mainupdateinfo" href="/updateuserinfo.php"> 修改个人信息 </a> <div class="top" id="mainheadercutoff">|</div> <a class="top" id="mainlogout" href="/logout.php"> 退出 </a><div class="top" id="right">&nbsp;&nbsp;&nbsp;</div></div>
        <div id="loginsuccse1">
            <div id="top2"></div>
            <div id="loginsuccse2">
            <h2>登陆成功！</h2>
            <span>:)</span>
            </div>
        </div>
    </body>
</html>
