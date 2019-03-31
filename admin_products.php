<?php
session_start();
$title = "Products Admin Panel";
$css = "./css/admin_products.css";
include 'inc/functions_user.php';
include 'inc/header.php';
?>
	<h1>- Products Admin Panel -</h1>
	<div class="add_product">
		<h2>ADD A PRODUCT</h2>
		<form name="index.php" name="add_product_form" action="manage_products.php" method="POST">
			<input name="type" type="hidden" value="create">
			<input placeholder="name" type="text" value="" name="name" required><br>
			<input placeholder="price" type="number" value="" name="price" required><br>
			<input placeholder="photo url" type="url" value="" name="img_url" required><br>
			<div class="checkbox_wrapper">
				<?php $categories = get_categories();
				foreach ($categories as $key => $category) { ?>
				<div class="checkbox">
					<input type="checkbox" id="<?=$category?>" name="category_<?=$key?>" value="<?=$category?>">
					<label for="<?=$category?>"><?=$category?></label>
				</div>
				<?php } ?>
			</div>
			<input type="submit" value="CREATE" name="submit">
		</form>
	</div>
	<div class="separator"></div>
	<div class="update_product">
	<h2>UPDATE A PRODUCT</h2>
		<?php $products = get_products();
		foreach ($products as $product_id => $product) {?>
		<div class="product_container">
			<div class="product_img">
				<img src="<?=$product['img']?>" alt="" class="image">
			</div>
			<div class="form_container">
				<form name="index.php" action="manage_products.php" method="POST">
					<input name="type" type="hidden" value="update">
					<input name="product_id" type="hidden" value="<?=$product_id?>">
					<input type="text" value="<?=$product['name']?>" name="name" ><br>
					<input type="number" value="<?=$product['price']?>" name="price" ><br>
					<input type="text" value="<?=$product['img']?>" name="img_url"><br>
					<div class="checkbox_wrapper">
						<?php $categories = get_categories();
						foreach ($categories as $key => $category) { ?>
						<input type="checkbox" id="<?=$category?>" name="category_<?=$key?>" value="<?=$category?>" <?=in_array($category, $product['categories']) ? "checked" : ""?>>
						  <label for="<?=$category?>"><?=$category?></label>
						<?php } ?>
					</div>
					<input type="submit" value="UPDATE" name="submit">
				</form>
				<form action="manage_products.php" method="POST">
					<input name="type" type="hidden" value="delete">
					<input name="product_id" type="hidden" value="<?=$product_id?>"> 
					<input type="submit" value="DELETE" name="submit">
				</form>
			</div>
		</div>
		<?php } ?>

	</div>
<?php include 'inc/footer.php' ?>
