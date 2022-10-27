<?php
session_start();
require_once "Class/CoreA.php";
require_once "Class/InControl.php";
require_once "Config/config.php";
//При авторизации формируется хеш номер и записывается в куки. потом это все сравнивается с искомыми значениями логина и пароля из БД.
$in_control= new InControl();
$in_control->db_login();
$login_form=htmlspecialchars(md5(md5(md5($_POST['log_in']))));
$pass_form=htmlspecialchars(md5(md5(md5($_POST['pass_word']))));
if (($login_form===$in_control->authorization_login())&&($pass_form===$in_control->authorization_pass())){
    $in_control->random_byte_autoriz();
    header('Location:  panel_control.php ');
    setcookie("User",'Admin',time()+60*60*24*30);
    setcookie("Hash_User","$in_control->rand_byte",time()+60*60*24*30);
}else{ echo "Авторизация неудалась. Проверьте логин и пароль.";}
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
<body class="admin_body">

    <h2 class="text-center">Укажите данные логина и пароля:</h2>
    <div class="col-lg-12 form_in">
        <form action="" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Логин</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="log_in">
            <div id="emailHelp" class="form-text">Укажите логин администратора</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="pass_word">
        </div>
        <div class="mb-3 form-check">
        </div>
        <button name="in_control" type="submit" class="btn btn-primary">Войти</button>
    </form>
</div>

</body>
<footer>
    <script src="<?php echo INDEX;?>/js/jquery-3.5.1.min.js"></script>
    <script src="<?php echo INDEX;?>/js/popper.min.js"></script>
    <script src="<?php echo INDEX;?>/js/bootstrap.min.js"></script>
</footer>
</html>