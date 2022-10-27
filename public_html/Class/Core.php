<?php
require_once "Admin/Config/config.php";

abstract class Core
{
    protected $db;
    public $footer_brands;
    public $footer_model;
    public $footer_errors;
    public $adv_blok;
    public $adv_bloks;
    protected $num_brands;
    protected $num_models;
    protected $num_errors;
    protected $num_comments;


    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=" . DBNAME, USER, PASS);
        } catch (PDOException $e) {
            die('Подключение не удалось: ' . $e->getMessage());
        }
    }
    //Количество брендов
    public function get_num_brands(){
        $this->num_brands=$this->db->query("SELECT id FROM brands");
        return $this->num_brands->rowCount();
    }


    //Количество брендов
    public function get_num_comments(){
        $this->num_comments=$this->db->query("SELECT id FROM comments");
        return $this->num_comments->rowCount();
    }
    //Получаем данные по рекламным блокам из БД
    public function get_adv_content(){
        $this->adv_blok=$this->db->prepare("SELECT * FROM adv_code");
        $this->adv_blok->execute();
        $this->adv_bloks=$this->adv_blok->fetchAll(PDO::FETCH_ASSOC);
        return $this->adv_bloks;
    }
    //Получаем бренды для футера
    protected function get_rand_footer_brand(){
        $this->footer_brands=$this->db->query("SELECT img_brands,url_brands,brand_name FROM brands WHERE `public`='yes' ORDER BY RAND() LIMIT 2 ");
        return $this->footer_brands;
}



//Заголовок страницы с меню и плюшками
    public function get_header()
    {
        ?>
        <header class="">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light ">
                   <?php if ($_SERVER['REQUEST_URI']!=="/"){ ?>
                    <a class="navbar-brand" href="<?php echo INDEX ?>">
                           <img src="/images/config/logo.webp" alt="Калькулятор растаможки автомобилей" width="100" height="100">ᗩuto-ᖇul.ru</a><?php  } else {?>
                       <p class="navbar-brand" href="">
                           <img src="/images/config/logo.webp" alt="Калькулятор растаможки автомобилей" width="100" height="100">ᗩuto-ᖇul.ru</p>
                   <?php } ?>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo"
                            aria-controls="navbarTogglerDemo" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarTogglerDemo">
                        <ul class="navbar-nav justify-content-center w-100">
                            <?php
                            $nav = "SELECT * FROM brands WHERE `public` ='yes'";
                            $navigate = $this->db->query($nav);
                            ?>


                            <li class="nav-item">
                                <a class="nav-link btn btn-dark" href="<?php INDEX ?>/#otzyv">Отзывы</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-dark" href="<?php INDEX ?>/#contakt">Контакты</a>
                            </li>
                        </ul>
                    </div>

                </nav>
            </div>
        </header>
    <?php }

//Футер
    public function get_footer()
    {?>
<div class="col-lg-12">
    <div class="row">

        <div class= "col-lg-4 text-center">
            <h4>Страны:</h4>
            <?php
            if (!empty($this->get_rand_footer_brand()))
            {

            foreach ($this->get_rand_footer_brand() as $rand_brand){
            ?>
                <div class="col-lg-12 ">
                    <a target="_blank" href="<?php echo INDEX."/".$rand_brand['url_brands']?>"><img class="footer_img" src="<?php echo INDEX."/images/brands/".$rand_brand['img_brands']?>">
                    </a>
                </div>
                <?php }  }?>
        </div>
        <div class="col-lg-4 text-center">
            <h4>Мы в соцсетях:</h4>
            <noindex><a target="_blank" href="https://vk.com/rastamogka_avto"><img src="/images/config/vk-footer.webp" width="100" height="100"></a>
            </noindex>
        </div>
        <div class="col-lg-4 text-center">
            <h4 id="contakt">Контакты:</h4>

            <div class="col-lg-12">
               <noindex> <p>Для связи с администрацией сайта</p>
                <p>Вы можете отправить свои предложения и замечания</p>
                <p>на наш адрес электронной почты - </p>
                <p>admin@auto-rul.ru</p>
                <p>Мы всегда рады Вам помочь!...</p></noindex>
            </div>
           
        </div>
        <div class="col-lg-12 text-center">
            <noindex>
            <p>Все рассчеты выполняются в соответствии с общепринятыми правилами растаможки авто. На практике данные могут различаться.</p>
            </noindex>
        </div>
        <div class="col-lg-12 text-center">
            <?php
            //Коды счетчиков
            echo $this->adv_bloks[0]['footer_advcode'];
            ?>
        </div>
    </div>
    </div>
        <script src="<?php echo INDEX;?>/js/jquery-3.5.1.min.js"></script>
        <script src="<?php echo INDEX;?>/js/popper.min.js"></script>
        <script src="<?php echo INDEX;?>/js/bootstrap.min.js"></script>
        <script src="<?php echo INDEX;?>/js/Calc.js"></script>
    <?php }

    public function get_body()
    {
        $this->get_header();
    }


}