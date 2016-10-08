<?php
session_start();
// var_dump($_SESSION['username']);
$c=isset($_GET['c'])?$_GET['c']:'index';
$a=isset($_GET['a'])?$_GET['a']:'index';
define('VIEW','../view');
define('CON',$c);
define('CONF_PATH','../conf');
// $controller=ucfirst($c).'controller';
// include '../controller/IndexController.php';
$cr=explode('_',$c);
$cr=array_map('ucfirst', $cr);
$cr=implode('',$cr);
$controller=$cr.'Controller';
$con='controller\\'.$controller;
// $con=new controller\IndexController;
$cn=new $con;
$cn->$a();

function __autoload($class_name){
    include '../'.str_replace('\\','/',$class_name).'.php';

}