<?php
session_start();
if ($_COOKIE['cart'] !== "") {
	$cart = unserialize($_COOKIE['cart']);
}
$cart[] = array(
	"product_id" => $_POST['product_id']
);
$serialized_cart = serialize($cart);
$_COOKIE['cart'] = $serialized_cart;
$from = $_SERVER['HTTP_REFERER'];
header("Location: $from");
?>	