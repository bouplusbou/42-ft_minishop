<?php
session_start();
function get_products() {
	if (file_exists("./database/products")) {
		$fp = fopen("./database/products", "r");
		if (flock($fp, LOCK_SH)) { // acquière un verrou exclusif
			$file_products = file_get_contents("./database/products");
			fflush($fp);            // libère le contenu avant d'enlever le verrou
			flock($fp, LOCK_UN);    // Enlève le verrou
		} else {
			echo "Impossible de verrouiller le fichier !";
		}
		fclose($fp);
		return unserialize($file_products);
	}
}
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
$products = get_products();
if ($_POST['type'] === "add") {
	$img_path = download_img($_POST['img_url']);
	$product = array(
		"name" => $_POST['name'],
		"price" => $_POST['price'],
		"img" => $img_path,
		"categories" => array($_POST['category'])
	);
	$products[] = $product;
	$products_serialized = serialize($products);
	file_put_contents("./database/products", "$products_serialized", LOCK_EX);
} elseif ($_POST['type'] === "delete") {
	unset($products[$_POST['product_id']]);
	$serialized_products = serialize($products);
	file_put_contents("./database/products", "$serialized_products", LOCK_EX);
}
$from = $_SERVER['HTTP_REFERER'];
header("Location: $from");
?>	