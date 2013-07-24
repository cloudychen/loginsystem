<?php

require_once 'database.php';
$user_name = addslashes(strip_tags($_POST["username"]));
$result = $db->Query(" SELECT id FROM user WHERE username='$user_name'");
$nums = $db->Num_rows($result);
if ($nums == 0) {
    echo "can";
} else {
    echo "cannot";
}
?>
