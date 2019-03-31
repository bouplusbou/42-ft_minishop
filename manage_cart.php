<?php
session_start();
$cart = unserialize($_COOKIE['cart']);

if ($_POST['add']) {
	$cart[] = ["product_id" => $_POST['product_id']];
} elseif ($_POST['delete']) {
	unset($cart[$_POST['product_id']]);
} elseif ($_POST['plus']) {
	var_dump($cart);
} elseif ($_POST['minus']) {
	var_dump($cart);
}
$serialized_cart = serialize($cart);
setcookie("cart", $serialized_cart, time() + 86400);

$from = $_SERVER['HTTP_REFERER'];
header("Location: $from");
?>

