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
		<ul class="product_wrapper">
		<?php
			$products = get_products();
			foreach ($products as $product_id => $product) {
				if ($category === "ALL" || in_array($category, $product['categories'])) {
					?>
				<li class="product_container">
				  <img src="<?=$product['img']?>" alt="" class="image">
				  <div class="overlay">
					<div class="product_infos">
						<div class="text product_name"><?=$product['name']?></div>
						<div class="text product_price">$<?=$product['price']?>.00</div>
					</div>
					<div class="form-group">
					  <form action="manage_cart.php" method="POST">
					    <input name="quantity" type="hidden" value="1" />
					    <input name="product_id" type="hidden" value="<?=$product_id?>" />
					    <button class="add-button" name="add" value="add">Add to Cart!</button>
					  </form>
					</div>
				  </div>
				</li>
		<?php	}
			} ?>
		</ul>

<?php include 'inc/footer.php'; ?>
