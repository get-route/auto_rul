<?php


class CoreModel extends Core
{




//Формируем урл для модели на отправку в роут

//Все бренды
public function all_brand($model){
    $brands_auto = $this->db->prepare ("SELECT * FROM car_mark WHERE id_car_mark=:id_brand");
    $brands_auto->execute(array('id_brand'=>$model));
    return $brands_auto;
}
//Все модели. Этот метод еще берем для формирования сайтмапа.
public function all_models(){
    $models_auto = $this->db->query("SELECT * FROM car_model");
    return $models_auto;
}
//Количество моделей
public function count_models(){
       $count_models=$this->all_models()->rowCount();
       return $count_models;
    }
//Транслит
public function translit($keys){
        $translit = strtr("$keys",array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '',  'ы' => 'y',   'ъ' => '',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '',  'Ы' => 'Y',   'Ъ' => '',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
            ' '=>'-','"'=>'','«'=>'','»'=>'','('=>'',')'=>'',
    ));
        return $translit;
}


//Урлы модели
    public function url_models($urls){
        $url_brand=$_SERVER['REQUEST_URI'];
        $url_brand=explode("/",$url_brand);
        return $url_brand[$urls];
    }
//получаем модель по урлу из брендов
public function models_url($url){
    $models_auto = $this->db->prepare ("SELECT * FROM car_model WHERE brand_url=:brand_url");
    $models_auto->execute(array('brand_url'=>$url));
    return $models_auto;
}
//Формируем поколение заданной модели
public function serie_auto($id_car){
    $serie_auto = $this->db->prepare ("SELECT * FROM car_serie WHERE id_car_model=:id_car_model");
    $serie_auto->execute(array('id_car_model'=>$id_car));
    return $serie_auto;
}
//Формируем модификацию
public function modifications_auto($id_car_model){
    $modification_auto = $this->db->prepare ("SELECT * FROM car_modification WHERE id_car_model=:id_car_model");
    $modification_auto->execute(array('id_car_model'=>$id_car_model));
    return $modification_auto;
}
//Формируем Поколение
public function generation_auto($id_car_gener){
    $generation_auto = $this->db->prepare ("SELECT * FROM car_generation WHERE id_car_model=:id_car_model");
    $generation_auto->execute(array('id_car_model'=>$id_car_gener));
    return $generation_auto;
}
    //Формируем характеристики
    public function characteristic_value_auto($id_car_modif){
        $characteristic_auto = $this->db->prepare ("SELECT * FROM car_characteristic_value WHERE id_car_modification=:id_car_modification");
        $characteristic_auto->execute(array('id_car_modification'=>$id_car_modif));
        return $characteristic_auto;
    }
    //Формируем значение для характеристик
    public function characteristic_auto_all(){
        $characteristic_id = $this->db->query("SELECT * FROM car_characteristic ");
        return $characteristic_id;
    }
    //Формируем значение для характеристик
    public function characteristic_auto($id_car_characteristic){
        $characteristic_id = $this->db->prepare ("SELECT * FROM car_characteristic WHERE id_car_characteristic=:id_car_characteristic");
        $characteristic_id->execute(array('id_car_characteristic'=>$id_car_characteristic));
        return $characteristic_id;
    }


    public function add($brand_name,$brand_url,$id,$id_car,$namez){
        $brand_inf =$this->db->prepare("UPDATE `car_model` SET `brand_name`=:brand_name, `brand_url`=:brand_url,`id_car_mark`=:id_car,`name`=:namez WHERE id_car_model=:id" );
        $brand_inf->execute (array('brand_name'=>$brand_name,'brand_url'=>$brand_url,'id'=>$id,'id_car'=>$id_car,'namez'=>$namez));
    }
}