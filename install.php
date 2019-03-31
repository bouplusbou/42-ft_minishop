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
		"PRINTS",
		"PAPERCUTS",
		"SALES",
);
$categories_serialized = serialize($categories);
file_put_contents("./database/categories", "$categories_serialized");


$images_url = array(
	"https://i.ibb.co/w0z8bRZ/1.jpg",
	"https://i.ibb.co/q0kY0NP/2.jpg",
	"https://i.ibb.co/H2Bdh43/3.jpg",
	"https://i.ibb.co/cTfXhyR/4.jpg",
	"https://i.ibb.co/dGZNyPD/5.jpg",
	"https://i.ibb.co/CHLJQ85/6.jpg",
	"https://i.ibb.co/3fkWWb9/7.jpg",
	"https://i.ibb.co/Xzn3C7r/8.jpg",
	"https://i.ibb.co/JxPnm70/9.jpg",
	"https://i.ibb.co/h76bbr1/10.jpg",
	"https://i.ibb.co/CVrFGnL/11.jpg",
	"https://i.ibb.co/mNYHQ1M/12.jpg",
	"https://i.ibb.co/FWT8hZd/13.jpg",
	"https://i.ibb.co/0ZS4bN9/14.jpg",
	"https://i.ibb.co/VHMKKqd/15.jpg",
	"https://i.ibb.co/nkRbzzy/16.jpg",
	"https://i.ibb.co/tYymQ8s/17.jpg",
	"https://i.ibb.co/yRqR21S/18.jpg",
	"https://i.ibb.co/YXHjJqf/19.jpg",
	"https://i.ibb.co/L8mH4t1/20.jpg",
	"https://i.ibb.co/VvpDVk9/21.jpg",
	"https://i.ibb.co/HBWP94m/22.jpg",
	"https://i.ibb.co/6YW9535/23.jpg",
	"https://i.ibb.co/fXPfDbs/24.jpg",
	"https://i.ibb.co/chy6d2t/25.jpg",
	"https://i.ibb.co/dGk8byV/26.jpg",
	"https://i.ibb.co/x7zKNtp/27.jpg",
	"https://i.ibb.co/n8RtLHb/28.jpg",
	"https://i.ibb.co/2YjM8cb/29.jpg",
	"https://i.ibb.co/8j6Lsmy/30.jpg",
	"https://i.ibb.co/RbJwjsz/31.jpg",
	"https://i.ibb.co/qDpstq8/32.jpg",
	"https://i.ibb.co/KxrdFFZ/33.jpg",
	"https://i.ibb.co/phVTMNF/34.jpg",
	"https://i.ibb.co/NrBsS0K/35.jpg",
	"https://i.ibb.co/KzVTSm0/36.jpg",
	"https://i.ibb.co/LtVXtDj/logo-artsy-blue.png",
	"https://i.ibb.co/5WBjWrv/logo-artsy-black.png"
);
foreach ($images_url as $image_url) {
	download_img($image_url);
}

$products = array(
	array(
		"name" => "Lumbersexual",
		"price" => 100,
		"img" => "./resources/product_img/1.jpg",
		"categories" => array("PRINTS", "SALES")
	),
	array(
		"name" => "Seitan",
		"price" => 200,
		"img" => "./resources/product_img/2.jpg",
		"categories" => array("PRINTS")
	),
	array(
		"name" => "Normcore",
		"price" => 250,
		"img" => "./resources/product_img/3.jpg",
		"categories" => array("PRINTS")
	),
	array(
		"name" => "Pok",
		"price" => 150,
		"img" => "./resources/product_img/4.jpg",
		"categories" => array("PRINTS")
	),
	array(
		"name" => "Poutine",
		"price" => 320,
		"img" => "./resources/product_img/5.jpg",
		"categories" => array("PRINTS")
	),
	array(
		"name" => "Thundercats",
		"price" => 320,
		"img" => "./resources/product_img/6.jpg",
		"categories" => array("PRINTS")
	),
	array(
		"name" => "Microdosing",
		"price" => 230,
		"img" => "./resources/product_img/7.jpg",
		"categories" => array("PRINTS")
	),
	array(
		"name" => "Prism",
		"price" => 240,
		"img" => "./resources/product_img/8.jpg",
		"categories" => array("PRINTS")
	),
	array(
		"name" => "Flexitarian",
		"price" => 120,
		"img" => "./resources/product_img/9.jpg",
		"categories" => array("PRINTS", "SALES")
	),
	array(
		"name" => "Tofu",
		"price" => 300,
		"img" => "./resources/product_img/10.jpg",
		"categories" => array("PRINTS")
	),
	array(
		"name" => "Paleo",
		"price" => 110,
		"img" => "./resources/product_img/11.jpg",
		"categories" => array("PRINTS", "SALES")
	),
	array(
		"name" => "Raw",
		"price" => 320,
		"img" => "./resources/product_img/12.jpg",
		"categories" => array("PRINTS")
	),
	array(
		"name" => "Shaman",
		"price" => 320,
		"img" => "./resources/product_img/13.jpg",
		"categories" => array("PRINTS", "SALES")
	),
	array(
		"name" => "Pitchfork",
		"price" => 320,
		"img" => "./resources/product_img/14.jpg",
		"categories" => array("PRINTS")
	),
	array(
		"name" => "Selvage",
		"price" => 320,
		"img" => "./resources/product_img/15.jpg",
		"categories" => array("PRINTS")
	),
	array(
		"name" => "Cliche",
		"price" => 250,
		"img" => "./resources/product_img/16.jpg",
		"categories" => array("PRINTS", "SALES")
	),
	array(
		"name" => "Sriracha",
		"price" => 320,
		"img" => "./resources/product_img/17.jpg",
		"categories" => array("PRINTS", "SALES")
	),
	array(
		"name" => "Hoodie",
		"price" => 250,
		"img" => "./resources/product_img/18.jpg",
		"categories" => array("PRINTS")
	),
	array(
		"name" => "Tattooed",
		"price" => 220,
		"img" => "./resources/product_img/19.jpg",
		"categories" => array("PRINTS")
	),
	array(
		"name" => "Taxidermy",
		"price" => 320,
		"img" => "./resources/product_img/20.jpg",
		"categories" => array("PAPERCUTS")
	),
	array(
		"name" => "Iceland",
		"price" => 250,
		"img" => "./resources/product_img/21.jpg",
		"categories" => array("PAPERCUTS", "SALES")
	),
	array(
		"name" => "Fam",
		"price" => 320,
		"img" => "./resources/product_img/22.jpg",
		"categories" => array("PAPERCUTS")
	),
	array(
		"name" => "Mug",
		"price" => 320,
		"img" => "./resources/product_img/23.jpg",
		"categories" => array("PAPERCUTS")
	),
	array(
		"name" => "Semiotics",
		"price" => 320,
		"img" => "./resources/product_img/24.jpg",
		"categories" => array("PAPERCUTS")
	),
	array(
		"name" => "Pack",
		"price" => 250,
		"img" => "./resources/product_img/25.jpg",
		"categories" => array("PAPERCUTS")
	),
	array(
		"name" => "Fanny",
		"price" => 320,
		"img" => "./resources/product_img/26.jpg",
		"categories" => array("PAPERCUTS")
	),
	array(
		"name" => "Plant",
		"price" => 220,
		"img" => "./resources/product_img/27.jpg",
		"categories" => array("PAPERCUTS")
	),
	array(
		"name" => "Vice",
		"price" => 250,
		"img" => "./resources/product_img/28.jpg",
		"categories" => array("PAPERCUTS")
	),
	array(
		"name" => "Subway",
		"price" => 320,
		"img" => "./resources/product_img/29.jpg",
		"categories" => array("PAPERCUTS", "SALES")
	),
	array(
		"name" => "Flannel",
		"price" => 220,
		"img" => "./resources/product_img/30.jpg",
		"categories" => array("PAPERCUTS")
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