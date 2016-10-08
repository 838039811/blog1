<?php
namespace controller;
use common\Controller;
use common\Validator;
use model\UserModels;
use Exception;
use common\Page;
use common\DB;
class LoginController extends Controller{
    //用户注册
    public function reg(){
        try {
            if($_SERVER['REQUEST_METHOD']=='POST'){
            Validator::Validate($_POST,[
            'username'=>'required',
            'password'=>'required|equalTo:repassword',
            ]);
            $data=DB::selectall("select user_name from user where user_name=?",[$_POST['username']]);
            var_dump($data);
                    if($data[0]['user_name']==$_POST['username']){
                $this->error('用户名已存在','?c=login&a=reg');
            }else{
            echo '<hr>';
            DB::insert('user',[
            'user_name'=>$_POST['username'],
            'password'=>$_POST['password'],
            ]);
            $this->success('注册成功','?c=login&a=login');
         }
        }

        } catch (Exception $e) {
            echo 'error:'.$e->getMessage();
        }

    $this->render('reg');
  }
  public function login(){
        try {
            if($_SERVER['REQUEST_METHOD']=='POST'){

                Validator::Validate($_POST,[
                    'username'=>'required',
                    'password'=>'required|equelTo:repassword',
                    ]);
             $user=DB::selectall("select*from user where user_name=?",[$_POST['username']]);
                var_dump($user);
                if($user[0]['password']==$_POST['password']){
                    $_SESSION['username']=$_POST['username'];
                    $this->success('登录成功','?c=index');
                }
            }
        } catch (Exception $e) {
            echo 'error:'.$e->getMessage();
        }

    $this->render('login');
  }
  public function logout(){
    $_SESSION=[];
    $this->success('退出成功','?c=index');
  }
}