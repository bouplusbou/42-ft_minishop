<?php
session_start();
include 'inc/functions_user.php';

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