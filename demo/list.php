<?php 
require 'connect.php';
$login_uid = '';

if(!empty($_COOKIE['auth'])){
	$auth = $_COOKIE['auth'];
	$login_uid = $redis->get('auth:'.$auth);
	
	$uesr_key = 'user:'.$login_uid;
	$username = $redis->hget($uesr_key, 'username');
?>
欢迎用户：<?php echo($username);?>(uid:<?php echo($login_uid);?>)&nbsp;&nbsp;<a href="logout.php">退出</a><br />
<?php }else{ ?>
<a href="login.php">登录</a>&nbsp;<a href="register.php">注册新用户</a><br />
<?php
}

//$userCount = $redis->lsize('uids');

/**
$dataList = array();
for($i=1; $i<=$userCount; $i++){
	$user_key = "user:".$i;
	$rs = $redis->hgetall($user_key);
	if(empty($rs)){
		continue;	
	}
	
	$dataList[] = $rs;
}
**/

//====分页演示

//总记录数
$count = $redis->lsize('uids');

//页大小
$page_size = 3;

//当前页面
if(empty($_GET['page'])){
	$page = 1;	
}else{
	$page = intval($_GET['page']);
}
$page = ($page ? $page : 1);

//分页数量
$page_count = ceil($count / $page_size);

//获取当前页面要显示的uid
$start_num = ($page - 1) * $page_size;
$end_num = ($page - 1) * $page_size + $page_size - 1;
$uids = $redis->lrange('uids', $start_num, $end_num);


$dataList = array();
foreach($uids as $key => $uid){
	$uesr_key = 'user:'.$uid;
	$dataList[] = $redis->hgetall($uesr_key);
}
?>
<table border="2" cellpadding="2">
	<tr>
    	<th>ID</th>
        <th>用户名</th>
        <th>密码</th>
        <th>年龄</th>
        <th>注册时间</th>
        <th>操作</th>
    </tr>
    <?php foreach($dataList as $key => $val){?>
    <tr>
    	<td><?php echo($val['uid']);?></td>
        <td><?php echo($val['username']);?></td>
        <td><?php echo($val['passwd']);?></td>
        <td><?php echo($val['age']);?></td>
        <td><?php echo($val['dateline']);?></td>
        <td>
        <a href="edit.php?id=<?php echo($val['uid']);?>">修改</a>&nbsp;&nbsp;<a href="del.php?uid=<?php echo($val['uid']);?>">删除</a>
        <?php if($login_uid != $val['uid']){ ?>
        &nbsp;&nbsp;<a href="addfans.php?id=<?php echo($val['uid']);?>">加关注</a>
        <?php }?>
        </td>
    </tr>
    <?php }?>
</table>
<a href="list.php">首页</a>&nbsp;<a href="list.php?page=<?php echo($page-1);?>">上一页</a>&nbsp;<a href="list.php?page=<?php echo($page+1);?>">下一页</a>&nbsp;<a href="list.php?page=<?php echo($page_count);?>">尾页</a>
&nbsp;总共多少<?php echo($count);?>个用户
<br /><br />
<?php

if($login_uid){
	$following = $redis->smembers('user:'.$login_uid.':following');
	
	$followList = array();
	foreach($following as $key => $val){
		$uesr_key = 'user:'.$val;
		$followList[] = $redis->hgetall($uesr_key);
	}
?>
我关注的人：
<table border="2" cellpadding="2">
	<tr>
    	<th>ID</th>
        <th>用户名</th>
    </tr>
    <?php foreach($followList as $key => $val){?>
    <tr>
    	<td><?php echo($val['uid']);?></td>
        <td><?php echo($val['username']);?></td>
    </tr>
    <?php }?>
</table>
<?php }?>

<br /><br />
<?php

if($login_uid){
	$follower = $redis->smembers('user:'.$login_uid.':follwer');
	
	$followMe = array();
	foreach($follower as $key => $val){
		$uesr_key = 'user:'.$val;
		$followMe[] = $redis->hgetall($uesr_key);
	}
?>
我的粉丝：
<table border="2" cellpadding="2">
	<tr>
    	<th>ID</th>
        <th>用户名</th>
    </tr>
    <?php foreach($followMe as $key => $val){?>
    <tr>
    	<td><?php echo($val['uid']);?></td>
        <td><?php echo($val['username']);?></td>
    </tr>
    <?php }?>
</table>
<?php }?>



