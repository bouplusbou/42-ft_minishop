<?php
session_start();
include 'inc/functions_user.php';
$title = "Listing";
$css = "./css/listing.css";
include 'inc/header.php';
?>
	<div class="wrapper">
		<?php $category = "All";
			if (in_array($_GET['category'], get_categories())) {
				$category = $_GET['category'];
			} ?>
		<h2><?=$category?></h2>
		<div class="mondrian">
			<ul>
				<li><img src="./resources/product_img/1.jpg" alt="" width="200px"></li>
				<li><img src="./resources/product_img/4.jpg" alt="" width="200px"></li>
				<li><img src="./resources/product_img/5.jpg" alt="" width="200px"></li>
				<li><img src="./resources/product_img/1.jpg" alt="" width="200px"></li>
				<li><img src="./resources/product_img/2.jpg" alt="" width="200px"></li>
				<li><img src="./resources/product_img/4.jpg" alt="" width="200px"></li>
				<li><img src="./resources/product_img/2.jpg" alt="" width="200px"></li>
				<li><img src="./resources/product_img/2.jpg" alt="" width="200px"></li>
				<li><img src="./resources/product_img/3.jpg" alt="" width="200px"></li>
				<li><img src="./resources/product_img/1.jpg" alt="" width="200px"></li>
				<li><img src="./resources/product_img/3.jpg" alt="" width="200px"></li>
				<li><img src="./resources/product_img/1.jpg" alt="" width="200px"></li>
				<li><img src="./resources/product_img/5.jpg" alt="" width="200px"></li>
				<li><img src="./resources/product_img/3.jpg" alt="" width="200px"></li>
				<li><img src="./resources/product_img/4.jpg" alt="" width="200px"></li>
				<li><img src="./resources/product_img/5.jpg" alt="" width="200px"></li>
				<li><img src="./resources/product_img/2.jpg" alt="" width="200px"></li>
				<li><img src="./resources/product_img/3.jpg" alt="" width="200px"></li>
				<li><img src="./resources/product_img/4.jpg" alt="" width="200px"></li>
				<li><img src="./resources/product_img/5.jpg" alt="" width="200px"></li>
			</ul>
		</div>
	</div>
</body>
</html>
