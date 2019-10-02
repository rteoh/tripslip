<?


function map($lat, $long) {


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
	}

	return $category;

}


function generateSchedule($location) {

	global $con, $api_key;

	// Fetch Restaurants
	$location = str_replace(" ", "%20", $location);


	// Fetch Attractions

	
	

}

function unicode($text) {


	$text = str_replace("\u00f3", "ó", $text);



	return $text;

}


?>