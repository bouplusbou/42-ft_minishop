<?php
session_start();
$cart = unserialize($_COOKIE['cart']);

if ($_POST['add']) {
	$cart[] = ["product_id" => $_POST['product_id']];
}
$serialized_cart = serialize($cart);
setcookie("cart", $serialized_cart, time() + 86400);

$from = $_SERVER['HTTP_REFERER'];
header("Location: $from");
?>

