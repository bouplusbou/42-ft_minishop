<?php
session_start();
$title = "Admin Panel";
$css = "./css/admin.css";
include 'inc/functions_user.php';
include 'inc/header.php';
?>
	<p>Admin panel</p>
	<p>Add a product</p>
	<form name="index.php" action="manage_products.php" method="POST">
		<input name="type" type="hidden" value="create">
		<label for="product_name">Name </label><br>
		<input type="text" value="" name="name" required><br>
		<label for="product_price">Price </label><br>
		<input type="number" value="" name="price" required><br>
		<label for="product_photo">Photo url </label><br>
		<input type="url" value="" name="img_url" required><br>
		<label for="product_category">Add a category: </label><select class="prod-size-form-select" name="size">
		<?php $categories = get_categories();
		foreach ($categories as $category) { ?>
			<option value="<?=$category?>"><?=$category?></option>
		<?php } ?>
		</select><br>
		<input type="submit" value="OK" name="submit">
	</form>
	
	<p>Change a product</p>
	<div class="wrapper">
		<?php $products = get_products();
		foreach ($products as $product_id => $product) {?>
		<div class="product_container">
			<img src="<?=$product['img']?>" alt="" class="image">
			<form name="index.php" action="manage_products.php" method="POST">
				<input name="type" type="hidden" value="update">
				<input name="product_id" type="hidden" value="<?=$product_id?>">
				<label for="product_name">Name</label><br>
				<input type="text" value="<?=$product['name']?>" name="name" ><br>
				<label for="product_price">Price </label><br>
				<input type="number" value="<?=$product['price']?>" name="price" ><br>
				<label for="product_photo">Photo url </label><br>
				<input type="url" value="" name="img_url"><br>
				<label for="product_category">Add a category: </label><select class="prod-size-form-select" name="size">
				<?php $categories = get_categories();
				foreach ($categories as $category) { ?>
					<option value="<?=$category?>"><?=$category?></option>
				<?php } ?>
				</select><br>
				
				<input type="submit" value="OK" name="submit">
			</form>
			<div class="form-group">
			  <form action="manage_products.php" method="POST">
			  <label for="product_category">Delete a category: </label><select class="prod-size-form-select" name="size">
				<?php $categories = get_product_categories_arr($product_id);
				foreach ($categories as $category) { ?>
					<option value="<?=$category?>"><?=$category?></option>
				<?php } ?>
        		</select> 
			    <button class="delete-button" type="submit">Delete a category</button>
			  </form>
			</div>
			<div class="form-group">
			  <form action="manage_products.php" method="POST">
			  	<input name="type" type="hidden" value="delete">
			    <input name="product_id" type="hidden" value="<?=$product_id?>"> 
			    <button class="delete-button" type="submit">Delete product</button>
			  </form>
			</div>
		</div>
		<?php } ?>
	</div>
</body>
</html>