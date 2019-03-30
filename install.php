<?php
if ($_SERVER['REQUEST_METHOD']) {
	header('HTTP/1.0 403 Forbidden');
	echo 'You are forbidden!';
	exit;
}
if (!file_exists("./database/")) {
	mkdir("./database/");
}
include 'inc/functions_user.php';

$categories = array(
		"Clothing",
		"Prints",
		"Sales",
);
$categories_serialized = serialize($categories);
file_put_contents("./database/categories", "$categories_serialized");


$images_url = array(
	"https://i.ibb.co/bdT15nH/1.jpg",
	"https://i.ibb.co/4m044CG/2.jpg",
	"https://i.ibb.co/0cXSCg1/3.jpg",
	"https://i.ibb.co/tcFbnvB/4.jpg",
	"https://i.ibb.co/RcVvC2J/5.jpg"
);
foreach ($images_url as $image_url) {
	download_img($image_url);
}

$products = array(
	array(
		"name" => "Lumbersexual",
		"price" => 200,
		"img" => "./resources/product_img/1.jpg",
		"categories" => array("Clothing", "Sales")
	),
	array(
		"name" => "Seitan",
		"price" => 100,
		"img" => "./resources/product_img/2.jpg",
		"categories" => array("Clothing")
	),
	array(
		"name" => "Normcore",
		"price" => 400,
		"img" => "./resources/product_img/3.jpg",
		"categories" => array("Clothing")
	),
	array(
		"name" => "Pok",
		"price" => 150,
		"img" => "./resources/product_img/4.jpg",
		"categories" => array("Prints", "Sales")
	),
	array(
		"name" => "Poutine",
		"price" => 320,
		"img" => "./resources/product_img/5.jpg",
		"categories" => array("Prints")
	)
);
$products_serialized = serialize($products);
file_put_contents("./database/products", "$products_serialized");

$users = array(
	"lol@google.com" => array(
		"passwd" => "lol@google.com",
		"cart" => "",
		"type" => "1"),
	"pop@google.com" => array(
		"passwd" => "pop@google.com",
		"cart" => "",
		"type" => "1"),

);
$users_serialized = serialize($users);
file_put_contents("./database/users", "$users_serialized");
// echo password_hash("lol@google.com", PASSWORD_BCRYPT);
// echo intval(password_verify("lol@google.com", password_hash("lol@google.co", PASSWORD_BCRYPT)));
?>