<?

include("../include/con.php");
include("../include/function.php");

session_start();

if (!isset($_SESSION['id'])) {
	require ('../includes/login_functions.inc.php');
	redirect_user('');
}
?>
<html>

	<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/css/style.css">


	</head>

<body>