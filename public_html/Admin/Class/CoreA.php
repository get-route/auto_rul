<?php
require_once "./Config/config.php";
abstract class CoreA
{
    protected $db;



    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=" . DBNAME, USER, PASS);
        } catch (PDOException $e) {
            die('Подключение не удалось: ' . $e->getMessage());
        }
    }
    public function get_menu_admin(){ ?>
        <div class="col-lg-3 menu_admin">
            <img src="/images/config/logo.png" class=" col-lg-12 text-center menu_admin_img_logo">
            <div class="row">
                <div class="col-lg-6">
                    <a class="menu_admin_exit text-center" href="?destroy=on">Выход</a>
                </div>
                <div class="col-lg-6">
                    <a class="menu_admin_exit text-center" target="_blank" href="<?php echo INDEX;?>">Сайт</a>
                </div>
            </div>


            <div class="col-lg-12 text-center">
                <a class="btn btn-light" href="?class=Brands_Admin"><img src="/images/Admin/brand.png" class="menu_admin_img ">
                <h4 class="menu_admin_head">Бренды</h4></a>
            </div>
            <div class="col-lg-12 text-center">
                <a class="btn btn-light" href="?class=Comments_Admin"><img src="/images/Admin/comment.png" class="menu_admin_img ">
                    <h4 class="menu_admin_head">Комментарии</h4></a>
            </div>
            <div class="col-lg-12 text-center">
                <a class="btn btn-light" href="?class=Adv_Admin"><img src="/images/Admin/adv.png" class="menu_admin_img ">
                    <h4 class="menu_admin_head">Реклама</h4></a>
            </div>
            <div class="col-lg-12 text-center">
                <a class="btn btn-light" href="?class=Foto_Admin"><img src="/images/Admin/foto.png" class="menu_admin_img ">
                    <h4 class="menu_admin_head">Фото/Файлы</h4></a>
            </div>
        </div>
        <?php
    }
    public function get_admin(){
        $this->get_menu_admin();
    }

}