<?php


class config extends Core
{
//Функция роутинга. Берем все записи в массив и подбираем шаблон в зависимости от ключа массива.
    public function get_routes()
    {
        $brands="SELECT url_brands FROM brands";
        $brand=$this->db->query($brands);
        foreach ($brand as $brands){
            $brand_arr[]=$brands[0];
        }
        return $brand_arr;
    }
    public function get_errors(){
        $errors="SELECT url_errors FROM errors";
        $error=$this->db->query($errors);
        foreach ($error as $errors){
            $error_arr[]=$errors[0];
        }
        return $error_arr;
    }

}