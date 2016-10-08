<?php
namespace common;
class Config{
    private static $file=[];
    public static function get($params){
        echo $params;
        if(strpos($params, '.')===false){
            if(isset(self::$file[$params])){
                return self::$file[$params];
            }else{
                self::$file[$params]=include CONF_PATH.'/'.$params.'.php';
                return self::$file[$params];
            }
        }else{
            if(isset(self::$file[$arr[0]])){
                return self::$file[$arr[0]][$arr[1]];
            }else{
                self::$file[$arr[0]]=include CONF_PATH.'/'.$params.'php';
                return self::$file[$arr[0]][$arr[1]];
            }

        }
    }

}
// $a=Config::get('db.host');
// var_dump($a);
// $a=['db',['host',2]];
// $c=[$a[0]][$a[1]];
// var_dump($a);
// var_dump($c);
// echo 1;
// $str='db.host';
// $arr=explode('.',$str);
// if(($a[$arr[0]][$arr[1]])=='db'){
//     echo 1;
// }else{
//     echo 2;
// }
// var_dump($b);
// $arr=['db','host'];

// var_dump($arr);