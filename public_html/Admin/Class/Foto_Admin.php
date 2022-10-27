<?php


class Foto_Admin extends CoreA
{
    //Выводим контент на странице
    public function get_kontent()
    {

        $this->get_donwload_photo();
        $this->get_read_files();
    }
    //Получение списка фото для указанного урла каталога. Нужно для выбора картинки в админке.
    public function scandir_img($url){
        $this->img_post=scandir($url);
        return $this->img_post;
    }
    //Загрузка фото в нужный нам раздел
    public function get_donwload_photo(){?>
        <hr class="hr-info">
        <form action="" method="post" enctype="multipart/form-data">
        <select name="img_directory">
            <option>Загрузить В...:</option>
            <?php foreach ($this->scandir_img("../images") as $img_directory) {
                ?>
                <option value="<?php echo $img_directory?>" ><?php echo $img_directory ?></option>
            <?php } ?>
            <input type="file" name="file[]" multiple>
            <input type="submit" value="Отправить">
        </select>
        </form>

    <?php
        // Название <input type="file">
        $input_name = 'file';

// Разрешенные расширения файлов.
        $allow = array('png', 'jpg', 'jpeg', 'mp4', 'webm', 'ogg', 'webp');

// Запрещенные расширения файлов.
        $deny = array(
            'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp',
            'aspx', 'shtml', 'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'js', 'html',
            'htm', 'css', 'sql', 'spl', 'scgi', 'fcgi'
        );

// Директория куда будут загружаться файлы.
        $path ="../images/".$_POST['img_directory']."/";

        if (isset($_FILES[$input_name])) {
            // Проверим директорию для загрузки.
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            // Преобразуем массив $_FILES в удобный вид для перебора в foreach.
            $files = array();
            $diff = count($_FILES[$input_name]) - count($_FILES[$input_name], COUNT_RECURSIVE);
            if ($diff == 0) {
                $files = array($_FILES[$input_name]);
            } else {
                foreach($_FILES[$input_name] as $k => $l) {
                    foreach($l as $i => $v) {
                        $files[$i][$k] = $v;
                    }
                }
            }

            foreach ($files as $file) {
                $error = $success = '';

                // Проверим на ошибки загрузки.
                if (!empty($file['error']) || empty($file['tmp_name'])) {
                    switch (@$file['error']) {
                        case 1:
                        case 2: $error = 'Превышен размер загружаемого файла.'; break;
                        case 3: $error = 'Файл был получен только частично.'; break;
                        case 4: $error = 'Файл не был загружен.'; break;
                        case 6: $error = 'Файл не загружен - отсутствует временная директория.'; break;
                        case 7: $error = 'Не удалось записать файл на диск.'; break;
                        case 8: $error = 'PHP-расширение остановило загрузку файла.'; break;
                        case 9: $error = 'Файл не был загружен - директория не существует.'; break;
                        case 10: $error = 'Превышен максимально допустимый размер файла.'; break;
                        case 11: $error = 'Данный тип файла запрещен.'; break;
                        case 12: $error = 'Ошибка при копировании файла.'; break;
                        default: $error = 'Файл не был загружен - неизвестная ошибка.'; break;
                    }
                } elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])) {
                    $error = 'Не удалось загрузить файл.';
                } else {
                    // Оставляем в имени файла только буквы, цифры и некоторые символы.
                    $pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
                    $name = mb_eregi_replace($pattern, '-', $file['name']);
                    $name = mb_ereg_replace('[-]+', '-', $name);

                    // Т.к. есть проблема с кириллицей в названиях файлов (файлы становятся недоступны).
                    // Сделаем их транслит:
                    $converter = array(
                        'а' => 'a',   'б' => 'b',   'в' => 'v',    'г' => 'g',   'д' => 'd',   'е' => 'e',
                        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',    'и' => 'i',   'й' => 'y',   'к' => 'k',
                        'л' => 'l',   'м' => 'm',   'н' => 'n',    'о' => 'o',   'п' => 'p',   'р' => 'r',
                        'с' => 's',   'т' => 't',   'у' => 'u',    'ф' => 'f',   'х' => 'h',   'ц' => 'c',
                        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',  'ь' => '',    'ы' => 'y',   'ъ' => '',
                        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

                        'А' => 'A',   'Б' => 'B',   'В' => 'V',    'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
                        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',    'И' => 'I',   'Й' => 'Y',   'К' => 'K',
                        'Л' => 'L',   'М' => 'M',   'Н' => 'N',    'О' => 'O',   'П' => 'P',   'Р' => 'R',
                        'С' => 'S',   'Т' => 'T',   'У' => 'U',    'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
                        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',  'Ь' => '',    'Ы' => 'Y',   'Ъ' => '',
                        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
                    );

                    $name = strtr($name, $converter);
                    $parts = pathinfo($name);

                    if (empty($name) || empty($parts['extension'])) {
                        $error = 'Недопустимое тип файла';
                    } elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
                        $error = 'Недопустимый тип файла';
                    } elseif (!empty($deny) && in_array(strtolower($parts['extension']), $deny)) {
                        $error = 'Недопустимый тип файла';
                    } else {
                        // Чтобы не затереть файл с таким же названием, добавим префикс.
                        $i = 0;
                        $prefix = '';
                        while (is_file($path . $parts['filename'] . $prefix . '.' . $parts['extension'])) {
                            $prefix = '(' . ++$i . ')';
                        }
                        $name = $parts['filename'] . $prefix . '.' . $parts['extension'];

                        // Перемещаем файл в директорию.
                        if (move_uploaded_file($file['tmp_name'], $path . $name)) {
                            // Далее можно сохранить название файла в БД и т.п.
                            $success = 'Файл «' . $name . '» успешно загружен.' . ' в ' . $path;
                        } else {
                            $error = 'Не удалось загрузить файл.';
                        }
                    }
                }

                // Выводим сообщение о результате загрузки.
                if (!empty($success)) {
                    echo '<p>' . $success . '</p>';
                } else {
                    echo '<p>' . $error . '</p>';
                }
            }
        }

    }
    //Удаление файлов. Чтение в таблице
    public function get_read_files(){?>
        <hr class="hr-info">
        <div class="container">
            <div class="row">
        <?php foreach ($this->scandir_img("../images") as $dir) {
            if (($dir==".") || ($dir=="..")){
                continue;
            }
            ?>
            <div class="col-lg-6">
                    <h3 class="text-left"><?php echo $dir;?></h3>
                </div>
            <?php foreach ($this->scandir_img("../images/".$dir) as $dir_file){
                if (($dir_file==".") || ($dir_file=="..")){
                    continue;
                }
                ?>
                <div class="col-lg-12 files_admin">
                    <div class="row">
                    <div class="col-lg-5 text-left">
                        <a target="_blank" href="<?php echo INDEX."/images/".$dir."/".$dir_file;?>"><?php echo "---".$dir_file ?> <img src="<?php echo "/images/".$dir."/".$dir_file;?>"> </a>
                    </div>
                    <div class="col-lg-7">
                        <a href="/Admin/panel_control.php?class=Foto_Admin&delete-foto=<?php echo $dir_file;?>"><img class="files_admin_delete" src="/images/config/delete.png" alt="Удалить"></a>
                    </div>
                    </div>

                </div>
            <?php
            if (($_GET['delete-foto']===$dir_file)){
                unlink('../images/'.$dir."/".$dir_file);?>
            <script>
                window.location.assign('./panel_control.php?class=Foto_Admin');
            </script>
            <?php }
            } } ?>
            </div>
        </div>

    <?php }
}