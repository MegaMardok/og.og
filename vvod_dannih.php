<?
include "db.inc.php";
include "lib.inc.php";
$dat= rdate('d M Y');
require_once ('lib/classes/PHPExcel.php');
require_once ('lib/Classes/PHPExcel/IOFactory.php');
require_once ('lib/Classes/PHPExcel/Cell.php');
require_once ('lib/Classes/PHPExcel/Writer/Excel5.php');
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$predpisanie = plusNumber ();
	$arr = array();
$arr['zayavka']= $_POST['zayavka'];
$arr['zayavkaOt']= $_POST['zayavkaOt'];
$arr['otpr']= $_POST['otpr'];	
$arr['otpr_addr']= $_POST['otpr_addr'];	
$arr['poluch']= $_POST['poluch'];	
$arr['poluch_addr']= $_POST['poluch_addr'];
$arr['class']= $_POST['class'];	
$arr['mest']= $_POST['mest'];	
$arr['data_viezd']= $_POST['data_viezd'];	
$arr['km']= (int)$_POST['km'];	
$arr['sut']= $_POST['sut'];	
$arr['ats']= $_POST['ats'];		
$arr['fio']= $_POST['fio'];
$arr['fio_2']= $_POST['fio_2'];
$arr['client']= $_POST['client'];
$arr['mar']= $_POST['mar'];

#echo $arr['fio'];
#echo $arr['fio_2'];



}
	


?>
<form action='<?= $_SERVER['REQUEST_URI']?>' method='post'>
	<label>№ Заявки : </label><br />
		<input name='zayavka' type='text' size="50"/><br />
		<label>От какого числа заявка: </label><br />
		<input name='zayavkaOt' type='text' size="50"/><br />
		<label> Клиент: </label><br />

		<input name='otpr' type='text' size="50"/><br />
	<label>Адрес грузоотправителя: </label><br />
		<input name='otpr_addr' type='text' size="50"/><br />
	<label>Грузополучатель: </label><br />
		<input name='poluch' type='text' size="50"/><br />
	<label>Адрес грузополучателя: </label><br />
		<input name='poluch_addr' type='text' size="50"/><br />
	<label>Класс опасности: </label><br />
		<input name='class' type='text' size="50"/><br />
	<label>Количество мест: </label><br />
		<input name='mest' type='text' size="50"/><br />
	<label>Дата выезда из Новосибирска: </label><br />
		<input name='data_viezd' type='text' size="50"/><br />
	<label>Пробег: </label><br />
		<input name='km' type='text' size="50"/><br />
	<label>Суточные: </label><br />
		<input name='sut' type='text' size="50"/><br />
	<label>АТС: </label><br />
		<input name='ats' type='text' size="50"/><br />
	<label>Маршрут: </label><br />
		<input name='mar' type='text' size="50"/><br />

<?
$rez= fioSpisok(); #получаем фио список
#var_dump($rez);


	



?>
		
<br /><select name="fio">
<?
foreach ($rez as $fioSingl){
	$i =-1; 
	$i++;
	?>
	<option value=<?=$fioSingl['id']?>><?=$fioSingl['fio']?></option>;
<?

}
?></select><br />

<br /><select name="fio_2">
<?
foreach ($rez as $fioSingl){
	$i =-1; 
	$i++;
	?>
	<option value=<?=$fioSingl['id']?>><?=$fioSingl['fio']?></option>;
<?

}
?>
</select><br />

<br /><select name="client">
<option value="1">Политика</option>
<option value="2">Культура</option>
<option value="3">Спорт</option>
</select><br />

	
		<input type="submit" value="Зашеколадить молоко!">
</form>	

<?

#echo rdate('d.m.Y', $tre);



$rez=viborka($arr['fio']);
$rez2=viborka($arr['fio_2']);
#var_dump($rez2);
if (!($rez ==='false') and !($rez2==='false')){
	/*ПРИКАЗ*/
$xls= PHPExcel_IOFactory::load('Stamp/Prikaz.xlsx');
$xls->setActiveSheetIndex(0);
$xls->getActiveSheet()->setCellValue("B20","{$arr['zayavkaOt']}");
$xls->getActiveSheet()->setCellValue("A12","$dat"); 
$xls->getActiveSheet()->setCellValue("A25","{$arr['mar']}");
#$xls->getActiveSheet()->setCellValue("F28","{$rez[0]['dolznost']}");
$xls->getActiveSheet()->setCellValue("B29","{$rez[0]['fio']}");
$xls->getActiveSheet()->setCellValue("E30","{$rez2[0]['dolznost']}");
$xls->getActiveSheet()->setCellValue("B31","{$rez2[0]['fio']}");
$xls->getActiveSheet()->setCellValue("E45","$dat");
$xls->getActiveSheet()->setCellValue("E52","$dat");
$xls->getActiveSheet()->setCellValue("C58","{$rez[0]['fio']}");
$xls->getActiveSheet()->setCellValue("E58","{$rez[0]['dolznost']}");
$xls->getActiveSheet()->setCellValue("C59","{$rez2[0]['fio']}");
$xls->getActiveSheet()->setCellValue("E59","{$rez2[0]['dolznost']}");
$save = new PHPExcel_Writer_Excel5($xls);
$save->save('Prikaz_.xls');

/*Предписание_1*/


for ($dniTrue=0,$km=$arr['km']; $km >0;$dniTrue++){
$km = $km -540;	
}
$timeSS = strtotime($arr['data_viezd']);
$timeSE = strtotime($arr['data_viezd'])+ $dniTrue*86400;
$datV =date ( 'd.m.Y',$timeSS);
$datP= date ( 'd.m.Y',$timeSE) ; /*ДАТА ПРИЕЗДА РАСЧЕТ */

echo $timeSS .'<Br>';
echo "DNI EBAT";
echo $timeSE .'<Br>';
echo "DNI EBAT";
echo $dniTrue .'<Br>';
echo "DNI EBAT";

$xls= PHPExcel_IOFactory::load('Stamp/Predpisanie.xlsx');
$xls->setActiveSheetIndex(0);
$xls->getActiveSheet()->setCellValue("H9","{$rez[0]['fio']}");
$xls->getActiveSheet()->setCellValue("B9","{$rez[0]['dolznost']}");
$xls->getActiveSheet()->setCellValue("B13","{$arr['mar']}");
$xls->getActiveSheet()->setCellValue("G16","{$rez[0]['oruzie']}");
$xls->getActiveSheet()->setCellValue("H17","{$rez[0]['rsla']}");
$xls->getActiveSheet()->setCellValue("I20",$datV);
$xls->getActiveSheet()->setCellValue("I21",$datP);
$xls->getActiveSheet()->setCellValue("I7",$predpisanie);
$xls->getActiveSheet()->setCellValue("K23","{$rez[0]['udostoverenie']}");
$save = new PHPExcel_Writer_Excel5($xls);
$save->save('Predpisanie_1.xls');
/*Предписание_2*/
$xls= PHPExcel_IOFactory::load('Stamp/Predpisanie.xlsx');
$xls->setActiveSheetIndex(0);
$xls->getActiveSheet()->setCellValue("H9","{$rez2[0]['fio']}");
$xls->getActiveSheet()->setCellValue("B9","{$rez2[0]['dolznost']}");
$xls->getActiveSheet()->setCellValue("B13","{$arr['mar']}");
$xls->getActiveSheet()->setCellValue("G16","{$rez2[0]['oruzie']}");
$xls->getActiveSheet()->setCellValue("H17","{$rez2[0]['rsla']}");
$xls->getActiveSheet()->setCellValue("I20","$datV");
$xls->getActiveSheet()->setCellValue("I21","$datP");
$xls->getActiveSheet()->setCellValue("I7","$predpisanie");
$xls->getActiveSheet()->setCellValue("K23","{$rez2[0]['udostoverenie']}");
$save = new PHPExcel_Writer_Excel5($xls);
$save->save('Predpisanie_2.xls');
/*Служебная записка*/
$zayavka = $arr['zayavka'].'от ' .$arr['zayavkaOt']. '., договор'  /*ДОГОВОР*/     . '.,' .$arr['client']
. 'на доставку "опасного груза", класс опасности' .$arr['class'] . ', количество ' .$arr['mest'];

$xls= PHPExcel_IOFactory::load('Stamp/Sl_zapiska.xlsx');
$xls->setActiveSheetIndex(0);
$xls->getActiveSheet()->setCellValue("B8","$zayavka");
$xls->getActiveSheet()->setCellValue("C10","{$arr['otpr']}");
$xls->getActiveSheet()->setCellValue("C11","{$arr['poluch']}");
$xls->getActiveSheet()->setCellValue("B14","{$arr['mar']}");
$xls->getActiveSheet()->setCellValue("B16","{$arr['km']}");
$dni =$arr['km']/540;/*дни рассчет*/
$xls->getActiveSheet()->setCellValue("E17","$dniTrue");
$xls->getActiveSheet()->setCellValue("B18","{$arr['sut']}");
$xls->getActiveSheet()->setCellValue("C23","{$arr['ats']}");
$xls->getActiveSheet()->setCellValue("A24","{$rez[0]['dolznost']}");
$xls->getActiveSheet()->setCellValue("A25","{$rez[0]['fio']}");
$xls->getActiveSheet()->setCellValue("B26","{$rez[0]['pasport']}");
$xls->getActiveSheet()->setCellValue("D29","{$rez[0]['udostoverenie']}");
$xls->getActiveSheet()->setCellValue("B30","{$rez[0]['oruzie']}");
$xls->getActiveSheet()->setCellValue("C31","{$rez[0]['rsla']}");
/*Старшой*/
$xls->getActiveSheet()->setCellValue("C33","{$rez2[0]['dolznost']}");
$xls->getActiveSheet()->setCellValue("A35","{$rez2[0]['fio']}");
$xls->getActiveSheet()->setCellValue("B36","{$rez2[0]['pasport']}");
$xls->getActiveSheet()->setCellValue("D39","{$rez2[0]['udostoverenie']}");
$xls->getActiveSheet()->setCellValue("B40","{$rez2[0]['oruzie']}");
$xls->getActiveSheet()->setCellValue("C41","{$rez2[0]['rsla']}");
$xls->getActiveSheet()->setCellValue("G46","$datV");
$xls->getActiveSheet()->setCellValue("G47","$datP");
$save = new PHPExcel_Writer_Excel5($xls);
$save->save('Sl_zapiska.xls');
}

?>


