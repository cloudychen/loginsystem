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
        <script type="text/javascript" src="jquery2.0.3.js"></script>
        <script >
            $(document).ready(function() {
                $("#userpwd1").keyup(function() {
                    if ($("#userpwd").val() == $("#userpwd1").val()) {
                        $("#checkPassword").css("color", "#6b947d");
                        $("#checkPassword").text("输入一致");
                    }
                    else {
                        $("#checkPassword").css("color", "#b34c51");
                        $("#checkPassword").text("输入不一致");
                    }
                });
            });

            $(document).ready(function() {
                $("#enableUpdatePassword").click(function() {
                    $("#olduserpwd").removeAttr("disabled");
                    $("#userpwd").removeAttr("disabled");
                    $("#userpwd1").removeAttr("disabled");
                    $("#enableUpdatePassword").remove();
                });
            });
        </script>
    </head>
    <body>
        <div id="header"><div class="top" id="mainnickname">昵称：<?php echo $info['nickname'] . " " ?>|</div><a class="top" id="mainupdateinfo" href="/updateuserinfo.php"> 修改个人信息 </a> <div class="top" id="mainheadercutoff">|</div> <a class="top" id="mainlogout" href="/logout.php"> 退出 </a><div class="top" id="right">&nbsp;&nbsp;&nbsp;</div></div>
        <div id="register1">
            <div id="top2"></div>
            <div id="register2">
        <table  border="0">
            
            <tr>
                <td>
                    <form  method="post" action="/update.php">
                        <table   align="center">
                            <tr id="tr1"><td class="td1"></td><td><h1 id="title" align="center" >用户信息修改</h1></td></tr>
                            <tr id="tr1"> 
                                <td class="td1">账户：</td>
                                <td class="td2"><div class="inputbox"><?php echo $info['username']; ?></div>
                                </td> 
                            </tr> 
                            <tr id="tr1"> 
                                <td class="td1">昵称：</td>
                                <td class="td2"><input class="inputbox" type="text" name="nickname" value="<?php echo $info['nickname']; ?>" autocomplete="off">
                                </td> 
                            </tr>
                            <tr id="tr1"> 
                                <td class="td1">邮箱：</td>
                                <td class="td2"><input class="inputbox" type="text" name="email" value="<?php echo $info['email']; ?>" autocomplete="off">
                                </td> 
                            </tr>
                            <tr id="tr1"> 
                                <td class="td1">原口令：</td>
                                <td class="td2"> <input class="inputbox" type="password" name="olduserpwd" id="olduserpwd" disabled autocomplete="off">
                                </td>
                                <td>
                                    <span id="enableUpdatePassword">点击此处修改口令</span>
                                </td>
                            </tr>
                            <tr id="tr1"> 
                                <td class="td1">新口令：</td>
                                <td class="td2"> <input class="inputbox" type="password" name="userpwd" id="userpwd" disabled autocomplete="off">
                                </td> 
                            </tr>
                            <tr id="tr1">
                                <td class="td1">确认口令：</td>	
                                <td class="td2"><input class="inputbox" type="password" name="userpwd1" id="userpwd1" disabled autocomplete="off"> </td>
                                <td>
                                    <span id="checkPassword"></span>
                                </td>
                            </tr> 
                            <tr id="tr1">
                                <td class="td1">                             
                                </td>
                                <td class="td2">
                                    <input class="button" type="submit" value="update">
                                    <input class="button" type="reset" value="reset">
                                </td> 
                            </tr> 
                        </table> 
                    </form> 
                </td>
            </tr>
        </table>
                </div><div id="top2"></div></div>
    </body>
</html>