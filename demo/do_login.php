<?php
require 'connect.php';

$user_name = $_POST['username'];
$password = $_POST['password'];

//获取用户名是否存在
$uid = $redis->get('username:'.md5($user_name));
if(empty($uid)){
	die('用户不存在...');	
}

//获取用户信息
$userInfo = $redis->hgetall('user:'.$uid);
//var_dump($userInfo);

if($userInfo['passwd'] != $password){
	die('用户密码不正确...');	
}

//记录登录的用户cookies
$auth = md5(time().$userInfo['username'].rand());
$redis->set('auth:'.$auth, $uid);

setcookie('auth', $auth, time()+86400);

header('location:list.php');
?>
