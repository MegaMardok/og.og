<?php
	// подключение библиотек
	require "inc/lib.inc.php";
	require "inc/db.inc.php";
	$id= $_GET['id'];
	deleteItemFromBascet($id);
	header("Location: basket.php");
	exit;
	
?>