<?php

namespace Admin;

require_once dirname(__DIR__)."/Admin/vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Cache extends \Core
{
    //Метод формирует файл хлс для всех моделей в таблицу.
    public function all_xlsx()
    {
        $count_error = 1;
        $spreadsheets = new Spreadsheet();
        $sheet = $spreadsheets->getActiveSheet();
        foreach ($this->get_all_errors() as $all_error) {

            $sheet->setCellValue('A' . $count_error, $all_error['brand_name']);
            $sheet->setCellValue('B' . $count_error, $all_error['name']);
            $sheet->setCellValue('C' . $count_error, $all_error['brand_url']);

            $count_error++;
        }
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheets, 'Xlsx');
        $writer->save('models.xlsx');
        $count_error = 1;
    }

//    public function all_brands(){
//        $all_brand = $this->db->query("SELECT url_brands FROM brands");
//        return $all_brand;
//    }
    public function get_all_errors(){
        $this->all_errors=$this->db->query("SELECT * FROM car_model");
        return $this->all_errors;
    }


    public static function read_cache_xml($filename)
    {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filename);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray(null, true, true, true);
        for ($str_exel = 1; $str_exel <= count(($sheet->toArray(null, true, true, true))); $str_exel++) {

            return $data;
        }
    }

}