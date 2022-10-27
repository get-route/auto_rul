<?php
require_once "Admin/Config/config.php";

class Calculate extends Core
{
    public $usd;
    public $eur;
    public $blr;
    public $ukr;
    public $tenge;



//Формируем массивы для внесения.
    ////Ставка таможенного сбора
    private $custom_nds = [
        775 => [0, 200000],
        1550 => [200001, 450000],
        3100 => [450001, 1200000],
        8530 => [1200001, 2700000],
        12000 => [2700001, 4200000],
        15500 => [4200001, 5500000],
        20000 => [5500001, 7000000],
        23000 => [7000001, 8000000],
        25000 => [8000001, 9000000],
        27000 => [9000001, 10000000],
        30000 => [10000001, 900000000],
    ];
//Таблица с утил значениями для легковых авто (Возраст=>коэффициент)
    private $util_sbor_leght = [0.17, 0.26];
//Таблица с утил значениями для грузовых авто (До 3х лет /Старше 3х лет)
    private $util_sbor_cargo_min =
        [[1000 => 2.41], [2000 => 8.92], [3000 => 14.08], [3500 => 12.98], [3501 => 22.25], ['electro_car' => 1.63],];
    private $util_sbor_cargo_max = [[1000 => 6.15], [2000 => 15.69], [3000 => 24.01], [3500 => 28.5], [3501 => 35.01], ['electro_car' => 6.1],];
//Таблица по акцизному сбору
    private $akciz_sbor = [
        0 => [0, 90],
        51 => [91, 150],
        491 => [151, 200],
        804 => [201, 300],
        1370 => [301, 400],
        1418 => [401, 500],
        1464 => [501, 100000],
    ];
//Тамож ставка для физ лиц----------------
//Тамож ставка для физлиц на авто менее 3х лет
    private $customs_duty_leight_3years = [
        [0,8500,'2.5','0.54'],
        [8501,16700,'3.5','0.48'],
         [16701,42300,'5.5','0.48'],
         [42301,84500,'7.5','0.48'],
        [84501,169000,'15','0.48'],
        [169001,1000000000,'20','0.48']];
//Тамож ставка для физлиц на авто старше 3-5х лет
    private $customs_duty_leight_3to5years = [
        [0, 1000,'1.5'],
        [1001, 1500,'1.7'],
        [1501, 1800,'2.5'],
        [1801, 2300,'2.7'],
        [2301, 3000,'3'],
        [3001, 100000,'3.6'],
    ];
//Тамож ставка для физлиц на авто старше 5 лет
    private $customs_duty_leight_many5years = [
        [0, 1000,'3'],
        [1001, 1500,'3.2'],
        [1501, 1800,'3.5'],
        [1801, 2300,'4.8'],
        [2301, 3000,'5'],
        [3001, 100000,'5.7'],
    ];
//Тамож ставка для юр лиц -------------------
//Тамож ставка для юрлиц с бенз двиг до 3х лет
    private $customs_duty_entities3years = [
        [0, 1000,'0.15'],
        [1001, 1500,'0.15'],
        [1501, 1800,'0.15'],
        [1801, 2300,'0.15'],
        [2301, 3000,'0.15'],
        [3001, 100000,'0.125']
    ];
//Тамож ставка для юрлиц с бенз двиг до 5 лет и с 5-7 лет. Данные одинаковы
    private $customs_duty_entities3to5years = [
        [0, 1000,'0.36','0.20'],
        [1001, 1500,'0.4','0.20'],
        [1501, 1800,'0.36','0.20'],
        [1801, 2300,'0.44','0.20'],
        [2301, 3000,'0.44','0.20'],
        [3001, 1000000,'0.8','0.20']];
//Тамож ставка для юрлиц с бенз двиг от 7 лет
    private $customs_duty_entities7years = [
         [0, 1000,'1.4'],
         [1001, 1500,'1.5'],
         [1501, 1800,'1.6'],
         [1801, 2300,'2.2'],
         [2301, 3000,'2.20'],
         [3001, 100000,'3.2'],
    ];
//----Там ставка для юрлиц дизельн двиг
// Там ставка для юр лиц с диз двиг до 3х лет
    private $customs_duty_entities_dizel3years = [
        [0, 1500,'0.15'],
        [1501, 2501,'0.15'],
        [2501, 100000,'0.15']
    ];
// Там ставка для юр лиц с диз двиг до 5 лет и с 5-7 лет
    private $customs_duty_entities_dizel3to7years = [
        [0, 1500,'0.32','0.20'],
        [1501, 2500,'0.4','0.20'],
        [2501, 1000000,'0.8','0.20']];
// Там ставка для юр лиц с диз двиг больше 7 лет
    private $customs_duty_entities_dizel_many7years = [
        [0, 1500,'1.5'],
        [1501, 2500,'2.2'],
        [2501, 1000000,'3.2']];

    //Вывод калькулятора. Гл. Метод---------------------
    public function get_calculate (){
      return $this->utilizations_in() + $this->nds_customs()+ $this->akciz()+ $this->nds()+ $this->customs_nds();
    }

    //Получаем ставку таможенных сборов
    public function nds_customs(){
        $prise_avto = $this->convert_in_rub();
        foreach ($this->custom_nds as $custom_prise=>$custom_nds){
            if (($prise_avto>$custom_nds[0])&&($prise_avto<=$custom_nds[1])){
                return $custom_prise;
            }
        }
    }

    //Получаем курс валют для показа
    public function money_kurs (){
        //Получаем ту валюту, которую выбрал пользователь
        $currency = $_POST['prise_format_auto'];
        if (($currency !== 'rub')&&(!empty($currency)&&(!empty($_POST['prise'])))){
        return $this->$currency();
        } else return 1;

        //Запрашиваем текущий курс
    }
    // Конвертируем цену из выбранной валюты в рубли для внутреннего рассчета
    public function convert_in_rub(){
        if (!empty($_POST['prise'])){
            return $this->money_kurs() * $_POST['prise'];
        }else{
            return 1;
        }

    }
    //Определяем категорию лица (Физ или Юрик)
    public function face_government(){
        $legal_entity=$_POST['legal_entity'];
//        if (empty($legal_entity)){
//            $legal_entity = 1;
//        }
        return $legal_entity;
    }
    //Определяем возраст автомобиля
    public function year_avto(){
        $year_avto=$_POST['year_auto'];
        if (empty($year_avto)){
            $year_avto = 1;
        }
        return $year_avto;
    }
    //Определяем категорию для дальнейших рассчетов
    public function cat_avto(){
        $cat_avto=$_POST['categorys_auto'];
        if (empty($cat_avto)){
            $cat_avto = 20000;
        }
        return $cat_avto * 1;
    }
    //Получаем объем двигателя
    public function power_engine(){
        $power = $_POST['volume_engine'];
        if ((empty($power))||(!is_numeric($power))){
            $power = 0;
        }
        return $power;
}
    //Получаем сведения о том, на чем работает авто.
    public function engine_auto(){
        $engine = $_POST['engine_auto'];
        if (empty($engine)){
            $engine = 1;
        }
        return $engine;
    }
    //Получаем сведения о ед.измерения мощности двигателя и переводим ее в л.с
    public function convert_power_engine(){
        $convert_power = $_POST['engine_power_auto'];
        if (empty($convert_power)){
            $convert_power = 1;
        }
        return $convert_power;
    }
    //Получаем данные по мощности двигателя для высчета данных и акциза
    public function power_eng(){
        $power_engine = $_POST['power_engine'];
        if (empty($power_engine)){
            $power_engine = 1;
        }
        if ($this->convert_power_engine() == 2){
            $power_engine = $power_engine * 1.3596;
        }
        return $power_engine;
    }
    //Высчитываем акциз на автомобиль по мощности
    public function akciz(){
        foreach ($this->akciz_sbor as $volume =>$akcizz){
            if (($this->power_eng() >= $akcizz[0]) && ($this->power_eng() <= $akcizz[1])){
                return $volume * $this->power_eng();
            }
        }
    }
    // Высчитываем НДС = 20% от каталожн стоимость + тамож пошл + акциз.
    //Нужно посчитать тамож пошлину
    public function nds(){
        $nds = ($this->convert_in_rub() + $this->customs_nds() + $this->akciz()) * 0.2;
        return $nds;
    }
    //Высчитываем таможенную ставку. Главный метод. Массивы выше разделил для удобства считывания
    public function customs_nds(){

        //Вначале разделяем на физ лица и юр лица.
        if (($this->face_government() == 1)&& $this->engine_auto()!=='electro_car'){
            //теперь берем по возрасту. Если 3 года то одна таблица, если больше и тд то другая
            if ($this->year_avto() == 1){
               $customs_nds = $this->custom_nds_fiz3_years();

            }elseif ($this->year_avto() == 2){
                $customs_nds = $this ->custom_nds_fiz3to5_years();

            }
            else{
                $customs_nds = $this->custom_nds_fizmany5years_years();

            }
        }elseif (($this->face_government() == 2) && ($this->engine_auto()!=='electro_car')){
            //Таблица рассчета для юр.лиц. Идет вначале для бензин двиг, затем для дизельного.

            if ($this->engine_auto() == 1){

               $customs_nds =  $this->customs_nds_ur_petrol();
            }elseif (($this->engine_auto() == 2) || ($this->engine_auto()==3)){
                $customs_nds = $this->customs_nds_ur_diesel();
            }
        }elseif ($this->engine_auto()=='electro_car')
        {
            $customs_nds = 0;
        }
        return intval($customs_nds);
    }

    //Метод считаем тамож ставку для физ лиц и авто до 3х лет
    public function custom_nds_fiz3_years(){
        $prise = $this->convert_in_rub() / $this->money_kurs_eur();
        $power_engine = $this ->power_engine();
        for ($i=0;$i<=count($this->customs_duty_leight_3years);$i++){
            // var_dump($this->customs_duty_leight_3years);
            //Перебираем массив, узнаем и сравниваем цену в евро
            if (($prise > $this->customs_duty_leight_3years[$i][0]) && ($prise <= $this->customs_duty_leight_3years[$i][1]) ){
                //Cчитаем тамож ставку по баз правилам
                $customs_nds = ($prise * $this->customs_duty_leight_3years[$i][3]) * $this->money_kurs_eur();
                //Считаем значение мин суммы если тамож ставка будет низкой.
                $custom = ($power_engine * $this->customs_duty_leight_3years[$i][2])* $this->money_kurs_eur();
                //Если значение тамож ставки ниже минимального значения по правилам, то возвращаем значение с учетом объема двиг на мин коэффициент.
                if ($customs_nds <= $custom ){
                    $customs_nds = $custom;
                }
            }

        }return $customs_nds;
}
      //Считаем пошлину для автомобилей физ лиц от 3 до 5 лет по объему двигателя
     public function custom_nds_fiz3to5_years (){
         $power_engine = $this ->power_engine();
         $customs_leight_3to5 = $this ->customs_duty_leight_3to5years;
         for ($i = 0; $i <= count($customs_leight_3to5);$i++){
             if (($customs_leight_3to5[$i][0] < $power_engine) && $customs_leight_3to5[$i][1] >= $power_engine){

                 $customs_nds = ($customs_leight_3to5[$i][2] * $power_engine)* $this->money_kurs_eur();
             }
         }return $customs_nds;
     }
     //Считаем пошлину для авто физ лиц старше 5 лет. Все считается от объема двигателя
    public function custom_nds_fizmany5years_years(){
        $power_engine = $this ->power_engine();
        $customs_leight_many5 = $this->customs_duty_leight_many5years;
        for ($i = 0; $i <= count($customs_leight_many5);$i++){
            if (($this->customs_duty_leight_many5years[$i][0] < $power_engine) && $this->customs_duty_leight_many5years[$i][1] >= $power_engine){

                $customs_nds = ($this->customs_duty_leight_many5years[$i][2] * $power_engine)* $this->money_kurs_eur();
            }
        }return $customs_nds;
    }
    //Считаем тамож ставку для юр.лиц на авто с бенз двиг. Гл.Метод для бенз двиг.
    public function customs_nds_ur_petrol (){
        if ($this->year_avto() == 1){

             return $this->customs_nds_ur_petrol_3years();
        }elseif ($this->year_avto() == 4){
            return $this->customs_nds_ur_petrol_old7years();
        }else{
            return $this->customs_nds_ur_petrol_3to7years();
        }

    }
    // Юр лица до 3х лет. Бензин
    public function customs_nds_ur_petrol_3years(){
        $volume_engine = $this->power_engine();
        $data_engine = $this->customs_duty_entities3years;
        for ($i=0;$i<=count($data_engine);$i++){
            if (($data_engine[$i][0] < $volume_engine)&& $data_engine[$i][1] >= $volume_engine){
                $customs_nds = $this->convert_in_rub() * $data_engine[$i][2];
            }
        } return $customs_nds;
    }
    // Юр лица от 3х до 7 лет.Бензин
    public function customs_nds_ur_petrol_3to7years(){
        $volume_engine = $this->power_engine();
        $data_3to7= $this->customs_duty_entities3to5years;
        for ($i=0; $i <= count($data_3to7);$i++){
            if (($data_3to7[$i][0] < $volume_engine)&& ($data_3to7[$i][1] >= $volume_engine)){
                $customs_nds = $this->convert_in_rub() * $data_3to7[$i][3];
                //Сравниваем с мин значением по таблице. Если полученная ставка ниже той что может быть в принципе, то рассчитываем все через объем двигателя.
                $alternative_nds = ($data_3to7[$i][2] * $volume_engine) * $this->money_kurs_eur();

                if ($customs_nds < $alternative_nds){
                    $customs_nds = $alternative_nds;
                }
            }
        }return $customs_nds;
    }
    // Старше 7 лет. Бензин
    public function customs_nds_ur_petrol_old7years(){
        $volume_engine = $this->power_engine();
        $dataold7years = $this->customs_duty_entities7years;
        for ($i=0; $i<=count($dataold7years);$i++){
            if (($dataold7years[$i][0] < $volume_engine)&&($dataold7years[$i][1] >= $volume_engine)){
                $customs_nds = ($volume_engine * $dataold7years[$i][2])* $this->money_kurs_eur();
            }
        }return $customs_nds;
    }
    //Считаем тамож ставку для юр.лиц на авто с диз двиг
    public function customs_nds_ur_diesel(){
        if ($this->year_avto() == 1){

            return $this->customs_nds_ur_diesel_3years();
        }elseif ($this->year_avto() == 4){
            return $this->customs_nds_ur_diesel_old7years();
        }else{
            return $this->customs_nds_ur_diesel_3to7years();
        }

    }
    // Тамож ставка для авто с диз двиг до 3х лет
    public function customs_nds_ur_diesel_3years(){
        $volume_engine = $this->power_engine();
        $data_engine = $this->customs_duty_entities_dizel3years;
        for ($i=0;$i<=count($data_engine);$i++){
            if (($data_engine[$i][0] < $volume_engine)&& $data_engine[$i][1] >= $volume_engine){
                $customs_nds = $this->convert_in_rub() * $data_engine[$i][2];
            }
        } return $customs_nds;
    }
    // Тамож ставка для авто с диз двиг от 3 до 7 лет
    public function customs_nds_ur_diesel_3to7years(){
        $volume_engine = $this->power_engine();
        $data_3to7= $this->customs_duty_entities_dizel3to7years;
        for ($i=0; $i <= count($data_3to7);$i++){
            if (($data_3to7[$i][0] < $volume_engine)&& ($data_3to7[$i][1] >= $volume_engine)){
                $customs_nds = $this->convert_in_rub() * $data_3to7[$i][3];
                //Сравниваем с мин значением по таблице. Если полученная ставка ниже той что может быть в принципе, то рассчитываем все через объем двигателя.
                $alternative_nds = ($data_3to7[$i][2] * $volume_engine) * $this->money_kurs_eur();

                if ($customs_nds < $alternative_nds){
                    $customs_nds = $alternative_nds;
                }
            }
        }return $customs_nds;
    }
    // Тамож ставка для авто с диз двиг старше 7 лет
    public function customs_nds_ur_diesel_old7years()
    {
        $volume_engine = $this->power_engine();
        $dataold7years = $this->customs_duty_entities_dizel_many7years;
        for ($i=0; $i<=count($dataold7years);$i++){
            if (($dataold7years[$i][0] < $volume_engine)&&($dataold7years[$i][1] >= $volume_engine)){
                $customs_nds = ($volume_engine * $dataold7years[$i][2])* $this->money_kurs_eur();
            }
        }return $customs_nds;
    }
     //Собираем данные для рассчета утилизационного сбора УС = Базовая ставка (устновлена выше) * Коэффициент (данные массива)
    public function utilizations_in(){
        if ($this->face_government() == 1){
                if ($this->year_avto() == 1){
                    $utilizations = $this->cat_avto() * $this->util_sbor_leght[0];
                }else {
                    $utilizations = $this->cat_avto() * $this->util_sbor_leght[1];

                }

        }elseif ($this->face_government() == 2){
            if ($this->year_avto() == 1){
                $avto_comerc = $this->util_sbor_cargo_min;
            }else{
                $avto_comerc = $this->util_sbor_cargo_max;
            }

                foreach ($avto_comerc as $util_cargo=>$coefficient){
                    foreach ($coefficient as $years=>$coefficient_years){
                        if ($years <= $this->power_engine()){
                            $utilizations = $coefficient_years * $this->cat_avto();
                        }elseif ($this->engine_auto() == 'electro_car'){
                            $utilizations = $coefficient['electro_car'] * $this->cat_avto();
                        }
                    }
                }

        }else{
            return null;
        }
        return $utilizations;

    }
    //Проверка подключения.
    protected function money_params(){

        $xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . date('d/m/Y'));
        if ($xml){
            return 1;
        }else return 0 ;
    }
    //Курс доллара
    public function money_kurs_usd (){
        $this->usd = 0;
        if ($this->money_params() == 1 ) {
            $xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily.asp?date_req=');

            foreach ($xml->Valute as $item) {
                //var_dump($item);

                if ($item['ID'] == 'R01235') {
                    $this->usd = $item->Value;
                }elseif (number_format(intval($this->usd ))==0){
                    $this->usd = 74.98;
                }
                else{
                    continue;
                }
            }

        }else {
            $this->usd = 105;
        } return $this->usd;

    }

    //Курс Евро
    public function money_kurs_eur (){
            $this->eur = 0;
            if ($this->money_params() == 1 ) {
                $xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily.asp?date_req=');
                foreach ($xml->Valute as $item) {
                    if (($item['ID'] == 'R01239')) {
                        $this->eur = $item->Value;
                    }elseif (empty($item['ID'])){
                        $this->eur = 84.48;
                    }
                    else {
                        continue;
                    }

                }

                }else {$this->eur = 115;}

                return $this->eur;

            }
    //Курс Белорусского рубля
    public function money_kurs_blr (){
        $this->blr = 0;



        if ($this->money_params() == 1 ) {
            $xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily.asp?date_req=');
            foreach ($xml->Valute as $item) {
                if (($item['ID'] == 'R01090B')) {
                    $this->blr = $item->Value;
                }elseif (empty($item['ID'])){
                    $this->blr = 29.35;
                }
                else {
                    continue;
                }

            }

        }else {$this->blr = 31;}

        return $this->blr;
    }
    //Курс Украинского гривня
    public function money_kurs_ukr (){
        $this->ukr = 0;



        if ($this->money_params() == 1 ) {
            $xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily.asp?date_req=');
            foreach ($xml->Valute as $item) {
                if (($item['ID'] == 'R01720')) {
                    $this->ukr = $item->Value;
                }elseif (empty($item['ID'])){
                    $this->ukr = 27.63;
                }
                else {
                    continue;
                }

            }

        }else{ $this->ukr = 2.78; }

        return $this->ukr;
    }
    //Курс тенге
    public function money_kurs_tenge (){
        $this->usd = 0;



        if ($this->money_params() == 1 ) {
            $xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily.asp?date_req=');
            foreach ($xml->Valute as $item) {
                if ($item['ID'] == 'R01335') {
                    $this->tenge = $item->Value;
                }elseif (empty($item['ID'])){
                    $this->tenge = 16.81;
                }
                else{
                    continue;
                }
            }


        } else { $this->tenge = 0.18; }
        return $this->tenge;
    }

}