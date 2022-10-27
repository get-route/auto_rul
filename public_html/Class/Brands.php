<?php


class Brands extends Core
{
    protected $url_brand;
    public $brand_content;
    public $brand_errors;
    protected $all_brands;
public function get_body()
{
    parent::get_body();
}
//Получаем урл для страницы бренда и вывода контента
public function url_brand(){
    $url_brand=$_SERVER['REQUEST_URI'];
    $url_brand=str_replace('/',"",$url_brand);
    return $url_brand;
}
//Получаем урлы всех брендов для SiteMap
public function get_all_brands(){
    $this->all_brands=$this->db->query("SELECT * FROM brands WHERE `public`='yes'");
    return $this->all_brands;
}
//Рандомный калькулятор для страницы авто модели
    public function get_all_brands_rand(){
        $this->all_brands=$this->db->query("SELECT `url_brands`,`brand_name`,`img_brands` FROM brands WHERE public ='yes' ORDER BY RAND() LIMIT 6");
        return $this->all_brands;
    }
//Выводим весь контент бренда для страницы
public function get_brand_content($urls){
    $this->brand_content=$this->db->prepare("SELECT * FROM `brands` WHERE `url_brands`=:url_brands");
    $this->brand_content->execute(array('url_brands'=>$urls));
    return $this->brand_content;
}
public function get_brand_errors($urls){
    $this->brand_errors=$this->db->prepare("SELECT `code_error`,`url_errors`,`categ_error` FROM `errors` WHERE `categ_error`=:url_brands");
    $this->brand_errors->execute(array('url_brands'=>$urls));
    return $this->brand_errors;
}
    //Получаем комментарии к конкретной ошибке
    public function get_brands_comment_read($urls){
        $this->komment_models_read=$this->db->prepare("SELECT `name`,`comment` FROM comments WHERE `url_comment`=:url_com AND `public_comment`='yes'");
        $this->komment_models_read->execute(array('url_com'=>$urls));
        return $this->komment_models_read;
    }
    //Отправка комментария в БД
    public function get_public_komment_brands($urls){
        $this->komment_public=$this->db->prepare("INSERT INTO comments (`name`,`email`,`comment`,`url_comment`,`public_comment`) VALUES (:name,:email,:comment,:url_comment,:public_comment)");
        $this->komment_public->execute(array(':name'=>$_POST['name'],':email'=>$_POST['email'],':comment'=>$_POST['message'],':url_comment'=>$urls,':public_comment'=>"no"));
        return $this->komment_public;
    }
}