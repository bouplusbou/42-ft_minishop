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
$title = "Shopping Cart";
// $css = "./css/listing.css";
include 'header.php';
?>
	<div class="wrapper">
		<h2>Cart</h2>
		<?php
		if (isset($_COOKIE['cart'])) {
			$cart_infos = unserialize($_COOKIE['cart']);
			$products = get_products();
			foreach ($cart_infos as $cart_info) {
				$product = $products[$cart_info['product_id']];
		?>
				<div class="product_container">
				  <img src="<?=$product['img']?>" alt="" class="image">
				  <div class="overlay">
					<div class="text"><?=$product['name']?></div>
					<div class="text"><?=$product['price']?></div>
				  </div>
				</div>
		<?php
				}
			}?>
	</div>
</body>
</html>