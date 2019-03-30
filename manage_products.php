<?php
session_start();
include 'inc/functions_user.php';
$products = get_products();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_POST['type'] === "create") {
		$img_path = download_img($_POST['img_url']);
		if ($_POST['categories']) {
			$categories = explode(",", $_POST['categories']);
			foreach ($categories as $key => $category) {
				if (!in_array($category, get_categories())) {
					unset($categories[$key]);
				}
			}
		}
		$product = array(
			"name" => $_POST['name'],
			"price" => $_POST['price'],
			"img" => $img_path,
			"categories" => $categories
		);
		$products[] = $product;
		$products_serialized = serialize($products);
		file_put_contents("./database/products", "$products_serialized", LOCK_EX);
	} elseif ($_POST['type'] === "delete") {
		unset($products[$_POST['product_id']]);
		$serialized_products = serialize($products);
		file_put_contents("./database/products", "$serialized_products", LOCK_EX);
	} elseif ($_POST['type'] === "update") {

		print_r($_POST);



		if ($_POST['categories']) {
			$categories = explode(",", $_POST['categories']);
			foreach ($categories as $key => $category) {
				if (!in_array($category, get_categories())) {
					unset($categories[$key]);
				}
			}
		}
		if ($_POST['img_url']) {
			$img_path = download_img($_POST['img_url']);
		}
		$product = $products[$_POST['product_id']];
		$product = array(
			"name" => $_POST['name'] ? $_POST['name'] : $product['name'],
			"price" => $_POST['price'] ? $_POST['price'] : $product['price'],
			"img" => $_POST['img_url'] ? $img_path : $product['img'],
			"categories" => $_POST['categories'] ? $categories : $product['categories']
		);
		$products[$_POST['product_id']] = $product;
		$products_serialized = serialize($products);
		file_put_contents("./database/products", "$products_serialized", LOCK_EX);
	}
}
$from = $_SERVER['HTTP_REFERER'];
header("Location: $from");
?>	