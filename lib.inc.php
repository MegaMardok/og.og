<?php
function addItemToCatalog($title, $author, $pubyear, $price)
{
	global $link;
$sql = 'INSERT INTO catalog (title, author, pubyear, price)
					VALUES (?,?,?,?)';	
if (!$stmt = mysqli_prepare($link, $sql))				
		return false;
mysqli_stmt_bind_param($stmt,'ssii', $title, $author,$pubyear, $price);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
return true;
};
function selectAllItems(){
	$sql = 'SELECT id, title, author, pubyear, price FROM catalog WHERE id<0 or id >0';
	global $link;
if (!$result= mysqli_query($link, $sql))
		return false;
$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
return $items;
};


function saveFio(){
	global $link, $stroka;
	
	
	if (file_exists('Stamp/stroki.txt')){
	$telo = file('Stamp/stroki.txt');

		
	
	
	
	
	$stmt= mysqli_stmt_init($link);
	$sql = 'INSERT INTO fio (		fio, 
															udostoverenie, 
															rsla, 
															oruzie, 
															dolznost, 
															pasport)
															
								VALUES (?,?,?,?,?,?)';
	if (!mysqli_stmt_prepare($stmt,$sql)){
		return false;
	}
	
foreach ($telo as $line){
	
	
/*	foreach ($telo as $line){
		list($dt, $page,$ref) = explode ('|', $line);
		
	*/	
		
		list($a0,$a1,$a2,$a3,$a4,$a5)= explode ('|', $line);
		mysqli_stmt_bind_param($stmt, "sissss", $a0, $a1, $a2, $a3, $a4, $a5);
		mysqli_stmt_execute ($stmt);
		#var_dump($stroka);
	echo "<br>";
	}
	mysqli_stmt_close($stmt);
	return true;
	}
	}
function plusNumber(){
	global $link;
	
	
	$sql = "SELECT num
								
							FROM number WHERE num IS NOT NULL ";
							
	if (!$result=mysqli_query($link, $sql)){
		echo "НЕ ИФ";
	return false; }
	$viborka = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$viborka =  count($viborka);
	#var_dump($viborka);
	mysqli_free_result($result);

	
	
	
	$stmt= mysqli_stmt_init($link);
	$sql = 'INSERT INTO number 		(num)
															
								VALUES (?)';
									if (!mysqli_stmt_prepare($stmt,$sql)){
										echo "ЖОПИЩА";
									}
								mysqli_stmt_bind_param($stmt, "i", $viborka);
		mysqli_stmt_execute ($stmt);
	return $viborka;

}
function fioSpisok(){
	global $link;
	$sql = "SELECT id,
								fio, 
								udostoverenie,
								rsla, 
								oruzie, 
								dolznost,
								pasport
							FROM fio WHERE fio IS NOT NULL";
							
	if (!$result=mysqli_query($link, $sql)){
		echo "НЕ ИФ";
	return false; }
	$foiOdin = mysqli_fetch_all($result, MYSQLI_ASSOC);
	#var_dump($foiOdin);
	mysqli_free_result($result);
	#$allfioSpisok[] = $foiOdin;
	#var_dump($orderinfo);
							
		
	return $foiOdin;
	#var_dump($items);
}
function viborka($date){
	global $link;
	global $arr;
	$vib1=$date;
#	var_dump($fioSingl['id']);
	$sql = "SELECT id,
								fio, 
								udostoverenie,
								rsla, 
								oruzie, 
								dolznost,
								pasport
							FROM fio WHERE id ='$vib1' ";
							
	if (!$result=mysqli_query($link, $sql)){
		echo "НЕ ИФ";
	return false; }
	$viborka = mysqli_fetch_all($result, MYSQLI_ASSOC);
	#var_dump($viborka);
	mysqli_free_result($result);
	#$allfioSpisok[] = $foiOdin;
	#var_dump($orderinfo);
							
		
	return $viborka;
}

function rdate($param, $time=0) {
 if(intval($time)==0)$time=time();
 $MonthNames=array("Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря");
 if(strpos($param,'M')===false) return date($param, $time);
  else return date(str_replace('M',$MonthNames[date('n',$time)-1],$param), $time);
}
function getOrders(){
	global $link;

	#if(!is_file(ORDERS_LOG))
#		return false;
	#$orders = file (ORDERS_LOG);
	#$allOrders = array();
		#foreach ($orders as $order){
			#list ($n, $e, $p, $a, $oid, $dt) = explode ("|", $order);
			#$orderInfo = array();
			#$orderInfo['name']= $n;
			#$orderInfo['email']= $e;
			#$orderInfo['phone']= $p;
			#$orderInfo['address']= $a;
			#$orderInfo['orderid']= $oid;
			#$orderInfo['dt']= $dt;
#			 $fio= $dt['fio'] ;
			#var_dump($fio);
			#var_dump($dt['fio']);
			$sql = "SELECT 
								fio, 
								udostoverenie,
								rsla, 
								oruzie, 
								dolznost,
								pasport
							FROM fio WHERE fio = '$fio'";
							
	if (!$result=mysqli_query($link, $sql)){
	return false; 
	echo "НЕ ИФ";}
	$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
	echo "ИФ";
	mysqli_free_result($result);
#	$orderInfo['goods'] = $items;
	#var_dump($orderinfo);
				#$allOrders[]= $orderInfo;				
		
	return $items;
	#var_dump($items);
}


#saveFio();