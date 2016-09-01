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
function saveBascet(){
	global $bascet ;
	$bascet = base64_encode(serialize($bascet));
	setcookie ('bascet', $bascet, 0x7FFFFFFF);
}
function bascetInit(){
	global $bascet, $count;
	if (!isset($_COOKIE['bascet'])){
		$bascet = array('orderid'=> uniqid());
		saveBascet();
	}else{
		
		$bascet = unserialize(base64_decode($_COOKIE['bascet']));
		if ($bascet['orderid']=="")
					$bascet = array('orderid'=> uniqid());
		$count = count($bascet)-1;
		}
	
}
function add2Bascet($id, $q){
	global $bascet;
	$bascet[$id]=$q;
	saveBascet();
}
function myBascet(){
	global $link, $bascet;
	$goods= array_keys($bascet);
	array_shift($goods);
if (count($goods))
	$ids= implode(",", $goods);
else $ids=0;
	$sql = "SELECT id, author, title, pubyear, price FROM catalog WHERE id IN ($ids)";
	if(!$result= mysqli_query($link, $sql)){
	return false;}
	$items= result2Array($result);
	mysqli_free_result($result);
	return $items;
}
function result2Array($data){
	global $bascet;
	$arr = array();
	while ($row= mysqli_fetch_assoc($data)){
		$row['quantity'] = $bascet[$row['id']];
		$arr[]= $row;
	}
	return $arr;
}
function deleteItemFromBascet($id){
	global $bascet;
	unset($bascet[$id]);
	saveBascet();
}
function saveOrder($dt){
	global $link, $bascet;
	$goods=myBascet();
	$stmt= mysqli_stmt_init($link);
	$sql = 'INSERT INTO orders (title, 
															author, 
															pubyear, 
															price, 
															quantity, 
															orderid, 
															datetime)
								VALUES (?,?,?,?,?,?,?)';
	if (!mysqli_stmt_prepare($stmt,$sql))
		return false;
	foreach($goods as $item){
		mysqli_stmt_bind_param($stmt, "ssiiisi", $item['title'], $item['author'], $item['pubyear'], $item['price'], $item['quantity'], $bascet['orderid'],$dt);
		mysqli_stmt_execute ($stmt);
	}
	mysqli_stmt_close($stmt);
	setcookie('bascet');
	return true;
}
function getOrders(){
	global $link;
	if(!is_file(ORDERS_LOG))
		return false;
	$orders = file (ORDERS_LOG);
	$allOrders = array();
		foreach ($orders as $order){
			list ($n, $e, $p, $a, $oid, $dt) = explode ("|", $order);
			$orderInfo = array();
			$orderInfo['name']= $n;
			$orderInfo['email']= $e;
			$orderInfo['phone']= $p;
			$orderInfo['address']= $a;
			$orderInfo['orderid']= $oid;
			$orderInfo['dt']= $dt;
			
			$sql = "SELECT 
								title, 
								author,
								pubyear, 
								price, 
								quantity
							FROM orders WHERE orderid = '$oid'";
	if (!$result=mysqli_query($link, $sql))
	return false; 
	$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	$orderInfo['goods'] = $items;
	#var_dump($orderinfo);
				$allOrders[]= $orderInfo;				
		}
	return $allOrders;
}