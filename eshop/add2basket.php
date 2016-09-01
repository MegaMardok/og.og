<?php
	// подключение библиотек
	require "inc/lib.inc.php";
	require "inc/db.inc.php";
	$id= $_GET['id'];
	$quantity=1;
	add2Bascet($id, $quantity);
	header('Location:catalog.php');
	exit;
	
?>