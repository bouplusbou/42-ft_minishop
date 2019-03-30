<?php

/**
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

/**
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

/**
 *
 * Serialize data to a file
 *
 * @param	array $data
 * @param   string $file path of the file
 * @return	none
 *
 */

function serialize_data($data, $file) {
	if (file_exists($file)) {
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
