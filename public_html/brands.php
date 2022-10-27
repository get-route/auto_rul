<?php
require_once "Admin/Config/config.php";
require_once "Class/Core.php";
require_once "Class/Brands.php";
require_once "Class/CoreModel.php";
require_once "Class/Cache.php";
$cache = new \Admin\Cache();
$models= new CoreModel();
$obj2=new Brands();
//Получаем урл страницы бренда
$url_models=$obj2->url_brand();
//Выводим инфу о бренде
foreach ($obj2->get_brand_content($url_models) as $all_info_brand){?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?php echo $all_info_brand['description']?>">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="icon" href="/favicon.png" type="image/png">
    <title><?php echo $all_info_brand['title']." (" . date("Y") . ")" ?></title>
</head>
<body class="body">
<?php
$obj=new Index();
$obj->get_body();
$obj->get_adv_content(); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center h1-brands">
                <h1><?php echo $all_info_brand['h1']?></h1>
            </div>
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo INDEX ;?>">Главная</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Калькулятор растаможки <?php echo "(".date("Y").")" ?> из <?php echo $all_info_brand['brand_name']?> в Россию</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-12 text-center">
                <?php
                //Рекламный блок под заголовком.
                echo $obj->adv_bloks[0]['h1adv_brands'];
                ?>
            </div>
        </div>
        <?php

//Оснлватели
        //

        //Сьтрана
        // echo $all_info_brand['country'];

        ?>
    </div>
</section>
<section>
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-3">
                <ul class="models-menu">
                    <li><a href="<?php echo INDEX."/".$url_models."#submit"?>">Калькулятор</a> </li>
                    <li><a href="<?php echo INDEX."/".$url_models."#benefits"?>">Льготы</a> </li>
                    <li><a href="<?php echo INDEX."/".$url_models."#discount"?>">Кому дешевле</a> </li>
                    <li><a href="<?php echo INDEX."/".$url_models."#document"?>">Документы</a> </li>
                    <li><a href="<?php echo INDEX."/".$url_models."#blocked"?>">Ограничения</a> </li>
                    <li><a href="<?php echo INDEX."/".$url_models."#good"?>">Выгодные модели</a> </li>
                    <li><a href="<?php echo INDEX."/".$url_models."#comment"?>">Комментарии</a> </li>
                </ul>
            </div>
            <div class="col-lg-9 calculate">
                <?php require_once "Kalk.php"?>
            </div>

            <div class="text-center col-lg-12">
                <?php require_once "social-button.php"?>
                <hr class="hr-info">
                <img src="images/brands/<?php echo $all_info_brand['img_brands']?>" class="brands-image-hr">
            </div>
            <div class="col-lg-12">
                <div class="col-lg-12 text-center">
                    <?php
                    //Рекламный блок.
                    echo $obj->adv_bloks[0]['historyadv_brands'];
                    ?>
                </div>
                <?php echo $all_info_brand['history_brands']?>
                <div class="col-lg-12 text-center">
                    <?php
                    //Рекламный блок.
                    echo $obj->adv_bloks[0]['erroradv_brands'];
                    ?>
                </div>
                <?php echo $all_info_brand['error_brands']?>
            </div>
            <div class="text-center col-lg-12">
                <hr class="hr-info">
                <img src="images/brands/<?php echo $all_info_brand['img_brands']?>" class="brands-image-hr">
            </div>
            <div class="col-lg-12">
                <h2 id="benefits">Льготы для растаможки машины из <?php echo $all_info_brand['brand_name']." в ".date("Y")." году" ?></h2>
                <hr class="hr-info">
            </div>
                <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                    <p>Беженцы. </p>
                </div>

                <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                    <img src="images/config/checked.webp" alt="список льгот для растаможки машины">
                </div>
            <hr class="hr-info">
            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <p>Иностранцы на ПМЖ. </p>
            </div>

            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <img src="images/config/checked.webp" alt="список льгот для растаможки машины">
            </div>
            <hr class="hr-info">
            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <p>Дипломаты. </p>
            </div>

            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <img src="images/config/checked.webp" alt="список льгот для растаможки машины">
            </div>
            <hr class="hr-info">
            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <p>При покупке отечественного автомобиля. </p>
            </div>

            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <img src="images/config/checked.webp" alt="список льгот для растаможки машины">
            </div>
            <hr class="hr-info">
            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <p>Ивалиды I,II и III группы. </p>
            </div>

            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <img src="images/config/no.webp" alt="список льгот для растаможки машины">
            </div>
            <hr class="hr-info">
            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <p>Многодетные семьи. </p>
            </div>

            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <img src="images/config/no.webp" alt="список льгот для растаможки машины">
            </div>
            <hr class="hr-info">
            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <p>Ветераны. </p>
            </div>

            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <img src="images/config/no.webp" alt="список льгот для растаможки машины">
            </div>

            <div class="text-center col-lg-12">
                <hr class="hr-info">
                <img src="images/brands/<?php echo $all_info_brand['img_brands']?>" class="brands-image-hr">
            </div>
            <div class="col-lg-12">
                <h3 id="discount"> Кому и где дешевле растамаживать?</h3>
                <hr class="hr-info">
            </div>
            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <p>Жителям Калининграда.</p>
                <p class="text-muted"><small>*Разрешено передвигаться на нерастаможенном автомобиле в течении 2х лет с даты ввоза на территорию РФ. При продаже оформление обязательно.</small></p>
            </div>

            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <img src="images/config/kaliningrad.webp" alt="кому дешевле растаможка">
            </div>
            <hr class="hr-info">
            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <p>При ввозе отечественного автомобиля.</p>
                <p class="text-muted"><small>*Граждане РФ имеют право воспользоваться привелегиями на растаможку отечественного авто по льготным ценам. Скидка действует на все отечественные марки (в том числе и раритетные) и составляет 1 евро/куб.см.</small></p>
            </div>

            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <img src="images/config/old-car.webp" alt="кому дешевле растаможка">
            </div>
            <hr class="hr-info">

            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <p>При переезде на ПМЖ в РФ.</p>
                <p class="text-muted"><small>*При оформлении переезда в РФ, иностранное лицо имеет право в течении 1 календарного года не производить процесс растаможки транспортного средства.</small></p>
            </div>

            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <img src="images/config/country.webp" alt="кому дешевле растаможка">
            </div>
            <hr class="hr-info">
            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <p>Беженцам.</p>
                <p class="text-muted"><small>*Если автомобиль был куплен задолго до оформления статуса беженца (от 6 месяцев), то таможенные сборы на такое транспортное средство не распространяются.</small></p>
            </div>
            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <img src="images/config/refugee.webp" alt="кому дешевле растаможка">
            </div>
            <hr class="hr-info">

            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <p>Авто купленное до 1992 года.</p>
                <p class="text-muted"><small>*Если машина приобретена до 1992 года и ввозится с "постсоветского пространства", то для условия ее растаможки будут мягче.</small></p>
            </div>
            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <img src="images/config/soviet-union.webp" alt="кому дешевле растаможка">
            </div>
            <hr class="hr-info">
            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <p>Дипломатам и посольствам.</p>
                <p class="text-muted"><small>*Определенные скидки действуют при оформлении транспортных средств для дипломатов и сотрудников посольств.</small></p>
            </div>
            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <img src="images/config/attache-case.webp" alt="кому дешевле растаможка">
            </div>
            <hr class="hr-info">

            <div class="col-lg-12">
                <h3 id="document">Документы для растаможки из  <?php echo $all_info_brand['brand_name']?></h3>
                <hr class="hr-info">
            </div>

            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <p>Декларация.</p>
            </div>
            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <p>Договор купли-продажи.</p>
            </div>
            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <p>Иностранный паспорт.</p>
            </div>
            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <p>Документ тех.состояния автомобиля (например диагн.карта).</p>
            </div>
            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <p>Полис ОМС (обязательного медицинского страхования).</p>
            </div>
            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <p>Паспорт Гражданина РФ (при наличии.</p>
            </div>

            <div class="col-lg-12">
                <h3 id="blocked">Ограничения</h3>
                <hr class="hr-info">
            </div>

            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <p>Для физ.лиц - 1 авто в год.</p>
            </div>
            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <p>Для юр.лиц - неогр.</p>
            </div>
        </div>
    </div>
</section>
<?php
}
?>
<section class="models-error">
    <div class="container">
        <div class="row">
            <hr class="hr-info">
            <div class="col-lg-12">
                <h2 id="good" class="text-center">Какие машины выгоднее растаможить из   <?php echo $all_info_brand['brand_name']?></h2>
            </div>
                <div class="text-center col-lg-12">
                    <hr class="hr-info">
                    <img src="images/brands/<?php echo $all_info_brand['img_brands']?>" class="brands-image-hr">
                </div>

            <div class="col-lg-12 text-center">
                <?php
                //Рекламный блок.
                $obj->adv_bloks[0]['modelsadv_error'];
                ?>

            </div>

            <div class="col-lg-8 text-center">
                <div class="row kard-models">

                    <?php echo $all_info_brand['country']; ?>

                </div>
                </div>
                <div class="line-vertikal"></div>

            <div class="col-lg-3 models-error-info">
                <h3>Самые экспортируемые в <?php echo date("Y") ?> году:</h3>
                <?php echo $all_info_brand['autor']; ?>
            </div>

            <div class="col-lg-12">
                <div class="text-center col-lg-12">
                    <hr class="hr-info">
                    <img src="images/brands/<?php echo $all_info_brand['img_brands']?>" class="brands-image-hr">
                </div>
                <h3 class="text-center">Видео-советы как перевозят машины из <?php echo $all_info_brand['brand_name']?></h3>
                <hr class="hr-info">
                <div class="text-center video-post">
                    <iframe
                            class="video"
                            width="100%"
                            height=350px
                            src="//www.youtube.com/embed/<?php echo $all_info_brand['video']?>"
                            srcdoc="<style>*{padding:0;margin:0;overflow:hidden}html,body{height:100%}img,span{position:absolute;width:100%;top:0;bottom:0;margin:auto}span{height:1.5em;text-align:center;font:48px/1.5 sans-serif;color:white;text-shadow:0 0 0.5em black}</style><a href=//www.youtube.com/embed/<?php echo $all_info_brand['video']?>?autoplay=1><img src=//img.youtube.com/vi/<?php echo $all_info_brand['video']?>/hqdefault.jpg alt='Видео о проверке подлинности' class='video img-fluid'><span>▶</span></a>"
                            frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            title="Видео-отзыв"
                    ></iframe>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<section class="models-error">
    <div class="container">
        <div class="row">
            <div class="text-center col-lg-12">
                <hr class="hr-info">
                <img src="images/brands/<?php echo $all_info_brand['img_brands']?>" class="brands-image-hr">
            </div>

            <div class="col-lg-12">
                <h2 id="error" class="text-center">Цена на растаможку из <?php echo $all_info_brand['brand_name']?> по моделям</h2>
            </div>
            <div class="col-lg-12 text-center">
                <?php
                //Рекламный блок.
                $obj->adv_bloks[0]['modelsadv_error'];
                ?>

            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <input type="text" class="form-control  models-search" id="search" placeholder="Укажите бренд авто или модель">
                </div>
            </div>
            <div class="col-lg-12 text-center">
                <table id="mytable" class="table-error table table-bordered table-striped table-Secondary table-responsive">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Бренд</th>
                        <th scope="col">Модель</th>
                        <th scope="col">Рассчитать</th>
                        <th scope="col">Цена</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($cache::read_cache_xml("./Admin/cache/models.xlsx") as $model){
                        $number_tr = $number_tr + 1;
                    ?>
                    <tr>
                        <th scope="row"><?php echo $number_tr;?></th>
                        <td><?php echo $model['A']?> </td>
                        <td><?php echo $model['B']?></td>
                        <td><a class="models-link" target="_blank" href="<?php echo INDEX."/".$url_models."/".$model['C']?>">Рассчитать </a> </td>
                        <td><img src="/images/config/plus.png" width="40px" height="50px" alt="Расчет стоимости растаможки"></td>

                    </tr>
                    <?php  } ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    </div>
</section>
<section class="comments">
    <div class="text-center col-lg-12">
        <hr class="hr-info">
        <img src="/images/config/comment.webp" class="brands-image-hr">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 id="comment" class="text-center">Отзывы владельцев:</h2>
            </div>
            <?php foreach ($obj2->get_brands_comment_read($obj2->url_brand()) as $comment_brand ){
                ?>
                <div class="col-lg-2">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <img src="/images/config/user.png" alt="<?php echo "Аватарка комментатора ".$comment_brand['name']?>" class="models-user-img">
                            <p class="models-name-comment"><?php echo $comment_brand['name']?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 models-text-coment">
                    <p>"<?php echo $comment_brand['comment']?>"</p>
                </div>
                <div class="text-center col-lg-12">
                    <hr class="hr-info">
                    <img src="/images/config/comment.webp" class="brands-image-hr">
                </div>
            <?php } ?>
            <div class="col-lg-12">
                <form class="comment_form" action="#" method="post" name="contact_form">
                    <ul>
                        <li>
                            <h3 class="text-center">Оставить комментарий:</h3>
                            <span class="required_notification">* Обязательные поля</span>
                        </li>
                        <li>
                            <label for="name">Имя*:</label>
                            <input type="text"  placeholder="Иван" name="name" required />
                        </li>
                        <li>
                            <label for="email">Email*:</label>
                            <input type="email" name="email" placeholder="ivan@example.ru" required />
                            <span class="form_hint">Формат почты "name@something.ru"</span>
                        </li>
                        <li>
                            <label for="message">Комментарий*:</label>
                            <textarea name="message" cols="40" rows="6" required ></textarea>
                        </li>
                        <li>
                            <button class="submit" name="submit_komment" type="submit" >Отправить</button>
                        </li>
                    </ul>
                    <?php if (isset($_POST['submit_komment'])){
                        $obj2->get_public_komment_brands($obj2->url_brand())?>
                        <div class="col-lg-12 text-center">
                            <h4>Комментарий отправлен!...</h4>
                            <p>Спасибо! Ваш комментарий отправлен и появится на сайте после проверки администрацией.</p>
                        </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</section>

<footer>
    <?php $obj->get_footer();?>

    <script>
        $(document).ready(function(){
            $("#search").keyup(function(){
                _this = this;
                $.each($("#mytable tbody tr"), function() {
                    if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                        $(this).hide();
                    else
                        $(this).show();
                });
            });
        });
    </script>
</footer>
</body>
</html>