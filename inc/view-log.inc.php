<?
if (file_exists(PATH_LOG)){
	$telo = file(PATH_LOG);
	foreach ($telo as $line){
		list($dt, $page,$ref) = explode ('|', $line);
		echo <<<LINE
		<li>
		$dt: $ref ----> $page
		</li>
		 
LINE;
	}

	
	
#	$r=explode ('|', $line);
	#var_dump($r);
	

}
