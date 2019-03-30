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
$products = get_products();
if ($_POST['type'] === "add") {
} elseif ($_POST['type'] === "delete") {
	unset($products[$_POST['product_id']]);
	$serialized_products = serialize($products);
	file_put_contents("./database/products", "$serialized_products", LOCK_EX);
}
$from = $_SERVER['HTTP_REFERER'];
header("Location: $from");
?>	