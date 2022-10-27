<?php
header('Content-Type: application/xml; charset=utf-8');
require_once "Class/Core.php";
require_once "Class/Brands.php";
require_once "Class/CoreModel.php";
$url_str = INDEX . "/";
$brands = new Brands();
$models = new CoreModel();
echo "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">";


//Очистка папки перед формированием sitemap.
$directory_delete = scandir("map");
$directory_delete=array_slice($directory_delete,2);
foreach ($directory_delete as $error_xml){
    if ($error_xml){

        echo "<url>" . "\n";
        echo "<loc>" . $url_str . "map/".$error_xml . "</loc>" . "\n";
        echo "<changefreq>always</changefreq>" . "\n";
        echo "<priority>0.8</priority>" . "\n";
        echo "</url>" . "\n";
    }
}
for ($del = 2; $del <= count($directory_delete); $del++) {
    if ((!empty($directory_delete[$del]))) {
        unlink("map/" . $directory_delete[$del]);

    }
    continue;
}
//Карта для брендов. Пришлось повелосипедить, но на проде иначе никак нельзя было
$brand_xml = new DOMDocument('1.0', 'utf-8');
$urlset = $brand_xml->createElement('urlset');
$urlset->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
foreach ($brands->get_all_brands() as $all_brand_xml) {

    $url = $brand_xml->createElement('url');
    $loc = $brand_xml->createElement('loc');
    $text = $brand_xml->createTextNode(
        htmlentities($url_str . $all_brand_xml['url_brands'], ENT_QUOTES)
    );
    $loc->appendChild($text);
    $url->appendChild($loc);

    $priority = $brand_xml->createElement('priority');
    $text = $brand_xml->createTextNode(0.7);
    $priority->appendChild($text);
    $url->appendChild($priority);

    $urlset->appendChild($url);

    $brand_xml->appendChild($urlset);

}
$brand_xml->save("map/sitemap-brand.xml");


//Формирование карты с ошибками
foreach ($brands->get_all_brands() as $all_brands) {
    ?>
    <?php
    foreach ($models->all_models() as $all_models) {
        $array_model[] = $url_str.$all_brands['url_brands']."/".$all_models["brand_url"];

    }


    //шаг
    $go_num = 3000;
//Макс знач
    //мин знач
    $page_max = 3000;
    $page_min = 0;
    if (is_array($array_model)) {
        $count = intval((count($array_model) / 3000) + 1);

    }

    for ($sitemap = 1; $sitemap <= $count; $sitemap++) {

        $dom = new DOMDocument('1.0', 'utf-8');
        $urlset = $dom->createElement('urlset');
        $urlset->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        for ($i = $page_min; $i <= $page_max; $i++) {
            if (!empty($array_model[$i])) {
                $url = $dom->createElement('url');
                $loc = $dom->createElement('loc');
                $text = $dom->createTextNode(
                    htmlentities("$array_model[$i]", ENT_QUOTES)
                );
                $loc->appendChild($text);
                $url->appendChild($loc);

                $priority = $dom->createElement('priority');
                $text = $dom->createTextNode(0.7);
                $priority->appendChild($text);
                $url->appendChild($priority);

                $urlset->appendChild($url);


            }


        }
        $dom->appendChild($urlset);

        $dom->save("map/sitemap-model" . $sitemap . ".xml");


        $page_min = $page_max;
        $page_max = $page_max + $go_num;

    }

}


?>
<?php echo "</urlset>"; ?>