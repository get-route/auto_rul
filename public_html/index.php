<?php
require_once "Admin/Config/config.php";
require_once "Class/Core.php";
require_once "Class/config.php";
require_once "Class/Index.php";
require_once "Class/Calculate.php";
require_once "Class/CoreModel.php";
require_once "Class/Brands.php";
$config=new config();
$models= new CoreModel();
$calculate = new Calculate();
$brands = new Brands();
$url = $_SERVER['REQUEST_URI'];
$url_arr = explode("/",$url);
$count_url = count($url_arr);
foreach ($models->models_url($url_arr[2]) as $models_kontents){
}
foreach ($brands->get_brand_content($url_arr[1]) as $brand_kontent){

}
foreach ($config->get_routes() as $url_adress) {
    $brand = "/" . $url_adress;
    if ($url == "/") {
        break;
    }
    elseif ($url == $brand)  {
        include "brands.php";
        exit();
    } elseif ($count_url == 3 && $models_kontents['brand_url']===$url_arr[2] && $brand_kontent['url_brands']===$url_arr[1]) {
        include "model.php";
        exit();
    }
}
if (($url !=="/")) {
    http_response_code(404);
    include_once '404.php';
    exit();
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Наиболее точный калькулятор стоимости растаможки автомобилей из различных стран мира в Россию. Данные за <?php echo  date("Y") . " год" ?>. Цены на растамаживание и советы льготникам.">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="icon" href="/favicon.png" type="image/png">
    <title>Точный калькулятор растаможки автомобиля <?php echo "(" . date("Y") . " года)" ?> онлайн в Россию</title>
</head>
<body class="body">
<?php
$obj=new Index();
$obj->get_body();
$obj->get_adv_content();
?>
<section class="">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 pretext text-center">
                <h1>Калькулятор стоимости растаможки авто в Россию</h1>
                <p>*Выберите интересующую Вас страну, укажите основные данные и получите свежие цены на растаможку машины на <?php echo  date("Y") . " год" ?>.</p>
            </div>



            <div class="col-12 col-lg-12  col-sm-12 col-md-12">
                <div class="row">
                    <div class="col-8 col-lg-8  col-sm-8 col-md-8">
                        <p>*Вы хотели бы растаможить авто ИЗ ...</p>
                                <div class="row text-center car-menu">
                                    <?php foreach ($obj->get_brand_index() as $index_brands) {?>
                                        <div class="col-6 col-lg-3  col-sm-4 col-md-3">
                                            <a target="_blank" href="<?php echo INDEX."/".$index_brands['url_brands']?>"> <img src="images/brands/<?php echo $index_brands['img_brands']?>" class="car-icon" alt="флаг <?php echo $index_brands['brand_name']?>">
                                                <p class="header-name"><?php echo $index_brands['brand_name']?></p>
                                            </a>
                                        </div>
                                    <?php } ?>

                                </div>

                    </div>
                    <div class="col-4 col-lg-4  col-sm-4 col-md-4 ">
                        <img class="avto-header" src="images/config/octavia-brilliant-silver.png">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="statistic">
    <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">Не знаете сколько стоит растаможка авто в <?php echo  date("Y") . " году?" ?></h2>
        </div>
        <div class="col-lg-6">
            <div class="col-lg-12 text-center">
                <img src="./images/config/logo.webp" alt="Портал проверки кодов ошибки посудомоек" width="100" height="100">
            </div>

            <p>"Сервис калькуляторов Avto-Rul.ru - это площадка для подсчета наиболее точно суммы, которую Вы затратите при проведении процедуры растамаживания транспортного средства.</p>
            <p>Мы специально разделили калькуляторы по странам, чтобы Вы нашли именно свой калькулятор для конкретного местоположения.</p>
            <p>У нас Вы найдете свежую информацию на текущий год. Также доступна обратная связь с разработчиками для того, чтобы можно было задать свой вопрос тем, кто уже проводил процедуру растаможки.</p>
            <p>*Учитывая, что данные динамически меняются. Мы настоятельно просим Вас перепроверять сведения несколько раз. В зависимости от курса валют и ряда правил тех или иных государств, стоимости растамаживания может меняться."</p>
        </div>
        <div class=" video-promo d-none d-lg-block d-xl-blockcol-lg-6 text-center">
            <video class="promo-video" controls poster = "./images/video/what-servis.webp">
                <source src = "<?php echo INDEX?>/images/video/calculate-rastamogka.mp4" type = 'video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
                <source src = "<?php echo INDEX?>/images/video/calculate-rastamogka.ogg" type = 'video/ogg; codecs="theora, vorbis"'>
                <source src="<?php echo INDEX?>/images/video/calculate-rastamogka.webm" type='video/webm; codecs="vp8, vorbis"'>
            </video>
        </div>
    </div>
    </div>
</section>
<section class="sliders">
    <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 id="otzyv" class="text-center col-lg-12">Отзывы</h2>
        </div>
        <div class="col-lg-12 text-center slider">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner text-center">
                    <div class="carousel-item active">
                        <h3>Калькулятор помог купить необходимую модель</h3>
                        <p>" Несколько лет назад я искал себе Опель Астра. Всегда хотел именно этот автомобиль и не знал во что он мне обойдется.</p>
                        <p>В Европе его стоимость вообще копейки, учитывая на то сколько у нас он стоит. Ну я и решил рискнуть.</p>
                        <p>Связался с продавцом, уточнил все детали. Также на таможню обратился за разъяснениями. Попутно посчитал все сдесь. </p>
                        <p>В итоге расхождение по значениям не более 10% вышло. Причем в меньшую сторону. Я в принципе доволен."</p>

                    </div>
                    <div class="carousel-item">
                        <h3>Купил себе Фьюжена за 10 000</h3>
                        <p>"На той неделе пригнал себе Форд Фьюжен 2011 года выпуска.</p>
                        <p>Заплатил за него 10 000 долларов с копейками. По нынешним ценам это прямо таки очень круто.</p>
                        <p>Автомобиль был у одного владельца. Однако когда пришел такое ощущение, что на нем вообще не ездили.</p>
                        <p>Пробег в районе 140 000 киллометров. Считай и не ездил вовсе. В салоне даже кожанные элементы есть.</p>
                        <p>Изначально нервничал, вдруг чего не понимаю. Считал на Вашем калькуляторе. Все сошлось точно. Сколько он мне выдал, столько я и отдал Государству."</p>
                    </div>
                    <div class="carousel-item v">
                        <h3>Растаможил себе Камри за 15 000 долларов</h3>
                        <p>"Моя мечта была всегда купить себе Камри. Не думал, что в этом году ее осуществлю.</p>
                        <p>Долго решался. Все на калькуляторе высчитывал. Но оказалос зря волновался автомобиль просто шикарен. </p>
                        <p>У нас за подобный просят где-то в районе 20-30 тысяч долларов.</p>
                        <p>Мне удалось уложиться в 15 000. Причем модель свежая 2015 года. Перегонял из штатов.</p>
                        <p>Продавец попался русскоговорящий, все рассказал и разъяснил. Мне понравилось."</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
</section>
<section class="stat-numbers">
    <div class="container">
        <div class="row icon-statistic text-center">
            <div class="col-lg-4 ">
                <h3>Актуальность:</h3>
                <img src="images/statistic/number1.webp" alt="актуальность калькулятора для растамаживания" class="number1">
                <p><?php echo  date("Y") . " год" ?></p>
            </div>
            <div class="col-lg-4">
                <h3>Стран:</h3>

                <img src="images/statistic/number2.webp" alt="сколько стран для рассчета есть в калькуляторе" class="number1">
                <p><?php echo $config->get_num_brands(); ?></p>
            </div>
            <div class="col-lg-4">
                <h3>Комментариев:</h3>
                <img src="images/statistic/number4.webp" alt="комментариев на сайте" class="number1">
                <p><?php echo $config->get_num_comments(); ?></p>
            </div>
        </div>
    </div>
</section>
<footer>
    <?php $obj->get_footer(); ?>
</footer>
</body>
</html>