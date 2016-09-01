<?
$result=0;
if (isset($_SESSION['test'])){
$answers= parse_ini_file("answers.ini");	
foreach ($_SESSION['test'] as $value){
	if (array_key_exists($value, $answers))
		$result +=(int)$answers[$value];
}
session_destroy();
}?>
<table width="100%">
	<tr>
		<td align="left">
		
		</td>
	</tr>
	<p>Ваш рещультат: <?=$result?> из 30</p>
</table>