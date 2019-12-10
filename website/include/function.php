<?


function map($lat, $long) {

	// Center the pinpoint on the map
	if(@$lat && @$long) {
		
		
		if($long < 0) {

			@$box_long1 = $long - 0.5;
			@$box_long2 = $long + 0.5;

		} else {
			@$box_long1 = $long + 0.5;
			@$box_long2 = $long - 0.5;
		}

		if($lat < 0) {

			@$box_lat1 = $lat - 0.5;
			@$box_lat2 = $lat + 0.5;

		} else {

			@$box_lat1 = $lat + 0.5;
			@$box_lat2 = $lat - 0.5;

		}

		echo '<iframe class="open-map" width: 80%; height: 80%; border:none; margin:0; padding:0" src="//www.openstreetmap.org/export/embed.html?bbox=' . @$box_long1 . ','. @$box_lat1 . ',' . @$box_long2 . ','. @$box_lat2 . '&amp;layer=transportmap&amp;marker=' . @$lat . ','. @$long . '" class="ui-droppable"></iframe>';

	}


}

function getAPI($location) {

	global $api_key;

	// Convert Space in text
	$location = str_replace(" ", "%20", $location);
	$request_url = "https://api.yelp.com/v3/businesses/search?location=" . $location . "&term=Tourist%20Attractions&limit=50&offset=0";

	return $response = callAPI($request_url);

}

function callAPI($request_url) {

	global $api_key;

	// Send Yelp API call
	$ch = curl_init($request_url);
	curl_setopt($ch, CURLOPT_HTTPHEADER,
	    array(
	        "Content-Type: application/json",
	        "Authorization: Bearer ". $api_key
	));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$data = curl_exec($ch); // Yelp response
	curl_close($ch);



	// Handle Yelp response data
	return $response = json_decode($data);

}

function listing($location) {

	global $con;


	$response = getAPI($location);
	$counter = 1;

	foreach($response as $key => $arrays) {
		// Parse Data only if $key is businesses
		if($key == "businesses") {

			// Parse important data from JSON.
			foreach($arrays as $value) {


				// Convert JSON data into variables
				$id = $value->id;
				@$alias = $value->alias;
				@$name = $value->name;
				@$image_url = $value->image_url;
				@$rating = $value->rating;
				@$phone = $value->phone;
				@$price = $value->price;


				foreach($value as $info => $data) {

					// Get address data
					if($info == "location") {
						@$address = $data->address1;
						@$city = @$data->city;
						@$postal = $data->zip_code;
						@$state = $data->state;
						@$country = $data->country;
					}

					// Get coordinates data
					if($info == "coordinates") {
						@$latitude = $data->latitude;
						@$longitude = $data->longitude;
					}

					// Get coordinates data
					if($info == "categories") {

						foreach($data as $group) {
							@$tags = $group->title;

							// Check whether to add to categories variable or create new categories variable
							if(@$categories == "") {
								@$categories = $tags;
							} else {
								@$categories = $categories . ", " . $tags;
							}
						}

					}
				}


				// Add business information to database
				$insert = @mysqli_query($con, "INSERT INTO `yelp_business`(`id`, `alias`, `name`, `image_url`, `category`, `rating`, `address`, `city`, `postal`, `state`, `country`, `latitude`, `longitude`, `price`, `phone`) VALUES ('$id','$alias','$name','$image_url','$categories','$rating','$address','$city','$postal','$state','$country','$latitude','$longitude','$price','$phone')");


				// Clear categories variable
				$categories = "";

				// Change \' back to '
				if(stripos($name, "'") !== FALSE) {
					$name = str_replace("\'", "'", $name);
				}

				echo "<div class=\"col-md-3\">";
				echo "<a href=\"https://tripslip.net/biz/" . $alias . "\">";
				echo "<img src=\"" . $image_url . "\" height=\"300\">";
				echo "<p>" . $counter . ": " . $name . "</p>";
				echo "</a>";
				echo "</div>";

				echo "<br>";
				$counter++;
			}
		}

	}
}

function updateLocation($alias) {

	global $con, $api_key;

	// Convert Space in text
	$alias = str_replace(" ", "%20", $alias);
	$request_url = "https://api.yelp.com/v3/businesses/" . $alias;

	$response = callAPI($request_url);

	$counter = 1;

	$pretty_response = json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

			// Parse important data from JSON.
			foreach($response as $value => $data) {

				// Check if there is a state and country response
				if(@$data->state && @$data->country) {
					// Add state and country to listing.
					@$state = $data->state;
					@$country = $data->country;

					// Add business information to database
					$update = mysqli_query($con, "UPDATE `yelp_business` SET `state` = '$state', `country` = '$country' WHERE `alias` = '$alias'");

					header("Refresh:0");

					break; // Stop loop after updating database
				}

			}



}

function fetchListing($alias) {

	global $con, $api_key;

	// Convert Space in text
	$alias = str_replace(" ", "%20", $alias);
	$request_url = "https://api.yelp.com/v3/businesses/" . $alias;

	$response = callAPI($request_url);
	$counter = 1;

	echo $pretty_response = json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

	// Parse important data from JSON.
	foreach($response as $value => $data) {

		@$id = $response->id;
		@$name = $response->name;
		@$image_url = $response->image_url;
		@$rating = $response->rating;
		@$phone = $response->phone;
		@$price = $response->price;


		//header("Refresh:0");

		break; // Stop loop after updating database
		}

		// Add business information to database
		//$insert = @mysqli_query($con, "INSERT INTO `yelp_business`(`id`, `alias`, `name`, `image_url`, `category`, `rating`, `address`, `city`, `postal`, `state`, `country`, `latitude`, `longitude`, `price`, `phone`) VALUES ('$id','$alias','$name','$image_url','$categories','$rating','$address','$city','$postal','$state','$country','$latitude','$longitude','$price','$phone')");



}




















// ACTUAL CODE FOR WEBSITE






















function fetchAPI($request_url,$cat) {

	global $con, $api_key;

	// Send Yelp API call
	$ch = curl_init($request_url);
	curl_setopt($ch, CURLOPT_HTTPHEADER,
	    array(
	        "Content-Type: application/json",
	        "Authorization: Bearer ". $api_key
	));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$data = curl_exec($ch); // Yelp response
	curl_close($ch);



	// Handle Yelp response data
	$response = json_decode($data);

	// For listing
	$counter = 1;

	// Parse API
	foreach($response as $key => $arrays) {
		// Parse Data only if $key is businesses
		if($key == "businesses") {

			// Check to if attraction or restaurant, and if so, add header
			/*if($cat == "r") {
				echo "<div class=\"col-md-12\"><h2>Restaurants</h2></div>";
			} elseif ($cat == "a") {
				echo "<div class=\"col-md-12\"><h2>Attractions</h2></div>";
			}*/

			// Parse important data from JSON.
			foreach($arrays as $value) {


				// Convert JSON data into variables
				@$id = $value->id;
				@$alias = $value->alias;
				@$name = $value->name;
				@$image_url = $value->image_url;
				@$rating = $value->rating;
				@$phone = $value->phone;
				@$price = $value->price;


				foreach($value as $info => $data) {

					// Get address data
					if($info == "location") {
						@$address = $data->address1;
						@$city = @$data->city;
						@$postal = $data->zip_code;
						@$state = $data->state;
						@$country = $data->country;
					}

					// Get coordinates data
					if($info == "coordinates") {
						@$latitude = $data->latitude;
						@$longitude = $data->longitude;
					}

					// Get coordinates data
					if($info == "categories") {

						foreach($data as $group) {
							@$tags = $group->title;

							// Check whether to add to categories variable or create new categories variable
							if(@$categories == "") {
								@$categories = $tags;
							} else {
								@$categories = $categories . ", " . $tags;
							}
						}

					}
				}


				// Fix MySQL issue for apostrophes and accents
				$name = mysqli_real_escape_string($con, $name); 
				$alias = mysqli_real_escape_string($con, $alias); 
				$address = mysqli_real_escape_string($con, $address);
				$city = mysqli_real_escape_string($con, $city);


				// Add business information to database
				$insert = @mysqli_query($con, "INSERT INTO `yelp_business`(`id`, `alias`, `name`, `image_url`, `category`, `rating`, `address`, `city`, `postal`, `state`, `country`, `latitude`, `longitude`, `price`, `phone`, `type`) VALUES ('$id','$alias','$name','$image_url','$categories','$rating','$address','$city','$postal','$state','$country','$latitude','$longitude','$price','$phone','$cat')");


				// Clear categories variable
				$categories = "";

				// Change \' back to '
				if(stripos($name, "\'") !== FALSE) {
					$name = str_replace("\\\\'", "'", $name);

					// Just in case if that did not work
					$name = str_replace("\'", "'", $name);
				}

				// Change \\ to \
				if(stripos($name, "\\") !== FALSE) {
					$name = str_replace("\\\\", "\\", $name);
				}

				/*echo "<div class=\"col-md-3\">";
				echo "<a href=\"https://tripslip.net/biz/" . $alias . "\">";
				echo "<img src=\"" . $image_url . "\" height=\"300\">";
				echo "<p>" . $counter . ": " . $name . "</p>";
				echo "</a>";
				echo "</div>";*/

				//echo "<br>";
				$counter++;
			}
		} else {
			//return "No listing found.";
		}

	}

}



function rankCategory($category) {

	if(stripos($category, "Mini Golf") !== FALSE) {
		$category = "Mini Golf";
	} elseif(stripos($category, "Arcades") !== FALSE) {
		$category = "Arcades";
	} elseif(stripos($category, "Beaches") !== FALSE) {
		$category = "Beaches";
	} elseif(stripos($category, "Observatories") !== FALSE) {
		$category = "Observatories";
	} elseif(stripos($category, "Public Markets") !== FALSE) {
		$category = "Mini Golf";
	} elseif(stripos($category, "Bus Tours") !== FALSE) {
		$category = "Bus Tours";
	} elseif(stripos($category, "Landmarks & Historical Buildings") !== FALSE) {
		$category = "Landmarks & Historical Buildings";
	} elseif(stripos($category, "Park") !== FALSE) {

		if($category == "Amusement Parks") {
			$category = "Amusement Parks";
		} else {
			$category = "Park";
		}
		
	} elseif(stripos($category, "Shopping Centers") !== FALSE) {
		$category = "Shopping Centers";
	} elseif(stripos($category, "Botanical Gardens") !== FALSE) {
		$category = "Botanical Gardens";
	} elseif(stripos($category, "Rafting/Kayaking") !== FALSE) {
		$category = "Rafting/Kayaking";
	} elseif(stripos($category, "Tubing") !== FALSE) {
		$category = "Tubing";
	} elseif(stripos($category, "Museums") !== FALSE) {
		$category = "Museums";
	} elseif(stripos($category, "Art Museums") !== FALSE) {
		$category = "Art Museums";
	} elseif(stripos($category, "Venues & Event Spaces") !== FALSE) {
		$category = "Venues & Event Spaces";
	} elseif(stripos($category, "Tours") !== FALSE) {
		$category = "Tours";
	} elseif(stripos($category, "Art Classes") !== FALSE) {
		$category = "Art Classes";
	}

	return $category;

}


function categorize($location, $account) {

	global $con, $api_key;

	$location = str_replace(" ", "%20", $location);

	if($location == "") {
		echo "<div class=\"col-md-12\"><h2>Please enter a location.</h2></div>";
	}

	// Fetch Restaurants
	$request_url = "https://api.yelp.com/v3/businesses/search?term=restaurants&limit=20&location=" . $location;
	$response = fetchAPI($request_url,"r");


	// Fetch Attractions
	$request_url = "https://api.yelp.com/v3/businesses/search?term=attractions&location=" . $location;
	$response = fetchAPI($request_url,"a");

	
	

}
function process_location($location, $user) {

	global $con, $api_key;
	$error = 0;

	$location = str_replace(" ", "%20", $location);

	if($location == "") {
		echo "<div class=\"col-md-12\"><h2>Please enter a location.</h2></div>";
	} else {

		// Fetch Restaurants
		$request_url = "https://api.yelp.com/v3/businesses/search?term=restaurants&limit=20&location=" . $location;
		$response = fetchAPI($request_url,"r");

		// Produce Error if no listing was found
		if($response == "No listing found.") {
			$error++;
		}


		// Fetch Attractions
		$request_url = "https://api.yelp.com/v3/businesses/search?term=attractions&location=" . $location;
		$response = fetchAPI($request_url,"a");

		// Produce Error if no listing was found
		if($response == "No listing found.") {
			$error++;
		}


		// If the error variable is 2. Say no listing was found.
		if($error == 2) {
			echo "<h1>No listing was found. Please try again.</h1>";
		}

	}
	
	

}







function scheduleAPI($request_url, $status) {
	global $con, $api_key;

	// Send Yelp API call
	$ch = curl_init($request_url);
	curl_setopt($ch, CURLOPT_HTTPHEADER,
	    array(
	        "Content-Type: application/json",
	        "Authorization: Bearer ". $api_key
	));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$data = curl_exec($ch); // Yelp response
	curl_close($ch);



	// Handle Yelp response data
	$response = json_decode($data);

	// For listing
	$counter = 1;

	// Parse API
	foreach($response as $key => $arrays) {
		// Parse Data only if $key is businesses
		if($key == "businesses") {

			// Parse important data from JSON.
			foreach($arrays as $value) {


				// Convert JSON data into variables
				@$id = $value->id;
				@$alias = $value->alias;
				@$name = $value->name;
				@$image_url = $value->image_url;
				@$rating = $value->rating;
				@$phone = $value->phone;
				@$price = $value->price;


				foreach($value as $info => $data) {

					// Get address data
					if($info == "location") {
						@$address = $data->address1;
						@$city = @$data->city;
						@$postal = $data->zip_code;
						@$state = $data->state;
						@$country = $data->country;
					}

					// Get coordinates data
					if($info == "coordinates") {
						@$latitude = $data->latitude;
						@$longitude = $data->longitude;
					}

					// Get coordinates data
					if($info == "categories") {

						foreach($data as $group) {
							@$tags = $group->title;

							// Check whether to add to categories variable or create new categories variable
							if(@$categories == "") {
								@$categories = $tags;
							} else {
								@$categories = $categories . ", " . $tags;
							}
						}

					}
				}

				// Change \ to \\
				if(stripos($name, "\\") !== FALSE) {
					$name = str_replace("\\", "\\\\", $name);
				}


				// Add business information to database
				$insert = @mysqli_query($con, 'INSERT INTO `yelp_business`(`id`, `alias`, `name`, `image_url`, `category`, `rating`, `address`, `city`, `postal`, `state`, `country`, `latitude`, `longitude`, `price`, `phone`) VALUES ("$id","$alias","$name","$image_url","$categories","$rating","$address","$city","$postal","$state","$country","$latitude","$longitude","$price","$phone")');

				// Clear categories variable
				$categories = "";

				// Change \' back to '
				if(stripos($name, "\'") !== FALSE) {
					$name = str_replace("\\\\'", "'", $name);

					// Just in case if that did not work
					$name = str_replace("\'", "'", $name);
				}

				// Change \\ to \
				if(stripos($name, "\\") !== FALSE) {
					$name = str_replace("\\\\", "\\", $name);
				}

				// Put list here
				$counter++;
			}
		}

	}
}

function generateSchedule($location, $account) {

	global $con, $api_key;

	// Fix location format (Make it readable to API)
	$location = str_replace(" ", "-", $location);


	// If user is using their personal account, add username
	if(isset($account)) { 

		// Get JSON from our own API :)
		$json = file_get_contents('https://tripslip.net/api/' . $location . '?user=' . $account . '&token=' . $_SESSION['token'] . '&schedule=7');

	} else { // If not, use generic account

		$url = "";

		// Get JSON from our own API :)
		$json = file_get_contents("https://tripslip.net/api/" . $location . "?schedule=7");

	}

	return json_decode($json);



}

function location_list($user) {

	global $con;

    // Fetch saved (processed) locations by the user
    $r = mysqli_query($con, "SELECT * FROM `user_locations` WHERE user='$user'");
    $row = mysqli_fetch_array ($r, MYSQLI_ASSOC);

    // HTML Formatting
    echo "<div class=\"row\" style=\"width:100%\">";

    $img_source = "https://tripslip.net/img/locations/";


    // List all locations by user
    do {

        $location = $row['location'];


        // HTML Format
        //echo "<div class=\"col-md-12\">";

        $loc = $location;
        $location = strtolower($location);

        // Make location name friendly with URL.
        $location_url = str_replace(" ", "-", $location);

        // Get Icon
      	if($location) {

	        if($location == "san diego") {
	        	$img = $img_source . "san_diego.svg";
	        } elseif($location == "los angeles") {
	        	$img = $img_source . "los_angeles.svg";
	        } elseif($location == "san francisco") {
	        	$img = $img_source . "san_francisco.svg";
	        } elseif($location == "new york") {
	        	$img = $img_source . "new_york.svg";
	        } elseif($location == "london") {
	        	$img = $img_source . "london.png";
	        } elseif($location == "amsterdam") {
	        	$img = $img_source . "amsterdam.png";
	        } elseif($location == "berlin") {
	        	$img = $img_source . "berlin.png";
	        } elseif($location == "dublin") {
	        	$img = $img_source . "dublin.png";
	        } elseif($location == "sydney") {
	        	$img = $img_source . "sydney.png";
	        } elseif($location == "cape-town") {
	        	$img = $img_source . "cape-town.png";
	        } elseif($location == "tokyo") {
	        	$img = $img_source . "tokyo.png";
	        } elseif($location == "stockholm") {
	        	$img = $img_source . "stockholm.png";
	        } elseif($location == "http://adamwhitcroft.com/offscreen/") {
	        	$img = $img_source . "cape-town.png";
	        } elseif($location == "cape-town") {
	        	$img = $img_source . "cape-town.png";
	        } elseif($location == "cape-town") {
	        	$img = $img_source . "cape-town.png";
	        } elseif($location == "cape-town") {
	        	$img = $img_source . "cape-town.png";
	        } else {
	        	$img = $img_source . "location.svg";
	        }

	        // Display Icon and Location Text
	        echo "<div class=\"col-md-3\"><a href=\"https://tripslip.net/account/listing/" . $location_url . "\"><img src=\"" . $img . "\"><p style=\"text-align:center\">" . $loc . "</p></a></div>";

	        // Display Location Text
	        //echo "<div class=\"col-md-9\">" . $loc . "</div>";


	        // End of HTML Format
	        //echo "</div>";

	     }


    } while($row = $r->fetch_assoc());

    // End of HTML Formatting
    echo "</div>";

}







// API Functions
function fetchYelpAPI($request_url,$keyword,$cat) {

	global $con, $api_key;

	// Send Yelp API call
	$ch = curl_init($request_url);
	curl_setopt($ch, CURLOPT_HTTPHEADER,
	    array(
	        "Content-Type: application/json",
	        "Authorization: Bearer ". $api_key
	));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$data = curl_exec($ch); // Yelp response
	curl_close($ch);



	// Handle Yelp response data
	$response = json_decode($data);

	// For listing
	$counter = 1;

	// Parse API
	foreach($response as $key => $arrays) {
		// Parse Data only if $key is businesses
		if($key == "businesses") {

			// Parse important data from JSON.
			foreach($arrays as $value) {


				// Convert JSON data into variables
				@$id = $value->id;
				@$alias = $value->alias;
				@$name = $value->name;
				@$image_url = $value->image_url;
				@$rating = $value->rating;
				@$phone = $value->phone;
				@$price = $value->price;


				foreach($value as $info => $data) {

					// Get address data
					if($info == "location") {
						@$address = $data->address1;
						@$city = @$data->city;
						@$postal = $data->zip_code;
						@$state = $data->state;
						@$country = $data->country;
					}

					// Get coordinates data
					if($info == "coordinates") {
						@$latitude = $data->latitude;
						@$longitude = $data->longitude;
					}

					// Get coordinates data
					if($info == "categories") {

						foreach($data as $group) {
							@$tags = $group->title;

							// Check whether to add to categories variable or create new categories variable
							if(@$categories == "") {
								@$categories = $tags;
							} else {
								@$categories = $categories . ", " . $tags;
							}
						}

					}
				}


				// Fix MySQL issue for apostrophes and accents
				$name = mysqli_real_escape_string($con, $name); 
				$alias = mysqli_real_escape_string($con, $alias); 
				$address = mysqli_real_escape_string($con, $address);
				$city = mysqli_real_escape_string($con, $city);


				// Add business information to database
				$insert = @mysqli_query($con, "INSERT INTO `yelp_business`(`id`, `alias`, `name`, `image_url`, `category`, `rating`, `address`, `city`, `postal`, `state`, `country`, `latitude`, `longitude`, `price`, `phone`, `keyword`, `type`) VALUES ('$id','$alias','$name','$image_url','$categories','$rating','$address','$city','$postal','$state','$country','$latitude','$longitude','$price','$phone','$keyword','$cat')");

				// If business could not be inserted
				if(!$insert) {

					//If business is already added, but keyword is not the same
					$r = mysqli_query($con, "SELECT * FROM yelp_business WHERE id = '$id'");

					// See if business exist or not
					if($r) {

						// Fetch query
						$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);

						// Check to see if the keywords match with each other, it if doesn't ignore
						if($keyword != $row['keyword']) {

							// Query to see if BOTH business id  keyword exist
							$check_r = @mysqli_query($con, "SELECT * FROM keyword_business WHERE business_id = '$id' AND $keyword");

							// If there is no results
							if(@mysqli_num_rows($check_r) == (0 || false)) {
								$insert = @mysqli_query($con, "INSERT INTO `keyword_business`(`business_id`, `keyword`) VALUES ('$id','$keyword')");
							}

						}

					}

				}


				// Clear categories variable
				$categories = "";

				$counter++;
			}
		} else {
			return "No listing found.";
		}

	}

}

function fetchData($location) {

	global $con, $api_key;

	// Get keyword to save where listing was searched
	$keyword = $location;

	$location = str_replace(" ", "%20", $location);

	// Fetch Restaurants
	$request_url = "https://api.yelp.com/v3/businesses/search?term=restaurants&limit=20&location=" . $location;
	$response = fetchYelpAPI($request_url,$keyword,"r");


	// Fetch Attractions
	$request_url = "https://api.yelp.com/v3/businesses/search?term=attractions&location=" . $location;
	$response = fetchYelpAPI($request_url,$keyword,"a");

	
	

}

function timeSpent($id) {

	global $con;

	// Get business data from MySQL database.
	$r = mysqli_query($con, "SELECT * FROM yelp_business WHERE id='$id'");
	$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);

	// If business is a restuarant, time spent is 1 hour, if not, time spent is dependent on its category.
	if($row['type'] == 'r') {
		$time_spent = 1;
	} else {

		$category = $row["category"];

		$category = rankCategory($category);

		// Get time spent from MySQL database.
		$r_cat = mysqli_query($con, "SELECT * FROM time_spent WHERE category='$category'");
		$row_cat = mysqli_fetch_array ($r_cat, MYSQLI_ASSOC);

		$time_spent = $row_cat['time_spent'] / 60;

		// If category could not be found, make time spent to 1 hour
		if($time_spent == 0) {
			$time_spent = 1;
		}

	}

	return $time_spent;

}
function daySchedule($location,$day) {

	global $con, $user;

	$hour = 0;

	// Get business data from MySQL database.
	$type1 = mysqli_query($con, "SELECT * FROM yelp_business WHERE city = '$location' AND type = 'r'");
	$type2 = mysqli_query($con, "SELECT * FROM yelp_business WHERE city = '$location' AND type = 'a'");

	// Search for attractions first
	$r = $type2;
	$restuarant = FALSE;

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

	// Initialize Content Type to JSON
	header('Content-Type: application/json');

	// Starting listing number
	$i = 0;

	// For-loop to accommodate the number of days the client has requested
	for($j = 1; $j <= $day; $j++) {

		// Reset Check hour to 0 after every new day
		$check_hour = 0;

		// Fetch data for each listing
		do {

			// If no results found ($id = null), then break loop
			if($row['id'] == null) {
				break;
			}

			$blacklist = checkBlacklist($user,$row['id']);


			// Check if id is in blacklist, if so, skip to next business listing
			if($blacklist == false) {

				$time = timeSpent($row['id']);

				// Check type and add it to JSON
				if($row['type'] == 'a') {
					$type = "Attraction";
				} elseif($row['type'] == 'r') {
					$type = "Restuarant";
				} else {
					$type = "Point of Interest";
				}

				// Create readable time for humans
				$current_time = convertHour($hour);

				$listing[$i] = new StdClass;

				$listing[$i]->id = $row['id'];
				$listing[$i]->name = $row['name'];
				$listing[$i]->image_url = $row['image_url'];
				$listing[$i]->rating = $row['rating'];
				$listing[$i]->type = $type;
				$listing[$i]->time_spent = $time;
				$listing[$i]->current_time = $current_time;
				$listing[$i]->day = $j;

				// Add total hours spent by the client
				$hour += $time;

				// Next listing number
				$i++;


			} else {

				// Subtract check hour, since blacklist is true
				$check_hour -= timeSpent($row['id']);

			}


			// Decide whether it is time for the client to eat, based on hours
			if(($hour == 0) || ($hour >= 4 && $hour <= 7 && $restuarant == FALSE) || ($hour >= 11 && $hour <= 14 && $restuarant == FALSE)) {
				$row = $type1->fetch_assoc();
				$restuarant = TRUE;
			} else {
				$row = $type2->fetch_assoc();
				$restuarant = FALSE;
			}


			// Check if listing should go for the current day or next day, if total hour is 13 or over
			$check_hour += timeSpent($row['id']);


			if($check_hour >= 13) {
				break;
			}




			
		} while($hour < 13);

		// Set $hour back to 0
		$hour = 0;


	}

	echo $json = json_encode($listing, JSON_PRETTY_PRINT);

	die();
}

function convertHour($hour) {


	$current = $hour + 8;

	// Convert to PM if hour is 13 or over
	if($current >= 13) {

		// Subtract 12
		$current -= 12;

		// Add PM suffix
		$suffix = "PM";

	} else {

		// Add AM suffix
		$suffix = "AM";

	}

	// Convert into string

	return $string = $current . ":00" . $suffix;

}

function removeListing($user,$id) {

	global $con;

	// Add listing to blacklist databse
	$insert = @mysqli_query($con, "INSERT INTO `remove_location`(`user`, `business`) VALUES ('$user','$id')");

	return 0;


}

function checkBlacklist($user,$id) {

	global $con;

	// Check query
	$r = @mysqli_query($con, "SELECT * FROM remove_location WHERE user = '$user' AND business = '$id'");

	// Check if listing is blacklisted, if so, the function will produce false. If it is not blacklisted, function will produce a true value.
	if(mysqli_num_rows($r) == 0) {
		return FALSE;
	} else {
		return TRUE;
	}

}

?>