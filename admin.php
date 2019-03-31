<?php
session_start();
$title = "Admin Panel";
$css = "./css/admin.css";
include 'inc/functions_user.php';
include 'inc/header.php';
?>
	<h1>Admin Panel - Product</h1>
	<div class="add_product">
		<h2>Add a product</h2>
		<form name="index.php" action="manage_products.php" method="POST">
			<input name="type" type="hidden" value="create">
			<label for="product_name">Name </label><br>
			<input type="text" value="" name="name" required><br>
			<label for="product_price">Price </label><br>
			<input type="number" value="" name="price" required><br>
			<label for="product_photo">Photo url </label><br>
			<input type="url" value="" name="img_url" required><br>
			<?php $categories = get_categories();
			foreach ($categories as $key => $category) { ?>
			<input type="checkbox" id="<?=$category?>" name="category_<?=$key?>" value="<?=$category?>">
  			<label for="<?=$category?>"><?=$category?></label>
			<?php } ?>
			<input type="submit" value="OK" name="submit">
		</form>

	</div>
	
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
				<input type="text" value="<?=$product['img']?>" name="img_url"><br>
				<?php $categories = get_categories();
				foreach ($categories as $key => $category) { ?>
				<input type="checkbox" id="<?=$category?>" name="category_<?=$key?>" value="<?=$category?>" <?=in_array($category, $product['categories']) ? "checked" : ""?>>
  				<label for="<?=$category?>"><?=$category?></label>
				<?php } ?>
				<input type="submit" value="OK" name="submit">
			</form>



			
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
