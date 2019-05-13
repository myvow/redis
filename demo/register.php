<?php
require 'connect.php';
?>
<form action="add.php" method="post" enctype="multipart/form-data">
<table>
<tr>
    <td>用户名：</td><td><input type="text" name="username" /></td>
</tr>
<tr>
    <td>密 码：</td><td><input type="text" name="password" /></td>
</tr>
<tr>
    <td>年 龄：</td><td><input type="text" name="age" /></td>
</tr>
<tr>
    <td><input type="submit" name="注册" /></td><td><input type="reset" name="重置" /></td>
</tr>
</table>
</form>
