<?php
require 'connect.php';

$user_name = $_POST['username'];
$password = $_POST['password'];
$age = $_POST['age'];
$dateline = date('Y-m-d H:i', time());

//用户数量自增id
$user_id = $redis->incr("user_id");
$user_key = "user:".$user_id;

/**
//用户信息
$redis->hset($user_key, 'username', 'lijie');
$redis->hset($user_key, 'passwd', '123456');
$redis->hset($user_key, 'age', 18);
**/

//用户信息
$sdf = array('uid'=>$user_id, 'username'=>$user_name, 'passwd'=>$password, 'age'=>$age, 'dateline'=>$dateline);
$redis->hmset($user_key, $sdf);

//保存用户ID集合
$redis->rpush('uids', $user_id);

//存储用户名
$redis->set('username:'.md5($user_name), $user_id);

header("location:list.php");
?>
