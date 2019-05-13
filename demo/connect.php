<?php
//实例化
$redis = new Redis();
//$var_dump($redis);

//连接
$rs = $redis->connect('127.0.0.1', 6379);
//var_dump($rs);

//授权
$redis->auth('redis!123456');
?>