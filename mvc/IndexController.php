<?php
namespace controller;
class IndexController extends \common\Controller{
    public function index(){
        require '../model/IndexModel.php';
        // $db1=new \model\IndexModel;
        // $db2=$db1->index();
        $db=new \PDO('mysql:host=localhost;dbname=blog','root','1122334');
        $db->exec("set names uft8");
        $p=isset($_GET['p'])?max((int)$_GET['p'],1):1;
        $mpage=5;
        $start=($p-1)*$mpage;
        $count=$db->query("select count(*) from article")->fetchall();
        $counts=ceil($count[0][0]/$mpage);
        // var_dump($counts);

        $sql="select*from article limit $start,$mpage";
        $data=$db->query($sql)->fetchall();
        // var_dump($data);
        $this->render('index',[
            'data'=>$data,
            'counts'=>$counts,
            'p'=>$p,
            ]);

    }
    public function cat_list(){

        $this->render('cat_list');

    }
    public function blog(){

        $this->render('blog');

    }
    public function reg(){

        $this->render('reg');
    }
    public function yuedu(){

        $this->render('yuedu');
    }
    public function login(){

        $this->render('login');
    }
}