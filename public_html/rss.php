<?php
header('Content-Type: text/xml; charset=utf-8');
require_once "Class/Core.php";
require_once "Class/Brands.php";
require_once "Class/Errors.php";
$url_str=INDEX."/";
$brands=new Brands();
$models=new Models();
$errors=new Errors();
echo '<?xml version="1.0"?>
          <rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/">
          <channel>
          <title>'.TITLE_RSS.'</title>
          <link>'.$url_str.'</link>
          <description>'.DESCR_RSS.'</description>
          <language>ru-ru</language>'

;
foreach ($brands->get_all_brands() as $all_brands)
//'..'
{
    echo '<item>
            <title>'.$all_brands['title'].'</title>
            <link>'.$url_str.$all_brands['url_brands'].'</link>
            <description>'.$all_brands['description'].'</description>
            <guid>'.$url_str.$all_brands['url_brands'].'</guid>
          <enclosure url="'.$url_str."images/brands/".$all_brands['img_brands'].'" type="image/png"/>
              <media:content type="image/png" medium="image" width="900" height="300"
url="'.$url_str."images/brands/".$all_brands['img_brands'].'">
        <media:description type="plain">
            '.$all_brands['title'].'
        </media:description>
        <media:copyright>Farn-Avto</media:copyright>
    </media:content>
          <image>
			<url>'.$url_str."images/brands/".$all_brands['img_brands'].'</url>
		</image>
         </item>';
        foreach ($errors->get_all_errors($all_models['brand_category']) as $all_errors) {

            echo '<item>
            <title>' . $all_errors['code_error']." - "."Расшифровка ошибки двигателя ".$all_models['uniq_lable'] . '</title>
            <link>' . $url_str .$all_brands['url_brands']."/".$all_models['url_models'] . "/" . $all_errors['url_errors'] . '</link>
            <description>' . "Варианты расшифровки ошибки ".$all_errors['code_error']." для модели ".$all_models['uniq_lable']." C ".$all_models['years_model']." года выпуска. Процедура сброса ошибки и причины на русском и английском языках если загорелся Check Engine." . '</description>
            <guid>' . $url_str .$all_brands['url_brands']."/".$all_models['url_models'] . "/" . $all_errors['url_errors'] . '</guid>
            <enclosure url="' . $url_str . "images/models/" . $all_models['img_model2'] . '" type="image/jpg"/>
              <media:content type="image/jpg" medium="image" width="900" height="300"
url="' . $url_str . "images/models/" . $all_models['img_model2'] . '">
        <media:description type="plain">
            '.$all_errors['code_error'].'
        </media:description>
        <media:copyright>Farn-Avto</media:copyright>
    </media:content>

          <image>
			<url>' . $url_str . "images/models/" . $all_models['img_model2'] . '</url>
		</image>
         </item>';
        }  }
echo '</channel>
   </rss>';
?>