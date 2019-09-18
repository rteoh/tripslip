<?

include("include/con.php");
include("include/function.php");

?>

<html>

	<head>
		<title>TripSlip</title>
		<link rel="stylesheet" media="all" href="/css/style.css" />
	</head>

	<body>
		<div class="bg"></div>
		<center>
			<img src="/img/logo.svg" height="300px" alt="TripSlip">

			<form method="post">
				<input type="text" name="text" placeholder="Type location"></input>
				<br>
				<button type="submit" name="submit">SEARCH</button>
			</form>

<?

if(isset($_POST['submit'])){
	


	$location = $_POST["text"];
	listing($location);






}

?>


			<img class="hide" src="https://www.cutercounter.com/hits.php?id=gvuqqpko&nd=6&style=44" border="0" alt="hit counter">
		</center>
	</body>

</html>

