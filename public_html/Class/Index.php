<?php

class Index extends Core
{
    public $index_brand;
public function get_body()
{
    parent::get_body();
}
public function get_brand_index(){
    $this->index_brand=$this->db->query("SELECT img_brands,url_brands,brand_name FROM brands WHERE `public` ='yes' ORDER BY brand_name LIMIT 30 ");
    return $this->index_brand;
}
}