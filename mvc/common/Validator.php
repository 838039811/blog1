<?php
namespace common;
use Exception;
class Validator{
    private static $rule=[
    'required'=>'/^.+$/',
    'number'=>'/^\d+$/',
    'tel'=>'/^1[3578]\d{9}$/',
    'emali'=>'/^(\w+)@(\w+[.])[a-zA-Z]{2,6}$/',
    ];
    public static function Validate($data,$_rule){
        foreach($_rule as $k=>$v){
            $d=@$data[$k];
            $arr=explode('|',$v);
            foreach($arr as $k1=>$v1){
                if($v1=='required'){
                    if(!preg_match(self::$rule['required'],$d)){
                        throw new Exception($k.'不能为空');
                    }
                }elseif($v1=='number'){
                    if(!preg_match(self::$rule['number'],$d)){
                        throw new Exception($k.'必须为数字');
                    }
                }elseif($v1=='tel'){
                    if(!preg_match(self::$rule['tel'],$d)){
                        throw new Exception($k.'手机号格式不正确');
                    }
                }elseif($v1=='eamli'){
                    if(!perg_match(self::$rule['eamli'],$d)){
                        throw new Exception($k.'邮箱格式不正确');
                    }
                }elseif(substr($v1,0,6)=='length'){
                    $st=substr($v1,7);
                    $st=explode('-',$st);
                    $len=length($d);
                    if($len<$st[0] || $len>$st[1]){
                        throw new Execption($k.'长度必须在4-16位');
                    }
                }elseif(substr($v1,0,7)=='equalTo'){
                    $st=substr($v1,8);
                    $st=$data[$st];
                    if($d!==$st){
                        throw new Exception('密码不一致');
                    }
                }
            }
        }


    }
}
// Validator::Validate();