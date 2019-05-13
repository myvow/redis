<?php
require 'connect.php';

$uid = $_GET['uid'];
$user_key = 'user:'.$uid;

//查询用户
$userInfo = $redis->hgetall($user_key);
if(empty($userInfo)){
	die('用户不存在');
}

//删除用户
$result = $redis->del($user_key);
if($result){
	$redis->decr('user_id');
	$redis->lrem('uids', $uid);
	
	header('location:list.php');
}else{
	die('删除用户失败...');	
}
?>
