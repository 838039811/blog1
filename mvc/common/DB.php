<?php
namespace common;

use Exception;
class DB{
    private $pdo=null;
    private static $db;

    private function __construct(){
        $db=\common\Config::get('db');
        if($this->pdo==null){
        $this->pdo=new \PDO('mysql:host='.$db['host'].';dbname='.$db['dbname'].'','root','1122334');
        if($this->pdo->exec("set names utf8")===false){
            throw new Exception('设置字符集失败');
        }

        var_dump($this->pdo);
      }
    }

    public static function get(){
        if(!isset(self::$db)){
            self::$db=new self;
        }
        return self::$db;
    }
    private function __clone(){

    }
    public static function __callStatic($method,$params){
        $db=DB::get();
        $method='_'.$method;
        if(method_exists($db,$method)){
            return $db->$method($params);
        }
    }
    private function _selectall($params){
        $sql=$params[0];
        $data=isset($params[1])?$params[1]:[];
        $j=$this->pdo->prepare($sql);
        $j->execute($data);
        return $j->fetchall();
        // var_dump($params);

    }
    private function _select($params){
    $sql=$params[0];
    $data=isset($params[1])?$params[1]:[];
    $j=$this->pdo->prepare($sql);
    $j->execute($data);
    return $j->fetch();
    }
    private function _insert($params){
        var_dump($params);
        $catname=$params[0];
        $data=$params[1];
        $date=array_values($data);
        // $date=implode($date);
        $key=array_keys($data);
        $keys=implode(',',$key);
        var_dump($keys);
        $len=count($key);
        $value=array_fill(0,$len,'?');
        $values=implode(',',$value);
        echo '<hr>';
        // var_dump($values);
        // var_dump($value);
        // var_dump($len);
        // var_dump($values);
        var_dump($data);
// $a=$this->pdo->exec("update cat set cat_name='aaaa' where id=65");
// var_dump($a);
        $j=$this->pdo->prepare("insert into $params[0]($keys) value($values)");
        // return $j->execute($date);
        var_dump($j);
        if($j->execute($date)===false){
            throw new \Exception('插入数据库失败');
        }

    }
    private function _delete($params){
        // var_dump($params);
        $j=$this->pdo->prepare($params[0]);
        $j->execute($params[1]);

    }
    public function _update($params){
        var_dump($params);
        // $value=[];
        // $sql="update cat set cat_name=? where id=?";
        $sql="update $params[0] set ";

        foreach($params[1] as $k=>$v){
          $sql.="$k=?,";
          $value[]=$v;
        }
         $sql=rtrim($sql,',')."where $params[2]";
         $values=array_merge($value,$params[3]);
         // var_dump($values);
         $j=$this->pdo->prepare($sql);
         // var_dump($j);
         return $j->execute($values);



    }

}
// $a=DB::get();
// var_dump($a);
