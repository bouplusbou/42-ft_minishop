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


function download_img($image_url) {
	$ch = curl_init($image_url);
	$path_parts = pathinfo($image_url);
	$parsed_url = parse_url($path_parts['basename']);
	$path_parts = pathinfo($parsed_url['path']);
	$path = "./resources/product_img/".$path_parts['filename'].".".$path_parts['extension'];
	$fp = fopen($path, 'wb');
	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_exec($ch);
	curl_close($ch);
	fclose($fp);
	return $path;
}

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