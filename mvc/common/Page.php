<?php
namespace common;
class Page{
    private $_perPage;//每页显示的条数
    private $_count;//总记录数
    private $p;//当前页码
    private $_pages;//总页数
    public function __construct($perPage,$count){
        var_dump($count);
        $this->_perPage=$perPage;
        $this->_count=$count;
        $this->_pages=ceil($count/$perPage);
        $this->p=isset($_GET['p'])?min(max((int)$_GET['p'],1),$this->_pages):1;
    }
    //计算limit偏移量
    public function limit(){
        //计算偏移量
        $offset=($this->p-1)*$this->_perPage;

        return "$offset,$this->_perPage";//$offset,$perPage
    }
    public function PageHtml(){
$params=substr($_SERVER['QUERY_STRING'],0,strrpos($_SERVER['QUERY_STRING'],'&'));
// var_dump($params);

  $page="<div id='page'><a href='?".$params."'><p>首页</p></a>";

for($i=1;$i<=$this->_pages;$i++){
    if($this->p==$i) {
        $page .= '<p class="p_selected"><a href="?'.$params.'&p='.$i.'">'.$i.'</p></a>';
    }else{
        $page .= '<p><a href="?'.$params.'&p='.$i.'">'.$i.'</a></p>';
    }
}
if($this->p=$this->_pages) {
    $page .= "<p><a href='?".$params."&p=".$this->_pages."'>最后一页</p></a></div>";

}else{
    $page .= "<p><a href='$params'>下一页</p></a></div>";
}
        return $page;
    }
}
// $a=Page::limit();
// Page::$_count;