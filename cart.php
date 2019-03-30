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
include 'inc/header.php';
?>
	<div class="wrapper">
		<h2>Cart</h2>
		<?php if (isset($_COOKIE['cart'])) {
		$cart = unserialize($_COOKIE['cart']);
		$products = get_products();
		foreach ($cart as $cart_id => $cart_product) {
			$product = $products[$cart_product['product_id']]; ?>
		<div class="product_container">
		  <img src="<?=$product['img']?>" alt="" class="image">
		  <div class="overlay">
			<div class="text"><?=$product['name']?></div>
			<div class="text"><?=$product['price']?></div>
		  </div>
		  <div class="form-group">	
			  <form action="manage_cart.php" method="POST">
			    <input name="type" type="hidden" value="delete" />
			    <input name="quantity" type="hidden" value="1" />
			    <input name="cart_id" type="hidden" value="<?=$cart_id?>" /> 
			    <button class="delete-button" type="submit">Delete</button>
			  </form>
			</div>
		</div>
		<?php }
		} ?>
	</div>
</body>
</html>