<?
$vizitCounter=0;
if(isset($_COOKIE['vizitCounter'])) #isset нужен ли ?
	$vizitCounter= $_COOKIE['vizitCounter'];	
$vizitCounter++;	
$lastVizit ='';
if(isset($_COOKIE['vizitCounter'])) #isset нужен ли ?
	$lastVizit= date('d-m-Y H:i:s' ,$_COOKIE['lastVizit']);	
	if(date('d-m-Y')!=date('d-m-Y' ,$_COOKIE['lastVizit'])){
	setcookie('vizitCounter',$vizitCounter,0x7FFFFFFF);
	setcookie('lastVizit',time(),0x7FFFFFFF);}