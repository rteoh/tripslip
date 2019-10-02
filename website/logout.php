<?php
if (!isset($_COOKIE['id'])) {
	require ('includes/login_functions.inc.php');
	redirect_user();
} else {
	setcookie ('id', '', time()-3600, '/', '', o, o);
	setcookie ('user', '', time()-3600, '/', '', o, o);
}

$page_title = 'Logout';
$title = 'Logout';

include("page/header.php");

echo "<h1>Logged Out!</h1>
<p>You are now logged out, {$_COOKIE['user']}!</p>";

include("page/footer.php");
?>