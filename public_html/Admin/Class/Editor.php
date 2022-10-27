<?php


class Editor extends CoreA
{
    protected $img_post;
    protected $brand_content;
    protected $brand_update;
    protected $brand_category;
    //Получение списка фото для указанного урла каталога. Нужно для выбора картинки в админке.
    public function scandir_img($url){
        $this->img_post=scandir($url);
        return $this->img_post;
    }

    //Получаем список категорий для установки при редактировании и публикации модели
    public function brand_category_inmodels(){
        $this->brand_category=$this->db->query("SELECT url_brands,brand_name FROM brands");
        return $this->brand_category;
    }
    //Получаем записи страницы бренда по указанному ключу урлу. За него идет гет запрос по ссылке.
    public function get_brand_select($url){
        $this->brand_content=$this->db->prepare("SELECT * FROM brands WHERE url_brands=:url");
        $this->brand_content->execute(array('url'=>$url));
        return $this->brand_content;
    }
    //Обновляем полученную запись бренда, получая данные из формы в админке.
    public function get_brand_update ($title,$descriptions,$h1,$img_brands,$autor,$country,$history_brands,$error_brands,$video,$brand_name,$url){
        $this->brand_update=$this->db->prepare("UPDATE `brands` SET `title`=:title,`description`=:description,`h1`=:h1,`img_brands`=:img_brands,`autor`=:autor,`country`=:country,`history_brands`=:history_brands,`error_brands`=:error_brands,`video`=:video,`brand_name`=:brand_name WHERE `url_brands`=:url");
        $this->brand_update->execute(array('title'=>$title,'description'=>$descriptions,'h1'=>$h1,'img_brands'=>$img_brands,'autor'=>$autor,'country'=>$country,'history_brands'=>$history_brands,'error_brands'=>$error_brands,'video'=>$video,'brand_name'=>$brand_name,'url'=>$url));
    }

}

