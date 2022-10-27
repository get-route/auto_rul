<?php


class Comments_Admin extends CoreA
{
    private $info_table_comments;
    private $approve_comment;
    private $delete_comment;

    public function get_kontent()
    {
        echo "Управление комментариями";
        $this->get_all_comments_table();
    }
    public function get_info_table_bd_comments(){
        $this->info_table_comments=$this->db->query("SELECT `id`,`comment`,`name`,`url_comment`,`public_comment` FROM comments");
        return $this->info_table_comments;
    }
    public function approve_comments($url){
        $this->approve_comment=$this->db->prepare("UPDATE `comments` SET `public_comment`='yes' WHERE id=:id");
        $this->approve_comment->execute(array('id'=>$url));
    }
    public function delete_comments($url){
        $this->delete_comment=$this->db->prepare("DELETE FROM `comments` WHERE id=:id");
        $this->delete_comment->execute(array('id'=>$url));
    }
    public function get_all_comments_table(){?>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <input type="text" class="form-control  models-search" id="search" placeholder="Поиск записи">
                    </div>
                </div>
                <div class="col-12">
                    <form method="post">
                    <table class="table-error table table-bordered table-striped table-Secondary table-responsive" id="mytable">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Имя</th>
                            <th scope="col">Комментарий</th>
                            <th scope="col">Одобрен (да/нет)</th>
                            <th scope="col">К записи</th>
                        </tr>
                        </thead>
                        <tbody>
        <?php
        $comments_table_db=new Comments_Admin();
        $num_comments=1;
        foreach ($comments_table_db->get_info_table_bd_comments() as $db_comments_table)
        {
            ?>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input name="<?php echo "brand".$num_comments?>"  type="checkbox" class="custom-control-input" id="<?php echo "customCheck".$num_comments ?>" value="<?php echo $db_comments_table['id']?>">
                                    <label class="custom-control-label" for="<?php echo "customCheck".$num_comments ?>"><?php echo $db_comments_table['id']?></label>
                                </div>
                            </td>
                            <td><?php echo $db_comments_table['name']?></td>
                            <td><?php echo $db_comments_table['comment']?></td>
                            <td><?php echo $db_comments_table['public_comment']?></td>
                            <td><?php echo $db_comments_table['url_comment']?></td>

                        </tr>
        <?php
        //одобрение поста
        if (($_GET['class']=='Comments_Admin')&& $_POST['yes-comment']=="Одобрить"){
        $comments_table_db->approve_comments($_POST['brand'.$num_comments]);?>
            <script type="text/javascript">
                setTimeout(function(){
                    location = ''
                },100)
            </script>
        <?php }
        //Удаление
        if (($_GET['class']=='Comments_Admin')&& $_POST['delete-comment']=="Удалить"){
        $comments_table_db->delete_comments($_POST['brand'.$num_comments]); ?>
            <script type="text/javascript">
                setTimeout(function(){
                    location = ''
                },100)
            </script>
            <?php }
            $num_comments++;
        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <button type="button" value="selectAll" class="main" onclick="checkAll()">Все</button>
            </div>
            <div class="col-lg-2">
                <button type="button" value="deselectAll" class="main" onclick="uncheckAll()">Отменить </button>
            </div>
            <div class="col-lg-8">
                <div class="dropdown">
                    <a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Действие
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="?class=Comments_Admin"><input value="Одобрить" type="submit" name="yes-comment"></a>
                        <a class="dropdown-item" href="?class=Comments_Admin"><input value="Удалить" type="submit" name="delete-comment"></a>
                    </div>
                </div>
            </div>
        </div>
        </form>
    <?php }
}