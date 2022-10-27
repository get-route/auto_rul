<?php
require_once "Admin/Config/config.php";
require_once "Class/Core.php";
require_once "Class/Brands.php";
require_once "Class/CoreModel.php";
$models= new CoreModel();
$brands_models=new Brands();
foreach ($models->models_url($models->url_models(2)) as $models_content) {

foreach ($brands_models->get_brand_content($models->url_models(1)) as $all_info_brand){

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?php echo "Сколько в итоге стоит покупка ".$models_content['brand_name']." ".$models_content['name']." из ". $all_info_brand['brand_name'].". Расчет итоговой цены автомобиля. Во сколько обойдется ".$models_content['name']." вместе с растаможкой. Показатели для моделей бу с пробегом и новых ".$models_content['brand_name'].".";  ?>">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="icon" href="/favicon.png" type="image/png">
    <title><?php echo "Купить ".$models_content['brand_name']." ".$models_content['name']." из ". $all_info_brand['brand_name'].": цена, калькулятор растаможки, c пробегом и новый" ?></title>
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
                <h1><?php echo "Стоимость ".$models_content['brand_name']." ".$models_content['name']." из ". $all_info_brand['brand_name']." с учетом растаможки на калькуляторе" ?></h1>
            </div>
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo INDEX ;?>">Главная</a></li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="<?php echo INDEX."/".$all_info_brand['url_brands']?>">Калькулятор растаможки (<?php echo date("Y") ?>) из <?php echo $all_info_brand['brand_name']. " в Россию "?></a>
                            </li>
                        <li class="breadcrumb-item active" aria-current="page">Стоимость <?php echo $models_content['brand_name']." ".$models_content['name'] ?> из <?php echo $all_info_brand['brand_name'].": калькулятор, растаможка, характеристики";?></li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-3">

                    <ul class="models-menu">
                        <li><a href="<?php echo INDEX."/".$models->url_models(1)."/".$models->url_models(2)."#submit"?>">Калькулятор</a> </li>
                        <li><a href="<?php echo INDEX."/".$models->url_models(1)."/".$models->url_models(2)."#generation"?>">Поколение</a> </li>
                        <li><a href="<?php echo INDEX."/".$models->url_models(1)."/".$models->url_models(2)."#modification"?>">Модификации</a> </li>
                        <li><a href="<?php echo INDEX."/".$models->url_models(1)."/".$models->url_models(2)."#parametr"?>">Параметры</a> </li>
                        <li><a href="<?php echo INDEX."/".$models->url_models(1)."/".$models->url_models(2)."#comment"?>">Отзывы</a> </li>
                    </ul>
                </div>
            <div class="col-lg-9 calculate">
                <?php require_once "Kalk.php"?>
            </div>
                <?php require_once "social-button.php"?>

            <div class="col-lg-12 row">
                <div class="col-lg-8 " id="generation">
                    <table class="table-brand table-responsive table-hover">
                        <tr>
                            <th>Поколения:</th>
                            <td>Годы производства:</td>
                        </tr>
                        <?php     foreach ($models->generation_auto($models_content['id_car_model']) as $generations) {
                            ?>

                            <tr>
                                <th><?php echo $generations['name'] ?></th>
                                <td><?php echo $generations['year_begin']."-".$generations['year_end']?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <div class="col-lg-2">
                    <img src="../images/brands/<?php echo $all_info_brand['img_brands']?>" class="brands-image">
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
                <img src="../images/brands/<?php echo $all_info_brand['img_brands'] ?>" class="brands-image-hr">
            </div>

            <div class="col-lg-12">
                <h2 id="modification" class="text-center">
                    Модификации <?php echo $models_content['brand_name'] . " " . $models_content['name'] ?>
                    из <?php echo $all_info_brand['brand_name'] ?></h2>
            </div>


            <div class="col-lg-12 text-center">
                <div class="row auto-modifications">
                    <?php
                    foreach ($models->modifications_auto($models_content['id_car_model']) as $modifications) {
                        ?>
                        <div class="col-lg-3">
                            <h3><?php echo $modifications['name'] ?></h3>
                        </div>
                    <?php } ?>
                </div>
                <?php }
                } ?>

            </div>
        </div>

    </div>
</section>

<section class="models-error">
    <div class="container">
        <div class="row">
            <div class="text-center col-lg-12">
                <hr class="hr-info">
                <img src="../images/brands/<?php echo $all_info_brand['img_brands']?>" class="brands-image-hr">
            </div>

            <div class="col-lg-12">
                <h3 id="parametr" class="text-center">Общая характеристика и параметры <?php echo $models_content['brand_name']." ".$models_content['name']."( из ".$all_info_brand['brand_name'].")"?></h3>
            </div>

            <div class="col-lg-12 text-center">
                <div class="row auto-modifications">
                    <?php
                    foreach ($models->characteristic_value_auto($modifications['id_car_modification']) as $modification) {
                    foreach ($models->characteristic_auto($modification['id_car_characteristic']) as $characteristics_info){
                        ?>
                        <div class="col-lg-4">
                            <h3><?php echo  $characteristics_info['name']." - ".$modification['value'].$modification['unit'] ?></h3>
                        </div>

                    <?php } } ?>

                </div>


            </div>
        </div>
    </div>
    </div>
</section>

<section class="models-error">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="text-center">Популярные калькуляторы растаможки из других стран</h2>
            </div>
            <?php foreach ($brands_models->get_all_brands_rand() as $brands_rand){ ?>
            <div class="col-6 col-lg-6  col-sm-6 col-md-6">
                <div class="row">

            

                    <div class="col-lg-6">
                        <img src="<?php echo "../images/brands/".$brands_rand['img_brands']?>" class="car-icon">
                    </div>
                    <div class="col-lg-6">
                        <a href="<?php echo INDEX."/".$brands_rand['url_brands']?>"><?php echo "Растаможка из ".$brands_rand['brand_name']?></a>
                    </div>

                </div>

            </div>
            <?php } ?>
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
            <?php foreach ($brands_models->get_brands_comment_read($models->url_models(2)) as $comment_brand ){
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
                        $brands_models->get_public_komment_brands($models->url_models(2))?>
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
</footer>
</body>
</html>