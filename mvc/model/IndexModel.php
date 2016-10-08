<?php
namespace model;
class IndexModel{
    public function index(){
    try {
        $db=new \PDO('mysql:host=localhost;dbname=blog','root','1122334');
        if($db->exec("set names utf8")===false){
            throw new Excrption('设置字符集失败');
        }
        // $sql=("select*from article");
        // $data=$db->query($sql)->fetchall();
        // var_dump($data);



    }
     catch (Exception $e) {
        echo 'error:'.$e->getMessage();
    }
  }

}
$a=new IndexModel;
$a->index();
