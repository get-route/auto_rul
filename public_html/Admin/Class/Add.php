<?php


class Add extends CoreA
{
    protected $add_brands;
    //Добавляем новый бренд в БД
    public function get_add_brand_bd($title, $descriptions, $h1, $img_brands, $autor, $country, $history_brands, $error_brands, $video, $brand_name, $url)
    {
        $this->add_brands = $this->db->prepare("INSERT INTO `brands` SET `title`=:title,`description`=:description,`h1`=:h1,`img_brands`=:img_brands,`autor`=:autor,`country`=:country,`history_brands`=:history_brands,`error_brands`=:error_brands,`video`=:video,`brand_name`=:brand_name,`url_brands`=:url");
        $this->add_brands->execute(array('title' => $title, 'description' => $descriptions, 'h1' => $h1, 'img_brands' => $img_brands, 'autor' => $autor,  'country' => $country, 'history_brands' => $history_brands, 'error_brands' => $error_brands, 'video' => $video, 'brand_name' => $brand_name, 'url' => $url));
    }



}