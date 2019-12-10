<?
// Fetch Database info
include("../include/con.php");
include("../include/function.php");



// Get Location from URL
$location = str_replace("/api/", "", $_SERVER['REQUEST_URI']);
$location = str_replace(" ", "%20", $location);
$location = str_replace("-", " ", $location);

$user = $_GET["user"];
$pass = $_GET["pass"];

// Check if User and Password is empty
if(!$user || !$pass) {

	// If API Required username and password
	//$array = array('message' => "Please enter a username or password.");
	//$json = json_encode($array, JSON_PRETTY_PRINT);
	//header('Content-Type: application/json');
	//echo $json;

	// Check and see if api is empty
	if($location == "") {
		$listing = new StdClass;
		$listing->status = "Error";
		$listing->message = "Please enter a location.";
	} else {

		// Get business data from MySQL database.
		$r = mysqli_query($con, "SELECT * FROM yelp_business WHERE city = '$location'");
		$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);

		// If location does not exist on Database fetch from MySQL Database.
		if(mysqli_num_rows($r) == 0) {

			// Run function to fetch location data
			fetchData($location,1);

			// Call MySQL database again... (with updated info)
			$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);

		}
		
		// Call MySQL database again... (with updated info)
		$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);

		for($i = 0; $i < mysqli_num_rows($r); $i++) {

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

	die();

}

// Trim password
$p = mysqli_real_escape_string ($con, trim($pass));

// Check password with MySQL
$r = @mysqli_query($con, "SELECT * FROM users WHERE user='$user'");
$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);

// Intialize login
$login = new StdClass;
$login = false;

// Convert result to JSON
if(password_verify($p, $row['password'])) {


	// Intialize location array
	$location_array = array();


	//Check to see if a location is inputted
	if(!empty($_GET['location'])) {


		// Get client locations through the MySQL database
		//$locations = @mysqli_query($con, "SELECT * FROM user_locations WHERE user='$user'");
		//$row_locations = mysqli_fetch_array ($r, MYSQLI_ASSOC);



	} else {

		// If location is not inputted, list out locations

		
		// Get client locations through the MySQL database
		$locations = @mysqli_query($con, "SELECT * FROM user_locations WHERE user='$user'");
		$row_locations = mysqli_fetch_array ($r, MYSQLI_ASSOC);

		// Get number of locations that the user has
		$location_num = mysqli_num_rows($locations);

		// do-while loop creates an array of all of the user's location
		do {

			// Check to see if $row['location'] is empty, if so, omit
			if(!empty($row['location'])) {

				$new = array_push($location_array, $row['location']); 

			}

		} while($row = $locations->fetch_assoc());

	}


	// If logged in, output data
	$array = array(
		'login' => true, 
		'username' => $user, 
		'location' => $location_array,
	);

} else {
	$array = array('login' => false);
}

$json = json_encode($array, JSON_PRETTY_PRINT);

header('Content-Type: application/json');

echo $json;

?>