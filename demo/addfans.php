<?php
require 'connect.php';

if(empty($_COOKIE['auth'])){
	header('location:login.php');
}

$login_uid = $redis->get('auth:'.$_COOKIE['auth']);
if(empty($login_uid)){
	die('用户不存在');
}

$uesr_key = 'user:'.$login_uid;
$userInfo = $redis->hgetall($uesr_key);

//加关注的用户信息
$id = $_GET['id'];
if(empty($id)){
	die('无效的操作');
}

//添加关注
$redis->sadd('user:'.$login_uid.':following', $id);

$redis->sadd('user:'.$id.':follwer', $login_uid);

header('location:list.php');
?>
