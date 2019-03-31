<?php

/*
 *
 * Check if a user exists in the database
 *
 * @param		array   $data The array with the unserialize data
 * @param	    string  $mail Mail ot check
 * @param	    string  $passwd if set it'll also check if the passwd is correct
 * @return      bool
 *
 */

function check_user_existance($data, $mail, $passwd = null) {
	foreach ($data as $user) {
		if ($user['user'] === $mail) {
			if ($passwd !== null) {
				if (password_verify($passwd, $user['passwd']) == true) {
					return true;
				}
			} else {
				return true;
			}
		}
	}
	return false;
}

/*
 *
 * Returns the data of file unserialized
 *
 * @param	string $file path of the file
 * @return  array
 *
 */

function unserialize_data($file) {
	$data = [];
	if (file_exists($file)) {
		$fd = fopen($file, "r");
		if (flock($fd, LOCK_SH)) {
			$data = file_get_contents($file);
			$data = unserialize($data);
			flock($fd, LOCK_UN);
		} else {
			echo "Unable to flock() the file: $file\n";
		}
		fclose($fd);
	}
	return ($data);
}

/*
 *
 * Serialize data to a file
 *
 * @param	array $data
 * @param   string $file path of the file
 * @return	none
 *
 */

function serialize_data($data, $file) {
		$fd = fopen($file, "c");
		if (flock($fd, LOCK_EX)) {
			$data = serialize($data);
			file_put_contents($file, $data);
			flock($fd, LOCK_UN);
		} else {
			echo "Unable to flock() the file: $file\n";
		}
		fclose($fd);
}

/*
 *
 * Creates new username - password(hashed) array
 *
 * @param	string	$user representing the mail associated with the user
 * @param   string  $passwd plain text passwd
 * @return  array
 *
 */

function	create_user($user, $passwd) {
	$passwd = password_hash($passwd, PASSWORD_BCRYPT);

	return ["user" => $user, "passwd" => $passwd];
}

function	delete_user($file, $username) {
	$db = unserialize_data($file);
	foreach ($db as $key => $user) {
		if ($user['user'] == $username) {
			unset($db[$key]);
			break ;
		}
	}
	$db = array_values($db);
	serialize_data($db, $file);
}

function is_valid_email($email) {
	return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function create_error_html($errors) {
	$errmsg = '';
	foreach ($errors as $error) {
		$errmsg .= "<span class='error_msg'>$error</span>";
	}
	return $errmsg;
}

/*
 *
 * Return an array with all the products
 *
 * @return	none
 *
 */

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

/*
 *
 * Return an array of all the categories
 *
 * @return	array
 *
 */

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

/*
 *
 * Download an image from a URL, place it in ./resources/product_img/
 * and return the path newly created
 *
 * @param	string	$image_url representing the url of the image to dl
 * @return  array
 *
 */

function download_img($image_dir, $image_url) {
	if (!file_exists($image_dir)) {
		mkdir($image_dir);
	}
	$ch = curl_init($image_url);
	$path_parts = pathinfo($image_url);
	$parsed_url = parse_url($path_parts['basename']);
	$path_parts = pathinfo($parsed_url['path']);
	$path = $image_dir.$path_parts['filename'].".".$path_parts['extension'];
	$fp = fopen($path, 'wb');
	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_exec($ch);
	curl_close($ch);
	fclose($fp);
	return $path;
}

/*
 *
 * Return all the categories from a product
 *
 * @param	string	$product_id
 * @return  string
 *
 */

function get_product_categories_arr($product_id) {
	$products = get_products();
	$categories = $products[$product_id]['categories'];
	return $categories;
}

function get_product_categories($product_id) {
	$products = get_products();
	$categories = $products[$product_id]['categories'];
	$categories_str = implode(",", $categories);
	return $categories_str;
}


function create_product($name, $price, $img_url, $categories) {
	$products = get_products();
	$img_path = download_img("./resources/products_img/", $img_url);
	$product = array(
		"name" => $name,
		"price" => $price,
		"img" => $img_path,
		"categories" => $categories
	);
	$products[] = $product;
	$products_serialized = serialize($products);
	file_put_contents("./database/products", "$products_serialized", LOCK_EX);
}

function delete_product($product_id) {
	$products = get_products();
	unset($products[$product_id]);
	$serialized_products = serialize($products);
	file_put_contents("./database/products", "$serialized_products", LOCK_EX);
}

function update_product($product_id, $name, $price, $img_url, $categories) {
	if (!preg_match("~^./resources/products_img/~", $img_url)) {
		$img_url = download_img("./resources/products_img/", $img_url);
	}
	$products = get_products();
	$product = array(
		"name" => $name,
		"price" => $price,
		"img" => $img_url,
		"categories" => $categories
	);
	$products[$product_id] = $product;
	$products_serialized = serialize($products);
	file_put_contents("./database/products", "$products_serialized", LOCK_EX);
}

function get_users() {
	if (file_exists("./database/users")) {
		$fp = fopen("./database/users", "r");
		if (flock($fp, LOCK_SH)) { // acquière un verrou exclusif
			$file_users = file_get_contents("./database/users");
			fflush($fp);            // libère le contenu avant d'enlever le verrou
			flock($fp, LOCK_UN);    // Enlève le verrou
		} else {
			echo "Impossible de verrouiller le fichier !";
		}
		fclose($fp);
		return unserialize($file_users);
	}
}