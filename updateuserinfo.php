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
                        $("#checkPassword").css("color", "#00ff00");
                        $("#checkPassword").text("输入一致");
                    }
                    else {
                        $("#checkPassword").css("color", "#ff0000");
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
        <table  border="0">
            <tr>
                <td id="td1" colspan="2" >
                    <h1 align="center" >用户信息修改</h1>
                </td>
            </tr>
            <tr>
                <td>
                    <form  method="post" action="/update.php">
                        <table   align="center"> 
                            <tr id="tr1"> 
                                <td >账户:</td>
                                <td ><?php echo $info['username']; ?>
                                </td> 
                            </tr> 
                            <tr id="tr1"> 
                                <td >昵称:</td>
                                <td ><input size="22" type="text" name="nickname" value="<?php echo $info['nickname']; ?>">
                                </td> 
                            </tr>
                            <tr id="tr1"> 
                                <td >邮箱:</td>
                                <td ><input size="22" type="text" name="email" value="<?php echo $info['email']; ?>">
                                </td> 
                            </tr>
                            <tr id="tr1"> 
                                <td >原口令:</td>
                                <td > <input size="22" type="password" name="olduserpwd" id="olduserpwd" disabled>
                                </td>
                                <td>
                                    <span id="enableUpdatePassword">点击此处修改口令</span>
                                </td>
                            </tr>
                            <tr id="tr1"> 
                                <td >新口令:</td>
                                <td > <input size="22" type="password" name="userpwd" id="userpwd" disabled>
                                </td> 
                            </tr>
                            <tr id="tr1">
                                <td>确认口令：</td>	
                                <td><input size="22" type="password" name="userpwd1" id="userpwd1" disabled> </td>
                                <td>
                                    <span id="checkPassword"></span>
                                </td>
                            </tr> 
                            <tr id="tr1">
                                <td>                             
                                </td>
                                <td >
                                    <input type="submit" value="update">
                                    <input type="reset" value="reset">
                                </td> 
                            </tr> 
                        </table> 
                    </form> 
                </td>
            </tr>
        </table>
    </body>
</html>