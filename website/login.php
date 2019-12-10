<?php

$page = 'Login';
$title = 'Login';

// Call Header Page
include('include/header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require ('includes/login_functions.inc.php');
	require ('include/con.php');

	// Check login
	list ($check, $data) = check_login($con, $_POST['user'], $_POST['pass']);

	if ($check) {
		session_start();
		$_SESSION['id'] = $data['id'];
		$_SESSION['user'] = $data['user'];
		$_SESSION['group'] = $data['group'];
		$_SESSION['token'] = time() + 3600; // Token is set for 1 hour
		redirect_user('account/');
	} else {
		$errors = $data;
	}

	mysqli_close($con);
}
include ('includes/login_page.inc.php');
?>