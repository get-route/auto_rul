<?php


class Adv_Admin extends CoreA
{
    protected $adv_read_bd;
    protected $get_update_adv;

    public function read_adv_bd(){
        $this->adv_read_bd=$this->db->query("SELECT * FROM adv_code WHERE id=1");
        return $this->adv_read_bd;
    }
    public function get_update_adv_bd($footer_advcode,$h1adv_brands, $historyadv_brands, $erroradv_brands, $erroradv_h1, $erroradv_reset){
        $this->get_update_adv=$this->db->prepare("UPDATE `adv_code` SET `footer_advcode`=:footer_advcode,`h1adv_brands`=:h1adv_brands,`historyadv_brands`=:historyadv_brands,`erroradv_brands`=:erroradv_brands,`erroradv_h1`=:erroradv_h1,`erroradv_reset`=:erroradv_reset WHERE `id`=1 ");
        $this->get_update_adv->execute(array('footer_advcode'=>$footer_advcode, 'h1adv_brands'=>$h1adv_brands, 'historyadv_brands'=>$historyadv_brands, 'erroradv_brands'=>$erroradv_brands, 'erroradv_h1'=>$erroradv_h1,'erroradv_reset'=>$erroradv_reset));
    }
    public function get_kontent()
    {
        $this->form_add_adv_site();
    }
    public function form_add_adv_site (){
        foreach ($this->read_adv_bd() as $adv_blok){
        ?>
        <div class="container">
            <h2 class="col-lg-12 text-center"> Управление рекламными блоками</h2>
            <hr class="hr-info">
        <form method="post">
            <div class="row">
                <h3 class="col-lg-12 text-center">Блок №1</h3>
            <div class="w-75 form-field-admin">
                <textarea rows="8" name="h1adv_brands" type="text" class="form-control" id="editor11" aria-describedby="emailHelp" ><?php echo $adv_blok['h1adv_brands']?></textarea>
                <div id="emailHelp" class="form-text">*Под заголовком в БРЕНДАХ. <a class="btn-secondary" href="/images/config/block1.jpg" target="_blank">Это где?</a> </div>
            </div>
                <hr class="hr-info">
                <h3 class="col-lg-12 text-center">Блок №2</h3>
                <div class="w-75 form-field-admin">
                    <textarea rows="8" name="historyadv_brands" type="text" class="form-control" id="editor11" aria-describedby="emailHelp" ><?php echo $adv_blok['historyadv_brands']?></textarea>
                    <div id="emailHelp" class="form-text">*В середине в БРЕНДАХ. <a class="btn-secondary" href="/images/config/block2.jpg" target="_blank">Это где?</a> </div>
                </div>
                <hr class="hr-info">
                <h3 class="col-lg-12 text-center">Блок №3</h3>
                <div class="w-75 form-field-admin">
                    <textarea rows="8" name="erroradv_brands" type="text" class="form-control" id="editor11" aria-describedby="emailHelp" ><?php echo $adv_blok['erroradv_brands']?></textarea>
                    <div id="emailHelp" class="form-text">*В блоке ошибок в БРЕНДАХ. <a class="btn-secondary" href="/images/config/block3.jpg" target="_blank">Это где?</a> </div>
                </div>

            <hr class="hr-info">
            <h3 class="col-lg-12 text-center">Блок №4</h3>
            <div class="w-75 form-field-admin">
                <textarea rows="8" name="erroradv_h1" type="text" class="form-control" id="editor11" aria-describedby="emailHelp" ><?php echo $adv_blok['erroradv_h1']?></textarea>
                <div id="emailHelp" class="form-text">*Под заголовком в ОШИБКАХ. <a class="btn-secondary" href="/images/config/block7.jpg" target="_blank">Это где?</a> </div>
            </div>
            <hr class="hr-info">
            <h3 class="col-lg-12 text-center">Блок №5</h3>
            <div class="w-75 form-field-admin">
                <textarea rows="8" name="erroradv_reset" type="text" class="form-control" id="editor11" aria-describedby="emailHelp" ><?php echo $adv_blok['erroradv_reset']?></textarea>
                <div id="emailHelp" class="form-text">*В ошибках по заголовком где можно сбросить. <a class="btn-secondary" href="/images/config/block8.jpg" target="_blank">Это где?</a> </div>
            </div>
            <hr class="hr-info">
            <h3 class="col-lg-12 text-center">Блок №6.Футер</h3>
            <div class="w-75 form-field-admin">
                <textarea rows="8" name="footer_advcode" type="text" class="form-control" id="editor11" aria-describedby="emailHelp" ><?php echo $adv_blok['footer_advcode']?></textarea>
                <div id="emailHelp" class="form-text">*Подвал сайта. Для счетчиков. <a class="btn-secondary" href="/images/config/block9.jpg" target="_blank">Это где?</a> </div>
            </div>
            <div class="w-100">
                <button name="adv_add" type="submit" class="btn btn-primary">Обновить</button>
                <?php
                if (isset($_POST['adv_add'])){
                    $this->get_update_adv_bd($_POST['footer_advcode'],$_POST['h1adv_brands'],$_POST['historyadv_brands'],$_POST['erroradv_brands'],$_POST['erroradv_h1'],$_POST['erroradv_reset']);
                ?>
                    <script type="text/javascript">
                        setTimeout(function(){
                            location = ''
                        },100)
                    </script>
                <?php
                }
                ?>
            </div>
        </div>
        </form>
        </div>
    <?php } }
}