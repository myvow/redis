<?php
require 'connect.php';

$uid = $_GET['uid'];

$user_key = 'user:'.$uid;
$userInfo = $redis->hgetall($user_key);
?>
<form action="do_edit.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="uid" value="<?php echo($userInfo['uid']);?>" />
<table>
<tr>
    <td>用户名：</td><td><input type="text" name="username" value="<?php echo($userInfo['username']);?>" /></td>
</tr>
<tr>
    <td>密 码：</td><td><input type="text" name="password" value="<?php echo($userInfo['passwd']);?>" /></td>
</tr>
<tr>
    <td>年 龄：</td><td><input type="text" name="age" value="<?php echo($userInfo['age']);?>" /></td>
</tr>
<tr>
    <td><input type="submit" name="修改" /></td><td><input type="reset" name="重置" /></td>
</tr>
</table>
</form>
