<?php
require_once "Class/Core.php";
require_once "Class/Index.php";
$footer=new Index();
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Код ошибки 404. Страница не найдена.">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="icon" href="/favicon.png" type="image/png">
    <title>Ошибка 404! Страница не найдена...</title>
    <meta name="robots" content="noindex">
</head>
<body class="body">
<?php
$footer->get_body();
?>
<div class="row">
    
    <div class="col-lg-12 img-404">
        <img src="/images/config/wall.webp">
    </div>
</div>



<footer>
    <?php $footer->get_footer(); ?>

</footer>
</body>
</html>