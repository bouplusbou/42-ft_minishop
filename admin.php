<?php
session_start();
$title = "Admin Panel";
$css = "./css/admin.css";
include 'header.php';
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
?>
	<p>Admin panel</p>
	<form name="index.php" action="create_product.php" method="post">
		<label for="product_name">Name: </label><input type="text" value="" name="email" required>
		<label for="product_price">Price: </label><input type="password" value="" name="passwd" required>
		<label for="product_photo">Photo URL: </label><input type="password" value="" name="passwd" required>
		<label for="product_category">Category: </label><input type="password" value="" name="passwd" required>
		<input type="submit" value="OK" name="submit">
	</form>
	<div class="wrapper">
		<?php
			$products = get_products();
			foreach ($products as $product_id => $product) {
		?>
				<div class="product_container">
				  <img src="<?=$product['img']?>" alt="" class="image">
				  <div class="overlay">
					<div class="text"><?=$product['name']?></div>
					<div class="text"><?=$product['price']?></div>
					<div class="form-group">
					  <form action="manage_products.php" method="POST">
					  	<input name="type" type="hidden" value="delete">
					    <input name="product_id" type="hidden" value="<?=$product_id?>"> 
					    <button class="delete-button" type="submit">Delete</button>
					  </form>
					</div>
				  </div>
				</div>
		<?php
			} ?>
	</div>
</body>
</html>