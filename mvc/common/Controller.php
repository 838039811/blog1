<?php
namespace common;
class Controller{
    public function render($tpl_name,$params=[]){
        extract($params);
        include (VIEW.'/'.CON.'/'.$tpl_name.'.html');
    }
    public function success($content,$url,$seconds=30){

        include VIEW.'/'.'message/success.html';
    }
    public function error($content,$url,$seconds=30){

        include VIEW.'/'.'message/error.html';
    }
}