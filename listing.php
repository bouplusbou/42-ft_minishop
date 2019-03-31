<?php
session_start();
include 'inc/functions_user.php';
$title = "Listing";
$css = "./css/listing.css";
include 'inc/header.php';
?>
	<div class="wrapper">
		<?php $category = "ALL";
			if (in_array($_GET['category'], get_categories())) {
				$category = $_GET['category'];
			}
		?>
		<h2><?=$category?></h2>
		<?php
			$products = get_products();
			foreach ($products as $product_id => $product) {
				if ($category === "All" || in_array($category, $product['categories'])) {
					?>
				<div class="product_container">
				  <img src="<?=$product['img']?>" alt="" class="image">
				  <div class="overlay">
					<div class="text"><?=$product['name']?></div>
					<div class="text"><?=$product['price']?></div>
					<div class="form-group">
					  <form action="manage_cart.php" method="POST">
					    <input name="quantity" type="hidden" value="1" />
					    <input name="product_id" type="hidden" value="<?=$product_id?>" />
					    <button class="add-button" type="submit">Add to Cart!</button>
							<input type="submit" name="add" value="Add" />
					  </form>
					</div>
				  </div>
				</div>
		<?php	}
			} ?>

<?php include 'inc/footer.php'; ?>
