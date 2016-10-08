<?php
namespace controller;
use common\Page;
class IndexController extends \common\Controller{
    public function index(){
        // require '../model/IndexModel.php';
        // $db1=new \model\IndexModel;
        // $db2=$db1->index();
        // $db=new \PDO('mysql:host=localhost;dbname=blog','root','1122334');
        // $db->exec("set names uft8");
        // $p=isset($_GET['p'])?min(max((int)$_GET['p'],1),$counts):1;
        // $mpage=5;
        // $start=($p-1)*$mpage;
        $count=\common\DB::select("select count(*) from article");
         //$count=\common\DB::select("select count(*) from a");
         //var_dump($count[0]);exit;
        // $counts=ceil($count[0][0]/$mpage);

        $page=new Page(2,$count[0]);
        // var_dump($counts);
        $limit=$page->limit();
        $PageHtml=$page->PageHtml();
        // $sql="select*from ar[0]ticle limit $start,$mpage";
        // $data=$db->query($sql)->fetchall();
        // var_dump($data);
        $data=\common\DB::selectall("select *from article limit $limit");
        $this->render('index',[
            // 'data'=>$data,
            // 'counts'=>$counts,
            // 'p'=>$p,
            'data'=>$data,
            'PageHtml'=>$PageHtml,
            ]);


    }
    //查看分类
    public function cat_list(){
        $data=\common\DB::selectall("select *from cat");

        $this->render('cat_list',[
            'data'=>$data,
            ]);

    }
    //添加分类
    public function cat_add(){
        try {
             if($_SERVER['REQUEST_METHOD']=="POST"){
                var_dump(111);

                \common\Validator::Validate($_POST,[
                    'cat_name'=>'required',
                    ]);
                var_dump(222);exit;
            //     \common\DB::insert('cat',[
            //         'cat_name'=>$_POST['cat_name'],
            //         ]);

            //     $this->success('添加成功','?c=index&a=cat_list',10);
            //     die;
             }

        } catch (\Exception $e) {
            echo 'erroe:'.$e->getMessage();
        }
        $this->render('cat_add');
    }
    //删除分类
    public function delete(){
        \common\DB::delete("delete from cat where id=?",[$_GET['id']]);
        echo '<h1>删除成功</h1>';
        echo '<div id="in">6</div>秒后返回';
        echo '<a href="index.php?a=cat_list">立即返回</a>';
        echo '<script>
        var i=document.getElementById("in");
        var v=i.innerHTML;
        setInterval(function(){
            v--;
            if(v<=0){
                 location.href="index.php?a=cat_list";
             }else{
                i.innerHTML=v;
             }

        },1000);
       </script>';
        // $this->render('cat_list');


    }
    //修改分类
    public function cat_xiu(){
        $data=\common\DB::selectall("select * from cat where id=?",[$_GET['id']]);
        // var_dump($data);
        $this->render('cat_xiu',[
            'data'=>$data[0],
            ]);
        try {
            if($_SERVER['REQUEST_METHOD']=='POST'){
                \common\Validator::Validate($_POST,[
                    'cat_name'=>'required',
                    ]);
                \common\DB::update('cat',[
                    'cat_name'=>$_POST['cat_name'],
                    // 'addtime'=>$_POST['addtime'],
                    ],'id=?',[$_GET['id']]);
               echo '修改成功';
               // echo  '<script>location.href="index.php?a=cat_list"</script>';
            }


        }
        catch (\Exception $e) {
            echo 'error:'.$e->getMessage();
        }
    }
    //添加文章
    public function blog(){
        $data=\common\DB::selectall("select *from cat ");
// var_dump($data);
        $this->render('blog',[
            'data'=>$data
            ]);
        try {
            if($_SERVER['REQUEST_METHOD']=='POST'){
            \common\Validator::Validate($_POST,[
            'title'=>'required',
            'content'=>'required',
            'author'=>'required',
            ]);
        \common\DB::insert('article',[
            'title'=>$_POST['title'],
            'content'=>$_POST['content'],
            'author'=>$_POST['author'],
            ]);
            echo '添加成功';
            echo  '<script>location.href="index.php"</script>';
    }

        }
        catch (\Exception $e) {
            echo 'error:'.$e->getMessage();
        }

    }
    //修改文章
    public function edit_blog(){
        $data=\common\DB::selectall("select * from cat");
        // var_dump($data);
        $data_blog=\common\DB::selectall("select *from article where id=?",[$_GET['id']]);
        // var_dump($data_blog);
        // $a=[[12],1,[2],2,3,4];
        // var_dump($a);

        $this->render('edit_blog',[
            'data'=>$data,
            'data_blog'=>$data_blog,
            ]);

        try {
            if($_SERVER['REQUEST_METHOD']=='POST'){
            \common\Validator::Validate($_POST,[
                'title'=>'required',
                'content'=>'required',
                'author'=>'required',
                ]);
             \common\DB::update('article',[
                'cat_id'=>$_POST['cat_id'],
                'title'=>$_POST['title'],
                'author'=>$_POST['author'],
                'content'=>$_POST['content'],
                ],'id=?',[$_GET['id']]);
            echo '修改成功';
            }
        }
        catch (\Exception $e) {
            echo 'error:'.$e->getMessage();
            // echo '失败';
        }
    }
    //删除文章
    public function delete_blog(){
       \common\DB::delete("delete from article where id=?",[$_GET['id']]);
        echo '<h1>删除成功</h1>';
        echo '<div id="in">6</div>秒后返回';
        echo '<a href="index.php">立即返回</a>';
        echo '<script>
        var i=document.getElementById("in");
        var v=i.innerHTML;
        setInterval(function(){
            v--;
            if(v<=0){
                 location.href="index.php";
             }else{
                i.innerHTML=v;
             }

        },1000);
       </script>';
        // $this->render('cat_list');


    }
    //注册页面
    // public function reg(){
    //     if($_SERVER['REQUEST_METHOD']=='POST'){
    //         try {
    //              \common\Validator::validate($_POST,[
    //             'username'=>'required',
    //             'password'=>'required|equalTo:repassword',
    //         ]);
    //              \common\DB::insert('user',[
    //                 'user_name'=>$_POST['username'],
    //                 'password'=>$_POST['password'],
    //                 ]);
    //              $this->success('注册成功','?');
    //         }
    //         catch (\Exception $e) {
    //             echo 'error:'.$e->getMessage();
    //         }

    //     }
    //     $this->render('reg');


    // }
    //查看文章
    public function yuedu(){
        // $id=$_GET['id'];
        $data=\common\DB::select("select *from article where id=?",[$_GET['id']]);
        // var_dump($data);
        $this->render('yuedu',[
            'data'=>$data,
            ]);
    }
    // public function login(){

    //     try {
    //         if($_SERVER['REQUEST_METHOD']=='POST'){


    //          $user=\common\DB::selectall("select*from user where user_name=?",[$_POST['username']]);
    //             var_dump($user);
    //             if($user[0]['password']==$_POST['password']){
    //                 // $_SERVER['id']=$_POST['id'];
    //                 $_SESSION['username']=$_POST['username'];
    //                 $this->success('登录成功','?');
    //             }
    //         }
    //     } catch (Exception $e) {
    //         echo 'error:'.$e->getMessage();
    //     }

    //     $this->render('login');
    // }
    // public function logout(){
    //     $_SESSION=[];
    //     $this->success('退出成功','?a=index',10);
    // }
}