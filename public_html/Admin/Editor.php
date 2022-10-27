<?php
session_start();
require_once "Class/CoreA.php";
require_once "Class/Editor.php";
require_once "Class/InControl.php";
if ((!$_COOKIE['User'])){
    http_response_code(404);
    header('Location:  ../404.php ');
    exit();
}
$editor=new Editor();
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
    <title>Редактирование страницы <?php echo $_GET['Страницы']?></title>

</head>
<body>
<?php if ($_GET['editor']=="brand") {
    foreach ($editor->get_brand_select($_GET['url']) as $brands_kontent){
    ?>
<div class="container">
<form method="post" class="admin_form_update" action="">
    <div class="row">
        <h2 class="col-lg-12 text-center">Мета-теги для СЕО</h2>
        <div class="mb-3 w-50 form-field-admin">
        <label for="exampleInputEmail" class="form-label">Заголовок Бренда</label>
        <input name="brand-title" type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" value="<?php echo $brands_kontent['title']?>">
        <div id="emailHelp" class="form-text">*Title страницы бренда</div>
    </div>
    <div class="mb-3 w-25 form-field-admin">
        <label for="exampleInputEmail" class="form-label">Страна импорта (ИЗ...)</label>
        <input name="brand-name" type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" value="<?php echo $brands_kontent['brand_name']?>">
        <div id="emailHelp" class="form-text">*Например из Японии</div>
    </div>
        <hr class="hr-info">
        <div class="mb-3 w-50 form-field-admin">
            <label for="exampleInputEmail" class="form-label">Описание страницы (Descriptions)</label>
            <input name="brand-description" type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" value="<?php echo $brands_kontent['description']?>">
            <div id="emailHelp" class="form-text">*Мета-тег описания страницы</div>
        </div>

        <hr class="hr-info">

        <div class="mb-3 w-50 form-field-admin">
            <label for="exampleInputEmail" class="form-label">H1 заголовок</label>
            <input name="brand-h1" type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" value="<?php echo $brands_kontent['h1']?>">
            <div id="emailHelp" class="form-text">*Нужен для поиска. Обязателен.</div>
        </div>
        <hr class="hr-info">
        <h2 class="col-lg-12 text-center">Дополнительная информация</h2>
        <div class="mb-3 w-100 form-field-admin">
            <label for="exampleInputEmail" class="form-label">Топ импортируемых</label>
            <textarea name="editor3" type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" ><?php echo $brands_kontent['autor']?></textarea>
            <div id="emailHelp" class="form-text">*рейтинг импортируемых моделей</div>
        </div>
        <hr class="hr-info">
        <div class="mb-3 w-100 form-field-admin">
            <label for="exampleInputEmail" class="form-label">Выгодные для продажи модели</label>
            <textarea name="editor4" type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"><?php echo $brands_kontent['country']?></textarea>
            <div id="emailHelp" class="form-text">*список из моделей, выгодных для растаможки.</div>
        </div>
        <hr class="hr-info">
        <div class="mb-3 w-50 form-field-admin">
            <label for="exampleInputEmail" class="form-label">Видео</label>
            <input name="brand-video" type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" value="<?php echo $brands_kontent['video']?>">
            <div id="emailHelp" class="form-text">*Укажите ID YouTube видео.</div>
        </div>

        <div class="mb-3 w-25 form-field-admin">
            <label for="exampleInputEmail" class="form-label">Лого (512х512px)</label>
            <select name="brand-img" id="exampleInputEmail" class=" form-select form-select-lg" aria-label=".form-select-lg example">
                <option value="<?php echo $brands_kontent['img_brands']?>"><?php echo $brands_kontent['img_brands']?></option>
                <?php
                foreach ($editor->scandir_img("../images/brands") as $img_brands=>$url_brands){
                ?>
                <option value="<?php echo $url_brands; ?>"><?php echo $url_brands; ?></option>
                <?php } ?>
            </select>
        </div>
        <hr class="hr-info">
        <h2 class="col-lg-12 text-center">История бренда</h2>
        <div class="mb-3 w-100 form-field-admin">
            <label for="exampleInputEmail" class="form-label">История бренда. На 1-2т знаков</label>
            <textarea name="editor1" type="text" class="form-control" id="editor1" aria-describedby="emailHelp" ><?php echo $brands_kontent['history_brands']?></textarea>
            <div id="emailHelp" class="form-text">*Основная информация о компании.</div>
        </div>
        <hr class="hr-info">
        <h2 class="col-lg-12 text-center">Как найти ошибки и неисправности</h2>
        <div class="mb-3 w-100 form-field-admin">
            <label for="exampleInputEmail" class="form-label">Чем искать ошибки. Где и т.д. На 1-2т знаков</label>
            <textarea name="editor2" type="text" class="form-control" id="editor2" aria-describedby="emailHelp"><?php echo $brands_kontent['error_brands']?></textarea>
            <div id="emailHelp" class="form-text">*Основная информация о том где и как находить ошибку.</div>
        </div>
<?php } ?>
        <div class="w-100">

    <button name="brand_update" type="submit" class="btn btn-primary">Обновить</button>
            <?php if (isset($_POST['brand_update'])){
                $editor->get_brand_update($_POST['brand-title'],$_POST['brand-description'],$_POST['brand-h1'],$_POST['brand-img'],$_POST['editor3'],$_POST['editor4'],$_POST['editor1'],$_POST['editor2'],$_POST['brand-video'],$_POST['brand-name'],$_GET['url']);?>
                <script type="text/javascript">
                    setTimeout(function(){
                        location = ''
                },100)
            </script>
         <?php   } ?>
    </div>
    </div>
</form>
</div>
<?php } ?>
</div>
</form>
    </div>

<footer>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace( 'editor1' );
        CKEDITOR.replace( 'editor2' );
        CKEDITOR.replace( 'editor3' );
        CKEDITOR.replace( 'editor4' );
    </script>
    <script src="<?php echo INDEX;?>/js/jquery-3.5.1.min.js"></script>
    <script src="<?php echo INDEX;?>/js/popper.min.js"></script>
    <script src="<?php echo INDEX;?>/js/bootstrap.min.js"></script>
</footer>
</body>
</html>