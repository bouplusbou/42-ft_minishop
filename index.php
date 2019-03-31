<?php
session_start();

$title = "Home";
$css = "./css/index.css";
include 'inc/header.php';
include 'inc/functions_user.php';
?>

<div class="wrapper">
	<img src="../resources/website_img/background-index.jpg" alt="">
</div>
<div class="products">
	<h1>Featured</h1>
	<ul class="products_wrapper">
	<?php
		$all_products = get_products();
		$arr_keys = array_rand(get_products(), 3);
		foreach ($arr_keys as $arr_key) {
			$products[] = $all_products[$arr_key];
		}
		foreach ($products as $product_id => $product) {?>
			<li class="product_container">
			  <img src="<?=$product['img']?>" alt="" class="image">
			  <div class="overlay">
				<div class="product_infos">
					<div class="text product_name"><?=$product['name']?></div>
					<div class="text product_price">$<?=$product['price']?>.00</div>
				</div>
			  </div>
			</li>
	<?php	}
		 ?>
	</ul>
</div>
</div>

<?php 
include 'inc/footer.php'; 
?>
