<?

include "db.inc.php";
include "lib.inc.php";

echo date ('d M Y');

?>
<?
$i=0;
for ($i <1000){
	
	$stmt= mysqli_stmt_init($link);
	$sql = 'INSERT INTO number (		num)
															
								VALUES (?)';
								mysqli_stmt_bind_param($stmt, "i", $i);
		mysqli_stmt_execute ($stmt);
	
$i++;	
}
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
