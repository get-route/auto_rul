<?php
session_start();
require_once "Class/CoreA.php";
require_once "Class/Add.php";
require_once "Class/Editor.php";
require_once "Class/InControl.php";
if ((!$_COOKIE['User'])){
    http_response_code(404);
    header('Location:  ../404.php ');
    exit();
}
$add=new Add();
$editor=new Editor();
//Для заполнения блока категории берем данные по бренду и делим массив на заголовок категории и ее урл.
$kategory=explode("|",$_POST['models-cat']);
$url_cat_brand=$kategory[0];
$title_cat_brand=$kategory[1];
if (isset($_POST['brand_add'])) {
    $add->get_add_brand_bd($_POST['brand-title'], $_POST['brand-description'], $_POST['brand-h1'], $_POST['brand-img'], $_POST['editor10'], $_POST['editor11'], $_POST['editor8'], $_POST['editor9'], $_POST['brand-video'], $_POST['brand-name'], $_POST['url_brands']);

   header('Location: /Admin/panel_control.php?class=Brands_Admin');
}

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="icon" href="/favicon.png" type="image/png">
    <meta name="robots" content="noindex">
    <script src="./ckeditor/ckeditor.js"></script>
    <title>Добавление новой страницы <?php echo $_GET['Добавить']?></title>

</head>
<body>
<?php if ($_GET['Option']=='Brand'){?>
<div class="container">
<form method="post" class="admin_form_update" action="">
    <div class="row">
        <h2 class="col-lg-12 text-center">Мета-теги для СЕО</h2>
        <div class="mb-3 w-50 form-field-admin">
        <label for="exampleInputEmail" class="form-label">Заголовок Бренда</label>
        <input name="brand-title" type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">*Title страницы бренда</div>
    </div>
    <div class="mb-3 w-25 form-field-admin">
        <label for="exampleInputEmail" class="form-label">Название страны (ИЗ ...)</label>
        <input name="brand-name" type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">*например из Японии</div>
    </div>
        <hr class="hr-info">
        <div class="mb-3 w-50 form-field-admin">
            <label for="exampleInputEmail" class="form-label">Описание страницы (Descriptions)</label>
            <input name="brand-description" type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" >
            <div id="emailHelp" class="form-text">*Мета-тег описания страницы</div>
        </div>

        <hr class="hr-info">

        <div class="mb-3 w-50 form-field-admin">
            <label for="exampleInputEmail" class="form-label">H1 заголовок</label>
            <input name="brand-h1" type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">*Нужен для поиска. Обязателен.</div>
        </div>
        <hr class="hr-info">
        <h2 class="col-lg-12 text-center">Дополнительная информация</h2>

        <div class="mb-3 w-100 form-field-admin">
            <label for="exampleInputEmail" class="form-label">Топ Импортируемых автомобилей. Список</label>
            <textarea name="editor10" type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp">
                <ol>
                    <li>Первая  </li>
                    <li>Вторая</li>
                    <li>Третья</li>
                </ol>

            </textarea>
            <div id="emailHelp" class="form-text">*Список из моделей</div>
        </div>
        <hr class="hr-info">
        <div class="mb-3 w-100 form-field-admin">
            <label for="exampleInputEmail" class="form-label">ТОП список моделей выгодных для импорта</label>
            <textarea name="editor11" type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp">

                                    <div class="col-lg-4">
                                        <img src="images/models/1.jpg" alt="описание" class="avto-models">
                                        <h3>Ниссан Мурано</h3>
                                    </div>
                <div class="col-lg-8">
                    <table class="table-models  table-hover">
                        <tr>
                            <th>Год:</th>
                            <td>2000</td>
                        </tr>
                        <tr>
                            <th>Класс:</th>
                            <td>Седан</td>
                        </tr>
                        <tr>
                            <th>Кузов:</th>
                            <td>Хэтчбек</td>
                        </tr>
                        <tr>
                            <th>Цена (у них): </th>
                            <td> 100000 евро</td>
                        </tr>
                        <tr>
                            <th>Цена (у нас): </th>
                            <td> 100000 евро</td>
                        </tr>
                        <tr>
                            <th>Выгода(+/-):  </th>
                            <td>10000 евро</td>
                        </tr>
                    </table>
                </div>
            </textarea>
            <div id="emailHelp" class="form-text">*Список моделей выгодных для импорта.</div>
        </div>
        <hr class="hr-info">
        <div class="mb-3 w-25 form-field-admin">
            <label for="exampleInputEmail" class="form-label">Видео</label>
            <input name="brand-video" type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">*Укажите ID YouTube видео.</div>
        </div>

        <div class="mb-3 w-25 form-field-admin">
            <label for="exampleInputEmail" class="form-label">Лого (512х512px)</label>
            <select name="brand-img" id="exampleInputEmail" class=" form-select form-select-lg" aria-label=".form-select-lg example">
<?php

foreach ($editor->scandir_img("../images/brands") as $img_brands=>$url_brands){
    ?>
    <option value="<?php echo $url_brands; ?>"><?php echo $url_brands; ?></option>
<?php } ?>
            </select>
        </div>
        <div class="mb-3 w-25 form-field-admin">
            <label for="exampleInputEmail" class="form-label">УРЛ страницы</label>
            <input name="url_brands" type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">*Адрес страницы нового бренда.</div>
        </div>
<hr class="hr-info">
<h2 class="col-lg-12 text-center">История бренда</h2>
<div class="mb-3 w-100 form-field-admin">
    <label for="exampleInputEmail" class="form-label">История бренда. На 1-2т знаков</label>
    <textarea name="editor8" type="text" class="form-control" id="editor1" aria-describedby="emailHelp" ></textarea>
    <div id="emailHelp" class="form-text">*Основная информация о компании.</div>
</div>
<hr class="hr-info">
<h2 class="col-lg-12 text-center">Как найти ошибки и неисправности</h2>
<div class="mb-3 w-100 form-field-admin">
    <label for="exampleInputEmail" class="form-label">Чем искать ошибки. Где и т.д. На 1-2т знаков</label>
    <textarea name="editor9" type="text" class="form-control" id="editor2" aria-describedby="emailHelp"></textarea>
    <div id="emailHelp" class="form-text">*Основная информация о том где и как находить ошибку.</div>
</div>
        <div class="w-100">

            <button name="brand_add" type="submit" class="btn btn-primary">Обновить</button>

        </div>
    </div>
</form>
</div>
<?php } ?>

<footer>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace( 'editor8' );
        CKEDITOR.replace( 'editor9' );
        CKEDITOR.replace( 'editor10' );
        CKEDITOR.replace( 'editor11' );
    </script>
    <script src="<?php echo INDEX;?>/js/jquery-3.5.1.min.js"></script>
    <script src="<?php echo INDEX;?>/js/popper.min.js"></script>
    <script src="<?php echo INDEX;?>/js/bootstrap.min.js"></script>
</footer>
</body>