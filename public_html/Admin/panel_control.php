<?php
session_start();
require_once "Class/CoreA.php";
require_once "Class/InControl.php";
require_once "Config/config.php";
require_once __DIR__."/vendor/autoload.php";
$classes=$_GET['class'];
spl_autoload_register(function ($classes) {
    include "Class/".$classes . ".php";
});
$hash=new InControl();
$hash->db_login();
$hash->authorization_hash()->hash_numb;
//Если куки не равны искомому значению из БД, то редирект на 404. Если нажата кнопка выхода, то удаляем сессию и переназначаем куки, опять вылетая на авторизацию
if (($_COOKIE['User']!=='Admin')&& ($hash->hash_numb!==$_COOKIE['Hash_User'])){
    http_response_code(404);
    header('Location:  ../404.php ');
    exit();
}else if ($_GET['destroy'] == 'on') {
    session_destroy();
    setcookie('User', '');
    setcookie('Hash_User', '');
    header('Location:  in-login.php');
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
    <title>Форма входа на сайт</title>
</head>
<body>
<div class="container">
    <div class="row">
        <?php
        $menu_admin=new InControl();
        $menu_admin->get_menu_admin();
        ?>
        <div class="col-lg-9 form_admin">
            <?php
            if (($_GET['class']==true)) {
                $clas = new $classes();
                $clas->get_kontent();
            } else{
                echo "Тут будет общая инфа о сайте";
            } ?>
        </div>
    </div>
</div>


</body>
<footer>
    <script src="<?php echo INDEX;?>/js/jquery-3.5.1.min.js"></script>
    <script src="<?php echo INDEX;?>/js/popper.min.js"></script>
    <script src="<?php echo INDEX;?>/js/bootstrap.min.js"></script>
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
        // Select all check boxes : Setting the checked property to true in checkAll() function
        function checkAll(){
            var items = document.getElementsByClassName('custom-control-input');
            for (var i = 0; i < items.length; i++) {
                if (items[i].type == 'checkbox')
                    items[i].checked = true;
            }
        }
        // Clear all check boxes : Setting the checked property to false in uncheckAll() function
        function uncheckAll(){
            var items = document.getElementsByClassName('custom-control-input');
            for (var i = 0; i < items.length; i++) {
                if (items[i].type == 'checkbox')
                    items[i].checked = false;
            }
        }
    </script>
</footer>
</html>