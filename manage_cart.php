<?php
session_start();
$cart = unserialize($_COOKIE['cart']);
if ($_POST['type'] === "add") {
	$cart[] = array(
		"product_id" => $_POST['product_id']
	);
	$serialized_cart = serialize($cart);
	setcookie("cart", $serialized_cart, time() + 86400);
} elseif ($_POST['type'] === "delete") {
	unset($cart[$_POST['cart_id']]);
	$serialized_cart = serialize($cart);
	setcookie("cart", $serialized_cart, time() + 86400);
}
$from = $_SERVER['HTTP_REFERER'];
header("Location: $from");
?>	