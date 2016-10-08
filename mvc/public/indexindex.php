<?php
echo 1;
$params=substr($_SERVER['QUERY_STRING'],0,strrpos($_SERVER['QUERY_STRING'],'&'));
var_dump($params);
var_dump($_SERVER['QUERY_STRING']);

$a='123456&a$df78';
$b=strpos($a,'$');
var_dump($b);