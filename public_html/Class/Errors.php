<?php
require_once "Admin/Config/config.php";


class Errors extends Core
{
    public $content_error;
    protected $all_errors;
    //Получаем все УРЛЫ ошибок для SiteMap
    public function get_all_errors($url){
        $this->all_errors=$this->db->prepare("SELECT * FROM errors WHERE `categ_error`=:url");
        $this->all_errors->execute(array('url'=>$url));
        return $this->all_errors;
    }
public function get_body()
{
    parent::get_body();
}
    public function url_errors(){
        $url_brand=$_SERVER['REQUEST_URI'];
        $url_brand=explode("/",$url_brand);
        return $url_brand;
    }
    //Получаем рандомную ошибку для контента
    public function kontent_errors_rand($url_brand){
        $this->content_error=$this->db->prepare("SELECT `categ_error`,`url_errors`,`code_error` FROM errors WHERE categ_error=:categ_error ORDER  BY  RAND() LIMIT 24");
        $this->content_error->execute(array('categ_error'=>$url_brand));
        return $this->content_error;
    }
    //Получаем контент для ошибки
    public function kontent_errors($url_brand,$url_error){
    $this->content_error=$this->db->prepare("SELECT * FROM errors WHERE categ_error=:categ_error AND url_errors=:url_errors");
    $this->content_error->execute(array('categ_error'=>$url_brand,'url_errors'=>$url_error));
    return $this->content_error;
    }
    //Получаем комментарии к конкретной ошибке
    public function get_errors_comment_read($urls){
        $this->komment_models_read=$this->db->prepare("SELECT `name`,`comment` FROM comments WHERE `url_comment`=:url_com AND `public_comment`='yes'");
        $this->komment_models_read->execute(array('url_com'=>$urls));
        return $this->komment_models_read;
    }
    //Отправка комментария в БД
    public function get_public_komment_errors($urls){
        $this->komment_public=$this->db->prepare("INSERT INTO comments (`name`,`email`,`comment`,`url_comment`,`public_comment`) VALUES (:name,:email,:comment,:url_comment,:public_comment)");
        $this->komment_public->execute(array(':name'=>$_POST['name'],':email'=>$_POST['email'],':comment'=>$_POST['message'],':url_comment'=>$urls,':public_comment'=>"no"));
        return $this->komment_public;
    }

}