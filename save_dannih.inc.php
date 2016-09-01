<?
#include "db.inc.php";
#include "lib.inc.php";
$arr = array();
$arr['zayavka']= $_POST['zayavka'];
$arr['otpr']= $_POST['otpr'];	
$arr['otpr_addr']= $_POST['otpr_addr'];	
$arr['poluch']= $_POST['poluch'];	
$arr['poluch_addr']= $_POST['poluch_addr'];
$arr['class']= $_POST['class'];	
$arr['mest']= $_POST['mest'];	
$arr['data_viezd']= $_POST['data_viezd'];	
$arr['km']= $_POST['km'];	
$arr['sut']= $_POST['sut'];	
$arr['ats']= $_POST['ats'];		
$arr['fio']= $_POST['fio'];
$arr['fio_2']= $_POST['fio_2'];
$arr['client']= $_POST['client'];

#var_dump($arr);
require_once ('lib/classes/PHPExcel.php');
require_once ('lib/Classes/PHPExcel/IOFactory.php');
require_once ('lib/Classes/PHPExcel/Cell.php');
require_once ('lib/Classes/PHPExcel/Writer/Excel5.php');

$xls= PHPExcel_IOFactory::load('Stamp/Prikaz.xlsx');
$xls->setActiveSheetIndex(0);
$qwer=$xls->getActiveSheet();
$qwer->setCellValue("B4",'Жопа');

#$xls= new PHPExcel();
#$xls->setActiveSheetIndex(0);
#$sheet= $xls->getActiveIndex();
#$cell = new PHPExcel_Cell($xls);

$save = new PHPExcel_Writer_Excel5($xls);
$save->save('SAVE.xls');





#<input type='submit' value='Отправить' />
# header ("location: http://og.og/vvod_dannih.php");