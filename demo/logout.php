<?php
require 'connect.php';

setcookie('auth', '', time()-1);

header('location:login.php');
?>
