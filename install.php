<?php
if ($_SERVER['REQUEST_METHOD']) {
	header('HTTP/1.0 403 Forbidden');
	echo 'You are forbidden!';
	exit;
}
if (!file_exists("./database/")) {
	mkdir("./database/");
}

$categories = array(
		"Clothing",
		"Wood",
		"Potery",
		"Totebag",
		"Papercuts"
);
$categories_serialized = serialize($categories);
file_put_contents("./database/categories", "$categories_serialized");

$products = array(
	array(
		"name" => "Lumbersexual",
		"price" => 200,
		"img" => "./resources/product_img/1.jpg",
		"categories" => array("Clothing")
	),
	array(
		"name" => "Seitan",
		"price" => 100,
		"img" => "./resources/product_img/2.jpg",
		"categories" => array("Wood")
	),
	array(
		"name" => "Normcore",
		"price" => 400,
		"img" => "./resources/product_img/3.jpg",
		"categories" => array("Potery")
	),
	array(
		"name" => "Pok",
		"price" => 150,
		"img" => "./resources/product_img/4.jpg",
		"categories" => array("Totebag")
	),
	array(
		"name" => "Poutine",
		"price" => 320,
		"img" => "./resources/product_img/5.jpg",
		"categories" => array("Papercuts")
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