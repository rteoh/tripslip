<?
// Fetch Database info
include("../include/con.php");
include("../include/function.php");

// Get Location from URL
$location = str_replace("/api/", "", $_SERVER['REQUEST_URI']);

// Check and see if api is empty
if($location == "") {
	$listing = new StdClass;
	$listing->status = "Error";
	$listing->message = "Invalid API Key";
} else {

	// Get business data from MySQL database.
	$r = mysqli_query($con, "SELECT * FROM yelp_business WHERE city = '$location'");
	$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);

	for($i = 0; $i < 25; $i++) {

		$listing[$i] = new StdClass;

		$listing[$i]->id = $row['id'];
		$listing[$i]->name = $row['name'];
		$listing[$i]->image_url = $row['image_url'];
		$listing[$i]->rating = $row['rating'];

		$row = $r->fetch_assoc();

	}
}

$json = json_encode($listing, JSON_PRETTY_PRINT);

header('Content-Type: application/json');

echo $json;

?>