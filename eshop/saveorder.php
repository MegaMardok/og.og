<?php
	require "inc/lib.inc.php";
	require "inc/db.inc.php";
	$zak= $_POST['name'];
	$email= $_POST['email'];
	$phone= $_POST['phone'];
	$address= $_POST['address'];
	$cooka= unserialize(base64_decode($_COOKIE['bascet']));
	$idorder = $cooka['orderid'];
	$order = $zak."|". $email."|". $phone."|".$address."|". $idorder."|".time()."\n";;
	$path= "admin/".ORDERS_LOG;
file_put_contents ($path, $order, FILE_APPEND);
saveOrder($dt);
?>
<html>
<head>
	<title>Сохранение данных заказа</title>
</head>
<body>
	<p>Ваш заказ принят.</p>
	<p><a href="catalog.php">Вернуться в каталог товаров</a></p>
</body>
</html>



