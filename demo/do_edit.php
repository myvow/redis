<?php
require 'connect.php';

$user_name = $_POST['username'];
$password = $_POST['password'];
$age = $_POST['age'];
$dateline = date('Y-m-d H:i', time());

$uid = $_POST['uid'];
$user_key = 'user:'.$uid;

//查询用户
$userInfo = $redis->hgetall($user_key);
if(empty($userInfo)){
	die('用户不存在');
}

//修改用户信息
$sdf = array('username'=>$user_name, 'passwd'=>$password, 'age'=>$age, 'dateline'=>$dateline);
$result = $redis->hmset($user_key, $sdf);
if($result){
	header("location:list.php");
}else{
	die('编辑失败...');
}
?>
