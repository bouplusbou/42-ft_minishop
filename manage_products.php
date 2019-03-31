<?php
session_start();
include 'inc/functions_user.php';

function create_product($name, $price, $img_url, $categories) {
	$products = get_products();
	$img_path = download_img("./resources/products_img/", $img_url);
	$product = array(
		"name" => $name,
		"price" => $price,
		"img" => $img_path,
		"categories" => $categories
	);
	$products[] = $product;
	$products_serialized = serialize($products);
	file_put_contents("./database/products", "$products_serialized", LOCK_EX);
}

function delete_product($product_id) {
	$products = get_products();
	unset($products[$product_id]);
	$serialized_products = serialize($products);
	file_put_contents("./database/products", "$serialized_products", LOCK_EX);
}

function update_product($product_id, $name, $price, $img_url, $categories) {
	if (!preg_match("~^./resources/products_img/~", $img_url)) {
		$img_url = download_img("./resources/products_img/", $img_url);
	}
	$products = get_products();
	$product = array(
		"name" => $name,
		"price" => $price,
		"img" => $img_url,
		"categories" => $categories
	);
	$products[$product_id] = $product;
	$products_serialized = serialize($products);
	file_put_contents("./database/products", "$products_serialized", LOCK_EX);
}


$products = get_products();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_POST['type'] === "create") {
		$categories[] = $_POST['category_0'];
		$categories[] = $_POST['category_1'];
		$categories[] = $_POST['category_2'];
		$categories = array_filter($categories);
		create_product($_POST['name'], $_POST['price'], $_POST['img_url'], $categories);
	} elseif ($_POST['type'] === "delete") {
		delete_product($_POST['product_id']);
	} elseif ($_POST['type'] === "update") {
		$categories[] = $_POST['category_0'];
		$categories[] = $_POST['category_1'];
		$categories[] = $_POST['category_2'];
		$categories = array_filter($categories);
		update_product($_POST['product_id'], $_POST['name'], $_POST['price'], $_POST['img_url'], $categories);
	}
}
$from = $_SERVER['HTTP_REFERER'];
header("Location: $from");
?>	