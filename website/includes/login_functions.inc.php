<?php

$title = 'Login';

// Redirect user @ login or logout

function redirect_user ($page = 'index.php') {
	$url = 'https://' . $_SERVER['HTTP_HOST'] . dirname($SERVER['PHP_SELF']);
	$url = rtrim($url, '/\\');
	$url .= '/' . $page;

	header("Location: $url");
	exit();
}

// Check missing login details

function check_login($dbc, $user = '', $pass = '') {
	$errors = array();
	if (empty($user)) {
		$errors[] = 'Please enter your username.';
	} else {
		$u = mysqli_real_escape_string ($dbc, trim($user));
	}
	if (empty($pass)) {
		$errors[] = 'Please enter your password.';
	} else {
		$p = mysqli_real_escape_string ($dbc, trim($pass));

		if (empty($errors)) {
			$q = "SELECT * FROM users WHERE user='$u'";
			$r = @mysqli_query($dbc, $q);
			$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
		}
		if (password_verify($p, $row['password'])) {
			return array(true, $row);
		} else {
			if (mysqli_num_rows($r) == 1) {
				$errors[] = 'Incorrect password.';
			} else {
				$errors[] = 'Account does not exist.';
			}	
		}

	}

	return array(false, $errors);
}
?>