<?php

session_start();

if (!isset($_SESSION['id'])) {
	require ('includes/login_functions.inc.php');
	redirect_user();
}

$title = 'Logged In';
$page = 'Logged In';

echo "<h1>Welcome, {$_SESSION['user']}!</h1>
<a href=\"store\">Visit Store</a>
<p><a href=\"logout\">Logout</a></p>";

if (isset($_SESSION['group']) && $_SESSION['group'] == '1') {
	echo "You are admin!
	<br>
	<a href=\"/admin\">Click here to join the admin club!</a>";
}

?>