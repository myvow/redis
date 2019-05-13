<?php
require 'connect.php';
?>
<form action="do_login.php" method="post" enctype="multipart/form-data">
<table>
<tr>
    <td>用户名：</td><td><input type="text" name="username" /></td>
</tr>
<tr>
    <td>密 码：</td><td><input type="text" name="password" /></td>
</tr>
<tr>
    <td><input type="submit" name="登录" /></td><td>&nbsp;</td>
</tr>
</table>
</form>
