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
function get_categories() {
	if (file_exists("./database/categories")) {
		$fp = fopen("./database/categories", "r");
		if (flock($fp, LOCK_SH)) { // acquière un verrou exclusif
			$file_categories = file_get_contents("./database/categories");
			fflush($fp);            // libère le contenu avant d'enlever le verrou
			flock($fp, LOCK_UN);    // Enlève le verrou
		} else {
			echo "Impossible de verrouiller le fichier !";
		}
		fclose($fp);
		return unserialize($file_categories);
	}
}
function add_to_cart($img_id) {
	echo $img_id."\n";
	return;

}
$title = "Listing";
include 'header.php';
?>
	<div class="wrapper">
		<?php
			$category = "All";
			if (in_array($_GET['category'], get_categories())) {
				$category = $_GET['category'];
			}
		?>
		<h2><?=$category?></h2>
		<?php
			$products = get_products();
			foreach ($products as $product) {
				if ($category === "All" ||in_array($category, $product['categories'])) {
					?>
				<div class="product_container">
				  <img src="<?=$product['img']?>" alt="" class="image">
				  <div class="overlay">
					<div class="text"><?=$product['name']?></div>
					<div class="text"><?=$product['price']?></div>
					<div class="form-group">
					  <form action="manage_cart.php" method="POST">
					    <input name="quantity" type="hidden" value="1" />
					    <input name="product_id" type="hidden" value="<?=$product['id']?>" /> 
					    <button class="add-button" type="submit">Add to Cart!</button>
					  </form>
					</div>
				  </div>
				</div>
		<?php	}
			} ?>
	</div>
</body>
</html>