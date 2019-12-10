<?
// Fetch Database info
include("../include/con.php");
include("../include/function.php");



// Get Location from URL
$location = str_replace("/api/", "", strtok($_SERVER['REQUEST_URI'],'?'));
$location = str_replace(" ", "%20", $location);
$location = str_replace("-", " ", $location);

// Get Username and Password from URL
$user = @$_GET["user"];
$pass = @$_GET["pass"];

//See if Query string is used
if(@$_GET["schedule"]) {
	$schedule = true;
	$day = $_GET["schedule"];
} else {
	$schedule = false;
}

// Check if User and Password is empty
if(!isset($user) || !isset($pass)) {

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
	} elseif($schedule) {

		// If schedule query is used.
		daySchedule($location,$day);


	} else { // If API has no parameters

		// Get business data from MySQL database.
		$r = mysqli_query($con, "SELECT * FROM yelp_business WHERE city = '$location' AND type = 'a'");
		$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);

		// If location does not exist on Database fetch from MySQL Database.
		if(mysqli_num_rows($r) == 0) {

			// Run function to fetch location data
			fetchData($location);

			$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);

		}
		
		// Call MySQL database again... (with updated info)
		$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);

		// Starting listing number
		$i = 0;

		do {

			$time = timeSpent($row['id']);


			// Check type and add it to JSON
			if($row['type'] == 'a') {
				$type = "Attraction";
			} elseif($row['type'] == 'r') {
				$type = "Restuarant";
			} else {
				$type = "Point of Interest";
			}



			// Link data with it's correct category
			$listing[$i] = new StdClass;

			$listing[$i]->id = $row['id'];
			$listing[$i]->name = $row['name'];
			$listing[$i]->image_url = $row['image_url'];
			$listing[$i]->rating = $row['rating'];
			$listing[$i]->type = $type;
			$listing[$i]->time_spent = $time;


			// Next listing number
			$i++;



			
		} while($row = $r->fetch_assoc());
	}

	// Encode listing into JSON format
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
if(password_verify($p, $row['password']) || $_SESSION['user']) {


	// Intialize location array
	$location_array = array();

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



	// If logged in, output data
	$array[0] = new StdClass;
	$array[0]->login = true;
	$array[0]->username = $user;
	$array[0]->image = "https://tripslip.net/img/locations/location.svg";
	$array[0]->location = $location_array;



	// Encode data to JSON
	$json = json_encode($array, JSON_PRETTY_PRINT);

	// Check for remove parameter, to remove specific business id
	//See if Query string is used
	if(@$_GET["remove"]) {

		// This is the remove ID (MUST BE AN ID!)
		$remove = $_GET["remove"];

		removeListing($user,$remove);

	}

	// If schedule parameter is called
	if(@$schedule) {

		// Function to generate schedule
		daySchedule($location,$day);
	}

} else {

	$array[0] = new StdClass;
	$array[0]->login = "false";

}

$json = json_encode($array, JSON_PRETTY_PRINT);

header('Content-Type: application/json');

echo $json;

?>
